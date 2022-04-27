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
                        me.mutableMaritialStatus = scenario['is_married'] == false ? 'Single' : 'Married';
                        //get maritial status
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

                    // console.log(newData);
                    // return;

                    //get selected subfactors criterion and put as selected if exists
                    /*
                        ->TENEMOS LA LISTA DE FACTORES QUE POR DEFECTO NOS DEVI=UELVE LA RUTA.
                        Si el usuario ha guardado un escenario (principal) lo cargamos tambien
                        Lo que buscamos es disparar el select y marcar como seleccionado cada criterio en base al escenario devuelto
                        Tonz tenemos cada objeto del factor y otra lista de los ya guardados
                        queremos
                        A lo que por defecto cada objeto es algo como
                                {
                                    id: 1
                                    sub_title: "Any"
                                    subfactors: [
                                    {
                                            criteria: []
                                            factor_id: 1
                                            id: 1
                                            subfactor: "Any name"
                                            }
                                    ]
                                }
                                Si se ha devuelto el arreglo del escenario guardado contendra objetos como {factor: 2, subfactor: 4, criterion: 33, value: 8}
                                Ahora bien : en el arreglo de factores vamo a comparar el id del factor con el factor en el objeto2, luego el subfactor , y luego el criterio.
                                 Si es coincide , nuestro objeto de factores será como
                                  {
                                   {factor: 1, subfactor: 2, criterion: 3, value: 8},
                                    id: 1
                                    sub_title: "Any"
                                    subfactors: [
                                    {
                                            criteria: [
                                                           { criterion: "17 años o menos",
                       ESTE ES EL BUENO   ------>           id: 3,
                                                            married: 0,
                                                            single: 0,
                                                            subfactor_id: 2,
                                                             },
                                                        ],
                                            factor_id: 1
                                            id: 1
                                            subfactor: "Any name"
                                            }
                                    ]
                                }
                                Por poner un ejemplo ......
                                Ok Ox , Here go.
                        */

                    // }


                    // me.data = newData;
                    /* newData.forEach(element => {
                        .push(element);
                    }); */
                }

            });

        },

        sumArr(arr) {
            return arr.reduce(
                (previousValue, currentValue) => previousValue + currentValue.value,
                0
            );
        },

        replace(arr, obj, x, y, newValue) {
            // console.log('replacing');
            arr.splice(
                arr.findIndex((e) => (e.hasOwnProperty("value") ? e.value : e === obj)),
                1
            );
            let obKey = Object.keys(obj);
            let ovVal = Object.values(obj);
            let newObj = {
                [obKey]: ovVal[0],
                value: newValue,
            };
            arr.push(newObj);
        },

        criteriaVal(event) {
            let me = this;
            let newVal = null;
            let called = false;
            let changed = false;


            if ('criterion' in event) {
                called = true;
                console.log('loaded');
                newVal = event;
            } else {
                changed = true;
                console.log('changed');
                newVal = JSON.parse(JSON.stringify(event.target.options[event.target.options.selectedIndex]))._value;
            }

            console.log(newVal);
            // return

            me.selectedSubfactor[newVal.subfactor] = {
                criterion: newVal.criterion,
                factor: newVal.factor,
                subfactor: newVal.subfactor,
            };

            let factor = newVal.factor;
            let subfactor = newVal.subfactor;
            let criterion = newVal.criterion;

            /*  me.subfactorsArr.sort(function(a, b) {
                return a - b;
            });
 */
            me.singleValues.sort(function(a, b) {
                return a.subfactor - b.subfactor;
            });


            // if (!me.subfactorsArr.includes(subfactor)) {
            // me.subfactorsArr.push(subfactor);
            if (!me.singleValues.some(function(o) { return o["subfactor"] === subfactor; })) {
                console.log('here')
                me.singleValues.push({
                    factor,
                    subfactor,
                    criterion: criterion.id,
                    value: criterion.single != null ? criterion.single : 0,
                });
                me.marriedValues.push({
                    factor,
                    subfactor,
                    criterion: criterion.id,
                    value: criterion.married != null ? criterion.married : 0,
                });

            } else {

                /*  me.singleValues.splice(me.singleValues.indexOf(criterion), subfactor, criterion)
                 me.marriedValues.splice(me.marriedValues.indexOf(criterion), subfactor, criterion) */

                console.log(me.singleValues)
                console.log(me.singleValues.subfactor, subfactor)


                if (me.singleValues['factor'] === factor && me.singleValues['subfactor'] === subfactor) {
                    me.singleValues['criterion'] = criterion.id
                    me.singleValues['value'] = criterion.single != null ? criterion.single : 0
                } else {
                    alert('crashs')
                }
                if (me.marriedValues['factor'] === factor && me.marriedValues['subfactor'] === subfactor) {
                    me.marriedValues['criterion'] = criterion.id
                    me.marriedValues['value'] = criterion.married != null ? criterion.married : 0
                } else {
                    alert('crashs')

                }

                /* me.replace(
                    me.singleValues, factor, { criterion },
                    me.selectedSubfactor[subfactor].single
                );

                me.replace(
                    me.marriedValues, { criterion },
                    factor, subfactor,
                    me.selectedSubfactor[subfactor].married
                ); */
                // me.replace(me.subfactorsArr, { subfactor: subfactor }, null, null, subfactor);
            }
            // return

            // console.log(me.singleValues);

            let groupByFactoS = me.singleValues.reduce((group, product) => {
                const { factor } = product;
                group[factor] = group[factor] ? group[factor] : [];
                group[factor].push(product);
                return group;
            }, {});

            let groupByFactoM = me.marriedValues.reduce((group, product) => {
                const { factor } = product;
                group[factor] = group[factor] ? group[factor] : [];
                group[factor].push(product);
                return group;
            }, {});
            //grouped by factor
            // console.log(JSON.stringify(groupByFacto, null, 2));

            console.log(groupByFactoS[factor].reduce((n, { value }) => n + value, 0));

            me.factorScoreSingle[factor] = groupByFactoS[factor].reduce((n, { value }) => n + value, 0);
            // me.factorScoreSingle[factor] = me.sumArr(me.singleValues);
            me.factorScoreMarried[factor] = groupByFactoM[factor].reduce((n, { value }) => n + value, 0);

            console.log({ singleSum: me.factorScoreMarried[factor] });
            console.log({ marriedSum: me.factorScoreSingle[factor] });

            let selectedSituation = [];
            selectedSituation[0] = this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;

            /*      console.log({ fs: factor })


                 console.log(criterion.id) */
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
