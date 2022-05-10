export default {
    props: ["maritialStatus", 'reloader', "authenticated"],
    watch: {
        maritialStatus: function() {
            this.$emit("MaritialStatusChanged", this.mutableMaritialStatus); // send the sum
        },
        reloader: function() {
            alert('called');
            window.location.reload();
            // this.getData;
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
                selections: []
            },
            factorScore: {},
            factorScoreMarried: {},
            factorScoreSingle: {},
            criterion: {},
            selectedCriterion: {},
            mutableMaritialStatus: this.maritialStatus,
            factorNames: [],
            arraySums: [],
            situation: []
        };
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            let me = this;
            axios.get("/factors").then(function(response) {
                me.scenarios = response.data[1] ? response.data[1] : [];
                let scenario = null; //actual

                if (me.authenticated) {
                    if (me.scenarios.length > 0) {
                        me.scenarios.forEach((element) => {
                            if ("is_theactual" in element && element["is_theactual"] == true) {
                                scenario = element; ///Actual situation scennario only it is editable
                            }
                            if (element["is_theactual"] == false) {
                                me.additionalScenarios.push(element);
                            }
                        });

                        me.$emit("additionalScennarios", me.additionalScenarios);
                        me.factors = response.data ? response.data[0] : [];
                        me.factors.forEach(element => {
                            me.factorNames.push({
                                id: element.id,
                                name: element.title + ' ' + element.sub_title
                            });
                        });
                        //
                        me.$emit("factorNames", me.factorNames);
                        let newData = [];
                        if (scenario != null &&
                            Array.isArray(JSON.parse(scenario['body'])) &&
                            JSON.parse(scenario['body']).length > 0
                        ) {
                            me.mutableMaritialStatus = scenario['is_married'] == false ? 'Single' : 'Married'; //get maritial status of scennario
                            me.$emit("mutableMaritialStatus", me.mutableMaritialStatus);
                            let body = JSON.parse(scenario['body']);
                            me.$emit("factorsWithSubfactors", me.factors);
                            me.factors.forEach(factor => {
                                let items = [];
                                body.forEach(item => {
                                    if (item['factor'] === factor.id) {
                                        factor.subfactors.forEach(subfactor => {
                                            if (item['subfactor'] === subfactor.id) {
                                                subfactor.criteria.forEach(criterion => {
                                                    if (item['criterion'] == criterion.id) {
                                                        criterion.selected = true;
                                                        me.criteriaVal({
                                                            criterion: criterion,
                                                            factor: factor.id,
                                                            subfactor: subfactor.id,
                                                        });
                                                    } else {
                                                        criterion.selected = false
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                                newData.push({ items: items, factor: factor })
                            });
                        } else {
                            me.factors.forEach(factor => {
                                newData.push({ items: null, factor: factor })
                            });
                        }
                        me.data = newData;
                    }
                    this.$emit("MaritialStatusChanged", this.mutableMaritialStatus);
                } else { //When not authenticated
                    let newData = [];
                    me.factors = response.data ? response.data[0] : [];

                    me.factors.forEach(factor => {
                        newData.push({ items: null, factor: factor })
                    });
                    me.data = newData;
                }
                // me.$emit("factorNames", me.factorNames);
                // me.$emit("factorsWithSubfactors", me.factors);
                // console.log({ factors: me.factors });
            });
        },

        criteriaVal(event) {
            let me = this;
            let newVal = null;
            let existingS = null;
            let existingM = null;

            if ('criterion' in event) {
                newVal = event;
            } else {
                newVal = JSON.parse(
                    JSON.stringify(event.target.options[event.target.options.selectedIndex])
                )._value;
            }

            me.selectedSubfactor.selections[newVal.subfactor] = {
                criterion: newVal.criterion,
                factor: newVal.factor,
                subfactor: newVal.subfactor,
            };

            let factor = newVal.factor;
            let subfactor = newVal.subfactor;
            let criterion = newVal.criterion;

            me.singleValues.sort(function(a, b) {
                return a.subfactor - b.subfactor;
            });

            me.singleValues.forEach(element => {
                if (element['factor'] == factor && element['subfactor'] == subfactor) {
                    existingS = element;
                    element['criterion'] = criterion.id
                    element['value'] = criterion.single != null ? criterion.single : 0
                }
            });

            if (!existingS) {
                me.singleValues.push({
                    factor,
                    subfactor,
                    criterion: criterion.id,
                    value: criterion.single != null ? criterion.single : 0,
                });
            }

            me.marriedValues.forEach(element => { //Find factor and subfactor for replace criterion value
                if (element['factor'] == factor && element['subfactor'] == subfactor) {
                    existingM = element;
                    element['criterion'] = criterion.id
                    element['value'] = criterion.married != null ? criterion.married : 0
                        //replace
                }
            });

            if (!existingM) {
                me.marriedValues.push({
                    factor,
                    subfactor,
                    criterion: criterion.id,
                    value: criterion.married != null ? criterion.married : 0,
                });
            }
            me.factorScoreMarried[factor] = 0;
            me.factorScoreSingle[factor] = 0;

            if (me.singleValues.length > 0) {
                let groupByFactoS = me.singleValues.reduce((group, product) => {
                    const { factor } = product;
                    group[factor] = group[factor] ? group[factor] : [];
                    group[factor].push(product);
                    return group;
                }, {});
                me.factorScoreSingle[factor] = groupByFactoS[factor].reduce((n, { value }) => n + value, 0);
            }

            if (me.marriedValues.length > 0) {
                let groupByFactoM = me.marriedValues.reduce((group, product) => {
                    const { factor } = product;
                    group[factor] = group[factor] ? group[factor] : [];
                    group[factor].push(product);
                    return group;
                }, {});

                me.factorScoreMarried[factor] = groupByFactoM[factor].reduce((n, { value }) => n + value, 0);
            }
            //grouped by factor
            // console.log(JSON.stringify(groupByFacto, null, 2));
            let selectedSituation = [];
            selectedSituation[0] = this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;
            me.selectedCriterion[subfactor] = criterion.id;


            if (this.mutableMaritialStatus === "Single") {
                selectedSituation[2] = me.singleValues;
                me.factorScore[factor] = me.factorScoreSingle[factor];
                // this.$emit({ scoreSingle: factor }, me.factorScoreSingle[factor]); //send the sum
            } else {
                me.selectedCriterion[criterion.id] = criterion.married;
                selectedSituation[2] = me.marriedValues;
                me.factorScore[factor] = me.factorScoreMarried[factor];
            }

            //Create or update scores array to emmit to another file

            let hasSumS = null;
            let hasSumM = null;

            me.arraySums.forEach(element => {
                if (('singleSum' in element && ('factor' in element['singleSum']) && element['singleSum'].factor === factor)) {
                    hasSumS = element;
                    element['singleSum']['sum'] = me.factorScoreSingle[factor]
                }
            });

            me.arraySums.forEach(element => {
                if ('marriedSum' in element && 'factor' in element['marriedSum'] && element['marriedSum'].factor === factor) {
                    hasSumM = element;
                    element['marriedSum']['sum'] = me.factorScoreMarried[factor]
                }
            });

            if (!hasSumS) {
                me.arraySums.push({
                    singleSum: {
                        factor: factor,
                        sum: me.factorScoreSingle[factor]
                    }
                });
            }
            if (!hasSumM) {
                me.arraySums.push({
                    marriedSum: {
                        factor: factor,
                        sum: me.factorScoreMarried[factor]
                    }
                });
            }
            me.$emit("sumScore", [me.arraySums, me.maritialStatus]); // send the sum
            me.$emit("selectedSituation", selectedSituation);
        },

        showFactor() {

        }
    },
};