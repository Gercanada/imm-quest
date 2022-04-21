export default {
    props: ["maritialStatus"],
    selectedSubfactor: null,
    data() {
        return {
            loading: false,
            data: [],
            scenarios: [],
            selectedSubfactor: {},
            factorScoreMarried: {},
            factorScoreSingle: {},
            singleValues: [],
            marriedValues: [],
            subfactorsArr: [],
            mutableMaritialStatus: this.maritialStatus
        };
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            alert(this.mutableMaritialStatus);
            let me = this;
            axios.get("/factors").then(function(response) {
                me.data = response.data ? response.data[0] : [];
                me.scenarios = response.data[1] ? response.data[1] : [];
                console.log(me.scenarios);

                let scenario = null;
                if (me.scenarios.length > 0) {

                    me.scenarios.forEach((element) => {
                        if ("is_theactual" in element) {
                            if (element["is_theactual"] == true) {
                                scenario = element;
                            }
                        }
                    });
                    if (scenario != null) {
                        alert('here')
                        me.mutableMaritialStatus = scenario['is_married'] == false ? 'Single' : 'Married';
                        alert(me.mutableMaritialStatus);
                        me.$emit("mutableMaritialStatus", me.mutableMaritialStatus);
                    } else {
                        alert('crash')
                    }
                } else {
                    alert('crash')
                }

            });


        },

        criteriaVal(factor, subfactor) {
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
            console.log({ ForSingleValues: me.singleValues });
            console.log({ forMarried: me.marriedValues });

            me.factorScoreSingle[factor] = sumArr(me.singleValues);
            me.factorScoreMarried[factor] = sumArr(me.marriedValues);

            let selectedSituation = [];
            selectedSituation[0] = this.mutableMaritialStatus;
            selectedSituation[1] = this.scenarios;

            if (this.mutableMaritialStatus === "Single") {
                selectedSituation[2] = me.singleValues;
            } else {
                selectedSituation[2] = me.marriedValues;
            }
            this.$emit("selectedSituation", selectedSituation);
        },
    },
};