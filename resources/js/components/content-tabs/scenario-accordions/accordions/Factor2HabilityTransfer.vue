<template lang="html">
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-8">
                    <h5 class="m-0">
                        <a
                            class="custom-accordion-title d-block pt-2 pb-2"
                            data-toggle="collapse"
                            href="#collapseHabilityTransfer"
                            aria-expanded="true"
                            aria-controls="collapseHabilityTransfer"
                        >
                            Factor 2: Transferibilidad de actividades

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
            id="collapseHabilityTransfer"
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
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorAges"
                                v-model="selectedAge"
                            >
                                <option v-for="age in ages" :value="age">
                                    {{ age.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedAge['Married']
                                        : selectedAge['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- edad factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Experiencia laboral en canada</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorExperiency"
                                v-model="selectedExperiency"
                            >
                                <option
                                    v-for="experiency in experiencies"
                                    :value="experiency"
                                >
                                    {{ experiency.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedExperiency['Married']
                                        : selectedExperiency['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- experieccy factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Experiencia laboral en canada</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorEducation"
                                v-model="selectedEducation"
                            >
                                <option
                                    v-for="education in educations"
                                    :value="education"
                                >
                                    {{ education.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedEducation['Married']
                                        : selectedEducation['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- experieccy factor -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["maritialStatus"],
    data() {
        return {
            ages: [],
            selectedAge: "",
            selectedExperiency: "",
            experiencies: [],
            educations: [],
            selectedEducation: "",
        };
    },
    mounted() {
        this.getFactorAges();
        this.getFactorExperiency();
        this.getFactorEducation();
    },
    methods: {
        getFactorAges() {
            let me = this;
            axios.get("/factor-1/ages").then(function (response) {
                me.ages = response.data;
            });
        },
        getFactorExperiency() {
            let me = this;
            axios.get("/factor-1/work-experiency").then(function (response) {
                me.experiencies = response.data;
            });
        },
        getFactorEducation() {
            let me = this;
            axios.get("/factor-1/education").then(function (response) {
                me.educations = response.data;
            });
        },
    },
};
</script>
