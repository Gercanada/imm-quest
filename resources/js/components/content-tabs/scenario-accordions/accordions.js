export default {
    props: ["maritialStatus"],
    data() {
        return {
            criterion: '',
            loading: false,
            data: [],
            factors: [],
            scenarios: [],
            singleValues: [],
            marriedValues: [],
            subfactorsArr: [],
            SelectedFactor: [],
            selectedSubfactor: {
                selections: []
            },
            factorScore: {},
            factorScoreMarried: {},
            factorScoreSingle: {},
            criterion: {},
            selectedCriterion: {},
            mutableMaritialStatus: this.maritialStatus,

            subfacts: {

            }
        };
    },

    mounted() {
        this.getData();
        console.log(this.maritialStatus);
    },



    methods: {
        getData() {
            let me = this;
            axios.get("/factors").then(function(response) {
                me.scenarios = response.data[1] ? response.data[1] : [];
                let scenario = null; //actual
                if (me.scenarios.length > 0) {
                    me.scenarios.forEach((element) => {
                        if ("is_theactual" in element && element["is_theactual"] == true) {
                            scenario = element;
                        }
                    });

                    me.factors = response.data ? response.data[0] : [];

                    let newData = [];
                    if (scenario != null &&
                        Array.isArray(JSON.parse(scenario['body'])) &&
                        JSON.parse(scenario['body']).length > 0
                    ) {
                        me.mutableMaritialStatus = scenario['is_married'] == false ? 'Single' : 'Married'; //get maritial status of scennario
                        me.$emit("mutableMaritialStatus", me.mutableMaritialStatus);
                        let body = JSON.parse(scenario['body']);

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
                            })
                            newData.push({ items: items, factor: factor })
                        });
                    } else {
                        me.factors.forEach(factor => {
                            newData.push({ items: null, factor: factor })
                        });
                    }
                    me.data = newData;
                }

            });

        },


        criteriaVal(event) {




            let me = this;
            let newVal = null;
            if ('criterion' in event) {
                newVal = event;
            } else {
                newVal = JSON.parse(JSON.stringify(event.target.options[event.target.options.selectedIndex]))._value;
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


            let existingS = null;
            let existingM = null;

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
                console.log('push')
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
                // console.log({ singleSum: me.factorScoreSingle[factor] });


            }
            if (me.marriedValues.length > 0) {
                let groupByFactoM = me.marriedValues.reduce((group, product) => {
                    const { factor } = product;
                    group[factor] = group[factor] ? group[factor] : [];
                    group[factor].push(product);
                    return group;
                }, {});

                me.factorScoreMarried[factor] = groupByFactoM[factor].reduce((n, { value }) => n + value, 0);
                // console.log({ marriedSum: me.factorScoreMarried[factor] });
            }
            //grouped by factor
            // console.log(JSON.stringify(groupByFacto, null, 2));

            let selectedSituation = [];
            selectedSituation[0] = this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;

            me.selectedCriterion[subfactor] = criterion.id;


            if (this.mutableMaritialStatus === "Single") {
                console.log('a')
                selectedSituation[2] = me.singleValues;
                me.factorScore[factor] = me.factorScoreSingle[factor];
            } else {
                console.log('b')
                me.selectedCriterion[criterion.id] = criterion.married;

                selectedSituation[2] = me.marriedValues;
                me.factorScore[factor] = me.factorScoreMarried[factor];
            }
            this.$emit("selectedSituation", selectedSituation);
        },
    },
};
