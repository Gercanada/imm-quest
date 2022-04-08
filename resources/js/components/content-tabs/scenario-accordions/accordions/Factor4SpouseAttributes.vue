<template lang="html" v-if="maritialStatus === 'Married'">
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-8">
                    <h5 class="m-0">
                        <a
                            class="custom-accordion-title d-block pt-2 pb-2"
                            data-toggle="collapse"
                            href="#collapseSpouseAttributes"
                            aria-expanded="true"
                            aria-controls="collapseSpouseAttributes"
                        >
                            Factor 4: Atributos de pareja (en caso de que
                            aplique)
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
            id="collapseSpouseAttributes"
            class="collapse show"
            aria-labelledby="headingOne"
            data-parent="#accordion"
            style=""
        >
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse Can W. Exp</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getSubFactor('Spouse Can W. Exp')"
                                v-model="selectedCanWExperiency"
                            >
                                <option
                                    v-for="item in spouseCanWExperiencies"
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
                                        ? selectedCanWExperiency['Married']
                                        : selectedCanWExperiency['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- education and langs factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse Education</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getSubFactor('Spouse Education')"
                                v-model="selectedSpousedLanReading"
                            >
                                <option
                                    v-for="item in spouseEducations"
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
                                        ? selectedSpousedLanReading['Married']
                                        : selectedSpousedLanReading['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- education and canadian experiency factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse language | Reading</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor('Spouse language | Reading')
                                "
                                v-model="selectedSpousedLanWritting"
                            >
                                <option
                                    v-for="item in spouseLanguageReading"
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
                                        ? selectedSpousedLanWritting['Married']
                                        : selectedSpousedLanWritting['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- Language and Foeign Wok Experiencey factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse language | Writing</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor('Spouse language | Writing')
                                "
                                v-model="selectedSpousedLanWritting"
                            >
                                <option
                                    v-for="item in spouseLanguageWritting"
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
                                        ? selectedSpousedLanWritting['Married']
                                        : selectedSpousedLanWritting['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!--Canadian Wok Experience and Foeign Wok Experience factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse language | Listening</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor('Spouse language | Listening')
                                "
                                v-model="selectedSpousedListening"
                            >
                                <option
                                    v-for="item in spouseLanguageListening"
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
                                        ? selectedSpousedListening['Married']
                                        : selectedSpousedListening['Single']
                                "
                            />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Spouse language | Speaking</label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="
                                    getSubFactor('Spouse language | Speaking')
                                "
                                v-model="selectedSpousedSpeaking"
                            >
                                <option
                                    v-for="item in spouseLanguageSpeaking"
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
                                        ? selectedSpousedSpeaking['Married']
                                        : selectedSpousedSpeaking['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
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

            spouseCanWExperiencies: [],
            spouseEducations: [],
            spouseLanguageReading: [],
            spouseLanguageWritting: [],
            spouseLanguageListening: [],
            spouseLanguageSpeaking: [],

            selectedCanWExperiency: "",
            selectedSpousedLanReading: "",
            selectedSpousedLanWritting: "",
            selectedSpousedListening: "",
            selectedSpousedSpeaking: "",
        };
    },
    mounted() {
        this.getSubFactor("Spouse Can W. Exp");
        this.getSubFactor("Spouse Education");
        this.getSubFactor("Spouse language | Reading");
        this.getSubFactor("Spouse language | Writing");
        this.getSubFactor("Spouse language | Listening");
        this.getSubFactor("Spouse language | Speaking");
    },
    methods: {
        getSubFactor(subFactor) {
            let me = this;
            axios.get("/factor-2/" + subFactor).then(function (response) {
                if (subFactor === "Spouse Can W. Exp") {
                    me.spouseCanWExperiencies = response.data;
                }
                if (subFactor === "Spouse Education") {
                    me.spouseEducations = response.data;
                }
                if (subFactor === "Spouse language | Reading") {
                    me.spouseLanguageReading = response.data;
                }
                if (subFactor === "Spouse language | Writing") {
                    me.spouseLanguageWritting = response.data;
                }
                if (subFactor === "Spouse language | Listening") {
                    me.spouseLanguageListening = response.data;
                }
                if (subFactor === "Spouse language | Speaking") {
                    me.selectedSpousedSpeaking = response.data;
                }
            });
            this.sumScore();
        },

        sumScore() {
            console.log(this.maritialStatus);
            this.scoreForMarried =
                (this.selectedCanWExperiency["Married"]
                    ? Number(this.selectedCanWExperiency["Married"])
                    : 0) +
                (this.selectedSpousedLanReading["Married"]
                    ? Number(this.selectedSpousedLanReading["Married"])
                    : 0) +
                (this.selectedSpousedLanWritting["Married"]
                    ? Number(this.selectedSpousedLanWritting["Married"])
                    : 0) +
                (this.selectedSpousedListening["Married"]
                    ? Number(this.selectedSpousedListening["Married"])
                    : 0) +
                (this.selectedSpousedSpeaking["Married"]
                    ? Number(this.selectedSpousedSpeaking["Married"])
                    : 0);

            /*  this.scoreForSingle =
                (this.selectedCanWExperiency["Single"]
                    ? Number(this.selectedCanWExperiency["Single"])
                    : 0) +
                (this.selectedSpousedLanReading["Single"]
                    ? Number(this.selectedSpousedLanReading["Single"])
                    : 0) +
                (this.selectedSpousedLanWritting["Single"]
                    ? Number(this.selectedSpousedLanWritting["Single"])
                    : 0) +
                (this.selectedSpousedListening["Single"]
                    ? Number(this.selectedSpousedListening["Single"])
                    : 0) +
                (this.selectedSpousedSpeaking["Single"]
                    ? Number(this.selectedSpousedSpeaking["Single"])
                    : 0); */
        },
    },
};
</script>
