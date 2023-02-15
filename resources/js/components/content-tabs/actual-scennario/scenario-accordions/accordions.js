export default {
    props: ["maritialStatus", "reloader2", "authenticated"],
    watch: {
        maritialStatus: function () {
            this.changed = this.maritialStatus;
            this.$emit("MaritialStatusChanged", this.mutableMaritialStatus); // send the sum
        },
        reloader2: function () {
            this.$forceUpdate();
        },
    },
    data() {
        return {
            loading: false,
            data: [],
            factors: [],
            scenarios: [],
            additionalScenarios: [],
            singleValues: [],
            marriedValues: [],
            selectedSubfactor: {
                selections: [],
            },
            previusSelectedSubfactor: {
                selections: [],
            },
            factorScore: {},
            factorScoreMarried: {},
            factorScoreSingle: {},
            criterion: {},
            selectedCriterion: {},
            mutableMaritialStatus: this.maritialStatus,
            factorNames: [],
            arraySums: [],
            situation: [],
            changed: null,
        };
    },

    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            let me = this;
            axios.get("/factors").then(function (response) {
                console.log(response);
                me.scenarios = response.data[1] ? response.data[1] : [];
                let scenario = null; //actual
                if (me.authenticated) {
                    if (me.scenarios.length > 0) {
                        me.scenarios.forEach((element) => {
                            if (
                                "is_theactual" in element &&
                                element["is_theactual"] == true
                            ) {
                                scenario = element; ///Actual situation scennario only it is editable
                            }
                            if (element["is_theactual"] == false) {
                                me.additionalScenarios.push(element);
                            }
                        });

                        me.$emit(
                            "additionalScennarios",
                            me.additionalScenarios
                        );
                        me.factors = response.data ? response.data[0] : [];
                        me.factors.forEach((element) => {
                            me.factorNames.push({
                                id: element.id,
                                name: element.title + " " + element.sub_title,
                            });
                        });
                        //
                        me.$emit("factorNames", me.factorNames);
                        let newData = [];
                        if (
                            scenario != null &&
                            Array.isArray(JSON.parse(scenario["body"])) &&
                            JSON.parse(scenario["body"]).length > 0
                        ) {
                            me.mutableMaritialStatus =
                                scenario["is_married"] == false
                                    ? "Single"
                                    : "Married"; //get maritial status of scennario
                            me.$emit(
                                "mutableMaritialStatus",
                                me.mutableMaritialStatus
                            );
                            let body = JSON.parse(scenario["body"]);
                            me.$emit("factorsWithSubfactors", me.factors);
                            me.factors.forEach((factor) => {
                                let items = [];
                                body.forEach((item) => {
                                    if (item["factor"] === factor.id) {
                                        factor.subfactors.forEach(
                                            (subfactor) => {
                                                if (
                                                    item["subfactor"] ===
                                                    subfactor.id
                                                ) {
                                                    subfactor.criteria.forEach(
                                                        (criterion) => {
                                                            if (
                                                                item[
                                                                    "criterion"
                                                                ] ==
                                                                criterion.id
                                                            ) {
                                                                criterion.selected = true;
                                                                me.criteriaVal({
                                                                    criterion:
                                                                        criterion,
                                                                    factor: factor.id,
                                                                    subfactor:
                                                                        subfactor.id,
                                                                });
                                                            } else {
                                                                criterion.selected = false;
                                                            }
                                                        }
                                                    );
                                                }
                                            }
                                        );
                                    }
                                });
                                newData.push({ items: items, factor: factor });
                            });
                        } else {
                            me.factors.forEach((factor) => {
                                newData.push({ items: null, factor: factor });
                            });
                        }
                        me.data = newData;
                    } else {
                        let newData = [];
                        me.factors = response.data ? response.data[0] : [];

                        me.factors.forEach((factor) => {
                            newData.push({ items: null, factor: factor });
                        });
                        me.data = newData;
                    }
                } else {
                    //When not authenticated
                    console.log(null);
                    /*   let newData = [];
                      me.factors = response.data ? response.data[0] : [];
                      me.factors.forEach(factor => {
                          newData.push({ items: null, factor: factor })
                      });
                      me.data = newData; */
                }
                me.$emit("factorNames", me.factorNames);
                me.$emit("factorsWithSubfactors", me.factors);
            });
        },

        setOption(criterion, factor, subfactor) {
            this.criteriaVal({
                criterion,
                factor,
                subfactor,
            });
        },

        criteriaVal(event) {
            let me = this;
            let newVal = null;
            if ("criterion" in event) {
                newVal = event;
            } else {
                newVal = JSON.parse(
                    JSON.stringify(
                        event.target.options[event.target.options.selectedIndex]
                    )
                )._value;
            }
            let factor = newVal.factor;
            let subfactor = newVal.subfactor;
            let criterion = newVal.criterion;

            me.selectedSubfactor.selections[subfactor] = {
                criterion: criterion,
                factor: factor,
                subfactor: subfactor,
            };

            //Limit sum for factor 3
            if (factor === 4 || factor === 5) {
                me.selectedSubfactor.selections.forEach((element, index) => {
                    if (element.factor === 4) {
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                17 &&
                            me.selectedSubfactor.selections[index - 1] &&
                            me.selectedSubfactor.selections[index - 1]
                                .subfactor == 16 &&
                            me.selectedSubfactor.selections[index - 1].criterion
                                .single >= 50
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 106,
                                    criterion:
                                        "No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 17,
                                    selected: true,
                                },
                                factor: 4,
                                subfactor: 17,
                            };
                        }
                        //
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                16 &&
                            me.selectedSubfactor.selections[index].criterion
                                .single < 50 &&
                            me.selectedSubfactor.selections[index + 1] &&
                            me.selectedSubfactor.selections[index + 1]
                                .subfactor == 17 &&
                            me.selectedSubfactor.selections[index + 1].criterion
                                .single >= 50
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 101,
                                    criterion:
                                        "No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 16,
                                    selected: true,
                                },
                                factor: 4,
                                subfactor: 16,
                            };
                        }
                        //19
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                19 &&
                            me.selectedSubfactor.selections[index - 1] &&
                            me.selectedSubfactor.selections[index - 1]
                                .subfactor == 18 &&
                            (me.selectedSubfactor.selections[index - 1]
                                .criterion.single >= 50 ||
                                (me.selectedSubfactor.selections[index + 1] &&
                                    (me.selectedSubfactor.selections[index + 1]
                                        .criterion.single >= 50 ||
                                        me.selectedSubfactor.selections[
                                            index + 1
                                        ].criterion.single +
                                            me.selectedSubfactor.selections[
                                                index - 1
                                            ].criterion.single >=
                                            50)))
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 116,
                                    criterion:
                                        "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 19,
                                },
                                factor: 4,
                                subfactor: 19,
                            };
                        }
                        // 18
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                18 &&
                            me.selectedSubfactor.selections[index].criterion
                                .single < 50 &&
                            me.selectedSubfactor.selections[index + 1] &&
                            me.selectedSubfactor.selections[index + 1]
                                .subfactor == 19 &&
                            (me.selectedSubfactor.selections[index + 1]
                                .criterion.single >= 50 ||
                                (me.selectedSubfactor.selections[index + 2] &&
                                    ((me.selectedSubfactor.selections[index + 2]
                                        .subfactor == 20 &&
                                        me.selectedSubfactor.selections[
                                            index + 2
                                        ].criterion.single >= 50) ||
                                        me.selectedSubfactor.selections[
                                            index + 1
                                        ].criterion.single +
                                            me.selectedSubfactor.selections[
                                                index + 2
                                            ].criterion.single >=
                                            50)))
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 111,
                                    criterion:
                                        "No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 18,
                                },
                                factor: 4,
                                subfactor: 18,
                            };
                        }
                        //20
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                20 &&
                            me.selectedSubfactor.selections[index - 1] &&
                            me.selectedSubfactor.selections[index - 1]
                                .subfactor == 19 &&
                            (me.selectedSubfactor.selections[index - 1]
                                .criterion.single >= 50 ||
                                (me.selectedSubfactor.selections[index - 2] &&
                                    me.selectedSubfactor.selections[index - 2]
                                        .subfactor == 18 &&
                                    (me.selectedSubfactor.selections[index - 2]
                                        .criterion.single >= 50 ||
                                        (me.selectedSubfactor.selections[
                                            index - 2
                                        ].subfactor == 18 &&
                                            me.selectedSubfactor.selections[
                                                index - 1
                                            ].criterion.single +
                                                me.selectedSubfactor.selections[
                                                    index - 2
                                                ].criterion.single >=
                                                50))))
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 116,
                                    criterion:
                                        "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 20,
                                },
                                factor: 4,
                                subfactor: 20,
                            };
                        }
                    }
                    //Max 600
                    if (element.factor === 5) {
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                21 &&
                            me.selectedSubfactor.selections[index + 2] &&
                            me.selectedSubfactor.selections[index + 2]
                                .subfactor === 23 &&
                            me.selectedSubfactor.selections[index + 2].criterion
                                .single >= 600
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 124,
                                    criterion:
                                        "Sin estudios en Canadá o menos de 1 año de duración.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 21,
                                },
                                factor: 5,
                                subfactor: 21,
                            };
                        }

                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                22 &&
                            me.selectedSubfactor.selections[index + 1] &&
                            me.selectedSubfactor.selections[index + 1]
                                .subfactor === 23 &&
                            me.selectedSubfactor.selections[index + 1].criterion
                                .single >= 600
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 127,
                                    criterion: "Sin oferta de trabajo laboral.",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 22,
                                },
                                factor: 5,
                                subfactor: 22,
                            };
                        }
                        if (
                            me.selectedSubfactor.selections[index].subfactor ==
                                24 &&
                            me.selectedSubfactor.selections[index - 1]
                                .subfactor === 23 &&
                            me.selectedSubfactor.selections[index - 1].criterion
                                .single >= 600
                        ) {
                            me.selectedSubfactor.selections[index] = {
                                criterion: {
                                    id: 132,
                                    criterion: "Sin familiar directo en Canadá",
                                    single: 0,
                                    married: 0,
                                    subfactor_id: 24,
                                },
                                factor: 5,
                                subfactor: 24,
                            };
                        }
                    }
                });

                // console.log(me.selectedSubfactor.selections);
            }
            me.singleValues.sort(function (a, b) {
                return a.subfactor - b.subfactor;
            });
            let selectedSituation = [];
            selectedSituation[0] = this.changed; //? this.changed : this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;

            me.selectedSubfactor.selections.forEach((selection) => {
                let existingS = null;
                let existingM = null;

                me.singleValues.forEach((element) => {
                    if (
                        element["factor"] == selection.factor &&
                        element["subfactor"] == selection.subfactor
                    ) {
                        existingS = element;
                        element["criterion"] = selection.criterion.id;
                        element["value"] =
                            selection.criterion.single != null
                                ? selection.criterion.single
                                : 0;
                    }
                });

                if (!existingS) {
                    me.singleValues.push({
                        factor: selection.factor,
                        subfactor: selection.subfactor,
                        criterion: selection.criterion.id,
                        value:
                            selection.criterion.single != null
                                ? selection.criterion.single
                                : 0,
                    });
                }

                me.marriedValues.forEach((element) => {
                    //Find factor and subfactor for replace criterion value
                    if (
                        element["factor"] == selection.factor &&
                        element["subfactor"] == selection.subfactor
                    ) {
                        existingM = element;
                        element["criterion"] = selection.criterion.id;
                        element["value"] =
                            selection.criterion.married != null
                                ? selection.criterion.married
                                : 0;
                        //replace
                    }
                });

                if (!existingM) {
                    me.marriedValues.push({
                        factor: selection.factor,
                        subfactor: selection.subfactor,
                        criterion: selection.criterion.id,
                        value:
                            selection.criterion.married != null
                                ? selection.criterion.married
                                : 0,
                    });
                }
                /*
                 */
            });
            me.factorScoreMarried[factor] = 0;
            me.factorScoreSingle[factor] = 0;

            if (me.singleValues.length > 0) {
                let groupByFactoS = me.singleValues.reduce((group, product) => {
                    const { factor } = product;
                    group[factor] = group[factor] ? group[factor] : [];
                    group[factor].push(product);
                    return group;
                }, {});
                me.factorScoreSingle[factor] = groupByFactoS[factor].reduce(
                    (n, { value }) => n + value,
                    0
                );
            }

            if (me.marriedValues.length > 0) {
                let groupByFactoM = me.marriedValues.reduce(
                    (group, product) => {
                        const { factor } = product;
                        group[factor] = group[factor] ? group[factor] : [];
                        group[factor].push(product);
                        return group;
                    },
                    {}
                );

                me.factorScoreMarried[factor] = groupByFactoM[factor].reduce(
                    (n, { value }) => n + value,
                    0
                );
            }
            //grouped by factor
            // console.log(JSON.stringify(groupByFacto, null, 2));

            me.selectedCriterion[subfactor] = criterion.id;

            if (this.mutableMaritialStatus === "Single") {
                selectedSituation[2] = me.singleValues;
                me.factorScore[factor] = me.factorScoreSingle[factor];
            } else {
                me.selectedCriterion[criterion.id] = criterion.married;
                selectedSituation[2] = me.marriedValues;
                me.factorScore[factor] = me.factorScoreMarried[factor];
            }
            //Create or update scores array to emmit to another file
            let hasSumS = null;
            let hasSumM = null;

            me.arraySums.forEach((element) => {
                if (
                    "singleSum" in element &&
                    "factor" in element["singleSum"] &&
                    element["singleSum"].factor === factor
                ) {
                    hasSumS = element;
                    element["singleSum"]["sum"] = me.factorScoreSingle[factor];
                }
            });

            me.arraySums.forEach((element) => {
                if (
                    "marriedSum" in element &&
                    "factor" in element["marriedSum"] &&
                    element["marriedSum"].factor === factor
                ) {
                    hasSumM = element;
                    element["marriedSum"]["sum"] =
                        me.factorScoreMarried[factor];
                }
            });

            if (!hasSumS) {
                me.arraySums.push({
                    singleSum: {
                        factor: factor,
                        sum: me.factorScoreSingle[factor],
                    },
                });
            }
            if (!hasSumM) {
                me.arraySums.push({
                    marriedSum: {
                        factor: factor,
                        sum: me.factorScoreMarried[factor],
                    },
                });
            }
            me.$emit("sumScore", [me.arraySums, me.maritialStatus]); // send the sum
            me.$emit("selectedSituation", selectedSituation);
        },
    },
};
