<template lang="html">
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-8">
                    <h5 class="m-0">
                        <a
                            class="custom-accordion-title d-block pt-2 pb-2"
                            data-toggle="collapse"
                            href="#collapseAddittionalPoints"
                            aria-expanded="true"
                            aria-controls="collapseAddittionalPoints"
                        >
                            Factor 3: Puntos adicionales
                            <span class="float-right"
                                ><i
                                    class="mdi mdi-chevron-down accordion-arrow"
                                ></i>
                            </span>
                        </a>
                    </h5>
                </div>
                <div class="col-4">
                    <input
                        type="text"
                        disabled
                        :value="
                            maritialStatus === 'Married'
                                ? scoreForMarried
                                : scoreForSingle
                        "
                        class="form-control float-right"
                    />
                </div>
            </div>
        </div>
        <div
            id="collapseAddittionalPoints"
            class="collapse show"
            aria-labelledby="headingOne"
            data-parent="#accordion"
            style=""
        >
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label
                                >Additional Points | Family Member in
                                Canada</label
                            >
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor(
                                        'Additional Points | Family Member in Canada'
                                    )
                                "
                                v-model="selectedFamilyMember"
                            >
                                <option
                                    v-for="item in familyMembers"
                                    :value="item"
                                >
                                    {{ item.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedFamilyMember['Married']
                                        : selectedFamilyMember['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- education and langs factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Additional Points | Education</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor(
                                        'Additional Points | Education'
                                    )
                                "
                                v-model="selectedEducationAddPoints"
                            >
                                <option
                                    v-for="item in educationAdditionalPoints"
                                    :value="item"
                                >
                                    {{ item.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedEducationAddPoints['Married']
                                        : selectedEducationAddPoints['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- education and canadian experiency factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Additional Points | Job Offer</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor(
                                        'Additional Points | Job Offer'
                                    )
                                "
                                v-model="selectedJobOfferAddPoints"
                            >
                                <option
                                    v-for="item in jobOfferAdditionalPoints"
                                    :value="item"
                                >
                                    {{ item.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedJobOfferAddPoints['Married']
                                        : selectedJobOfferAddPoints['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- Language and Foeign Wok Experiencey factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Additional Points | PNP</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor('Additional Points | PNP')
                                "
                                v-model="selectedPnp"
                            >
                                <option
                                    v-for="item in PNPAdditionalPoints"
                                    :value="item"
                                >
                                    {{ item.Criterion }}
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <input
                                type="text"
                                class="form-control"
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedPnp['Married']
                                        : selectedPnp['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!--Canadian Wok Experience and Foeign Wok Experience factor -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["maritialStatus"],
    data() {
        return {
            scoreForMarried: 0,
            scoreForSingle: 0,

            familyMembers: [],
            educationAdditionalPoints: [],
            jobOfferAdditionalPoints: [],
            PNPAdditionalPoints: [],

            LangCertificateQualifications: [],
            selectedFamilyMember: "",
            selectedEducationAddPoints: "",
            selectedJobOfferAddPoints: "",
            selectedPnp: "",
        };
    },
    mounted() {
        this.getSubFactor("Additional Points | Family Member in Canada");
        this.getSubFactor("Additional Points | Education");
        this.getSubFactor("Additional Points | Job Offer");
        this.getSubFactor("Additional Points | PNP");
    },
    methods: {
        getSubFactor(subFactor) {
            let me = this;
            axios.get("/factor-2/" + subFactor).then(function (response) {
                if (
                    subFactor === "Additional Points | Family Member in Canada"
                ) {
                    me.familyMembers = response.data;
                }
                if (subFactor === "Additional Points | Education") {
                    me.educationAdditionalPoints = response.data;
                }
                if (subFactor === "Additional Points | Job Offer") {
                    me.jobOfferAdditionalPoints = response.data;
                }
                if (subFactor === "Additional Points | PNP") {
                    me.PNPAdditionalPoints = response.data;
                }
            });
            this.sumScore();
        },

        sumScore() {
            console.log(this.maritialStatus);
            this.scoreForMarried =
                (this.selectedFamilyMember["Married"]
                    ? Number(this.selectedFamilyMember["Married"])
                    : 0) +
                (this.selectedEducationAddPoints["Married"]
                    ? Number(this.selectedEducationAddPoints["Married"])
                    : 0) +
                (this.selectedJobOfferAddPoints["Married"]
                    ? Number(this.selectedJobOfferAddPoints["Married"])
                    : 0) +
                (this.selectedPnp["Married"]
                    ? Number(this.selectedPnp["Married"])
                    : 0);

            this.scoreForSingle =
                (this.selectedFamilyMember["Single"]
                    ? Number(this.selectedFamilyMember["Single"])
                    : 0) +
                (this.selectedEducationAddPoints["Single"]
                    ? Number(this.selectedEducationAddPoints["Single"])
                    : 0) +
                (this.selectedJobOfferAddPoints["Single"]
                    ? Number(this.selectedJobOfferAddPoints["Single"])
                    : 0) +
                (this.selectedPnp["Single"]
                    ? Number(this.selectedPnp["Single"])
                    : 0);
        },
    },
};
</script>
