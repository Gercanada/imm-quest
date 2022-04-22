import { some } from "lodash";

export default {
    props: ["maritialStatus"],
    // selectedSubfactor: null,
    data() {
        return {
            criterion: '',
            loading: false,
            data: [],
            scenarios: [],
            selectedSubfactor: {},
            factorScoreMarried: {},
            factorScoreSingle: {},
            singleValues: [],
            marriedValues: [],
            subfactorsArr: [],
            criterion: {},
            SelectedFactor: [],
            mutableMaritialStatus: this.maritialStatus
        };
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            let me = this;
            axios.get("/factors").then(function(response) {
                // me.data = response.data ? response.data[0] : [];
                me.scenarios = response.data[1] ? response.data[1] : [];
                console.log(me.data);

                let scenario = null; //actual

                if (me.scenarios.length > 0) {

                    me.scenarios.forEach((element) => {
                        if ("is_theactual" in element && element["is_theactual"] == true) {
                            scenario = element;
                            // return;
                        }
                    });

                    let factors = response.data ? response.data[0] : [];
                    let newData = [];

                    if (scenario != null &&
                        Array.isArray(JSON.parse(scenario['body'])) &&
                        JSON.parse(scenario['body']).length > 0
                    ) {
                        me.mutableMaritialStatus = scenario['is_married'] == false ? 'Single' : 'Married'; //get maritial status
                        me.$emit("mutableMaritialStatus", me.mutableMaritialStatus);

                        let body = JSON.parse(scenario['body']);

                        console.log({ factors }, { body });

                        factors.forEach(factor => {
                            let items = [];
                            body.forEach(item => {
                                if (item['factor'] === factor.id) {
                                    factor.subfactors.forEach(subfactor => {
                                        if (item['subfactor'] === subfactor.id) {
                                            subfactor.criteria.forEach(criterion => {
                                                if (item['criterion'] == criterion.id) {
                                                    items.push(item)
                                                    return;
                                                }
                                            });
                                        }
                                    });
                                }
                            })
                            newData.push({ items: items, factor: factor })
                        });
                    } else {
                        factors.forEach(factor => {
                            newData.push({ items: null, factor: factor })
                        });
                    }
                    me.data = newData;
                    console.log({ newData });

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

        factorWasSelected(x, y) {
            // console.log({ x }, { y });
            return x.some(i => i.factor === y.factorId);
            console.log(x.some(i => i.factor === y.factorId))


            /*
                        y.forEach(element => {
                            if(x.some(  ))

                        });
             */

            /*  this.SelectedFactor = [];
             this.SelectedFactor.push({ factor: selectedObj['factor'] }, { subfactor: selectedObj['subfactor'] }, {
                 criterion: selectedObj['criterion']
             });
             console.log({ selectedObj: this.SelectedFactor }); */
        },

        criteriaVal(factor, subfactor) {

            console.log({ subfactor })

            let me = this;
            me.subfactorsArr.sort(function(a, b) {
                return a - b;
            });
            me.singleValues.sort(function(a, b) {
                return a.subfactor - b.subfactor;
            });

            if (!me.subfactorsArr.includes(subfactor)) {
                me.subfactorsArr.push(subfactor);

                me.singleValues.push({
                    factor,
                    subfactor,
                    criterion: me.selectedSubfactor[subfactor].id,
                    value: me.selectedSubfactor[subfactor].single,
                });

                me.marriedValues.push({
                    factor,
                    subfactor,
                    criterion: me.selectedSubfactor[subfactor].id,
                    value: me.selectedSubfactor[subfactor].married,
                });
            } else {
                function replace(arr, obj, x, y, newValue) {
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
                }

                replace(
                    me.singleValues, { subfactor: subfactor }, { factor: factor }, { criterion: me.selectedSubfactor[subfactor].id },
                    me.selectedSubfactor[subfactor].single
                );

                replace(
                    me.marriedValues, { subfactor: subfactor }, { factor: factor }, { criterion: me.selectedSubfactor[subfactor].id },
                    me.selectedSubfactor[subfactor].married
                );
                replace(me.subfactorsArr, { subfactor: subfactor }, null, null, subfactor);
            }

            function sumArr(arr) {
                return arr.reduce(
                    (previousValue, currentValue) => previousValue + currentValue.value,
                    0
                );
            }
            /*  console.log({ ForSingleValues: me.singleValues });
             console.log({ forMarried: me.marriedValues }); */

            me.factorScoreSingle[factor] = sumArr(me.singleValues);
            me.factorScoreMarried[factor] = sumArr(me.marriedValues);

            let selectedSituation = [];
            selectedSituation[0] = this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;

            console.log(this.mutableMaritialStatus)
            if (this.mutableMaritialStatus === "Single") {
                selectedSituation[2] = me.singleValues;
            } else {
                selectedSituation[2] = me.marriedValues;
            }

            this.$emit("selectedSituation", selectedSituation);
        },
    },
};
