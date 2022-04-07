<template>
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-8">
                    <h5 class="m-0">
                        <a
                            class="custom-accordion-title d-block pt-2 pb-2"
                            data-toggle="collapse"
                            href="#collapseOne"
                            aria-expanded="true"
                            aria-controls="collapseOne"
                        >
                            Factor 1: Factores centrales del capital humano

                            <span class="float-right"
                                ><i
                                    class="mdi mdi-chevron-down accordion-arrow"
                                ></i
                            ></span>
                        </a>
                    </h5>
                </div>
                <div class="col-4">
                    <input
                        type="text"
                        disabled
                        value="100"
                        class="form-control float-right"
                    />
                </div>
            </div>
        </div>
        <div
            id="collapseOne"
            class="collapse show"
            aria-labelledby="headingOne"
            data-parent="#accordion"
            style=""
        >
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Edad</label>
                        </div>
                        <div class="col-4" id="maritial-status">
                            {{ maritialStatus }}
                            <!--  <situation-a :matrial_status= /> -->
                            <!-- <SituationA :maritialStatus="maritialStatus" /> -->
                            <!-- <label for="">{{ maritialStatus }}</label> -->
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                            >
                                <!-- @change="selectAge()" -->

                                <option v-for="age in ages">
                                    {{ age.Criterion }}
                                </option>
                                <!-- <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup> -->
                            </select>
                        </div>

                        <div class="col-4">
                            <!--   <input
                                type="text"
                                class="form-control"
                                disabled
                                :value="
                                    maritialStatus === 'single'
                                        ? age.single
                                        : age.married
                                "
                            /> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: { maritialStatus: String },
    data() {
        return {
            ages: [],
            // maritialStatus: "",
        };
    },
    mounted() {
        this.getFactorAges();
    },

    methods: {
        getFactorAges() {
            let me = this;
            axios.get("/factor-1/ages").then(function (response) {
                console.log(response);
                me.ages = response.data;
            });
        },

        selectAge() {
            console.log("here");
        },
    },
};
</script>
