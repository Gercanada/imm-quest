<template lang="html">
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-8">
                    <h5 class="m-0">
                        <a
                            class="custom-accordion-title d-block pt-2 pb-2"
                            data-toggle="collapse"
                            href="#collapseHumanCap"
                            aria-expanded="true"
                            aria-controls="collapseHumanCap"
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
            id="collapseHumanCap"
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
                                disabled
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
                                disabled
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
                                disabled
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Idioma | reading </label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorLanguageReading"
                                v-model="selectedLanguageReading"
                            >
                                <option
                                    v-for="item in readinglangs"
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
                                disabled
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedLanguageReading['Married']
                                        : selectedLanguageReading['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- language reading factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Idioma | listening </label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorLanguageListening"
                                v-model="selectedLanguageListening"
                            >
                                <option
                                    v-for="item in listeninglangs"
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
                                disabled
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedLanguageListening['Married']
                                        : selectedLanguageListening['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- language listening factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Idioma | writting </label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorLanguageWritting"
                                v-model="selectedLanguageWritting"
                            >
                                <option
                                    v-for="item in writtinglangs"
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
                                disabled
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedLanguageWritting['Married']
                                        : selectedLanguageWritting['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- language listening factor -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Segundo idioma </label>
                        </div>
                        <div class="col-4">
                            <select
                                class="form-control"
                                id="select2-search-hide"
                                style="width: 100%; height: 36px"
                                @change="getFactorSecondLanguage"
                                v-model="selectedSecondLanguage"
                            >
                                <option
                                    v-for="item in speakinglangs"
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
                                disabled
                                :value="
                                    maritialStatus === 'Married'
                                        ? selectedSecondLanguage['Married']
                                        : selectedSecondLanguage['Single']
                                "
                            />
                        </div>
                    </div>
                </div>
                <!-- second  language  factor -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["maritialStatus"],
    data() {
        return {
            selectedAge: "",
            ages: [],
            selectedExperiency: "",
            experiencies: [],
            educations: [],
            selectedEducation: "",
            selectedLanguageReading: "",
            readinglangs: [],

            selectedLanguageWritting: "",
            writtinglangs: [],
            selectedLanguageSpeaking: "",
            speakinglangs: [],
            selectedLanguageListening: "",
            listeninglangs: [],
            selectedSecondLanguage: "",
            secondlangs: [],
            totalScore: 0,

            // scAge: 0,

            scoreForMarried: 0,
            scoreForSingle: 0,
        };
    },
    mounted() {
        this.getFactorAges();
        this.getFactorExperiency();
        this.getFactorEducation();
        this.getFactorLanguageReading();
        this.getFactorLanguageReading();
        this.getFactorLanguageWritting();
        this.getFactorLanguageListening();
        this.getFactorLanguageSpeaking();
        this.sumScore();
    },
    methods: {
        getFactorAges() {
            let me = this;
            axios.get("/factor-1/ages").then(function (response) {
                me.ages = response.data;
            });
            this.sumScore();
        },
        getFactorExperiency() {
            let me = this;
            axios.get("/factor-1/work-experiency").then(function (response) {
                me.experiencies = response.data;
            });
            this.sumScore();
        },
        getFactorEducation() {
            let me = this;
            axios.get("/factor-1/education").then(function (response) {
                me.educations = response.data;
            });
            this.sumScore();
        },

        getFactorLanguageReading() {
            let me = this;
            axios.get("/factor-1/language-reading").then(function (response) {
                me.readinglangs = response.data;
            });
            this.sumScore();
        },
        getFactorLanguageWritting() {
            let me = this;
            axios.get("/factor-1/language-writting").then(function (response) {
                me.writtinglangs = response.data;
            });
            this.sumScore();
        },
        getFactorLanguageListening() {
            let me = this;
            axios.get("/factor-1/language-listening").then(function (response) {
                me.listeninglangs = response.data;
            });
            this.sumScore();
        },
        getFactorLanguageSpeaking() {
            let me = this;
            axios.get("/factor-1/language-listening").then(function (response) {
                me.speakinglangs = response.data;
            });
            this.sumScore();
        },
        getFactorSecondLanguage() {
            let me = this;
            axios.get("/factor-1/second-language").then(function (response) {
                me.secondlangs = response.data;
            });
            this.sumScore();
        },

        sumScore() {
            this.scoreForMarried =
                (Number(this.selectedAge["Married"])
                    ? Number(this.selectedAge["Married"])
                    : 0) +
                (Number(this.selectedExperiency["Married"])
                    ? Number(this.selectedExperiency["Married"])
                    : 0) +
                (Number(this.selectedEducation["Married"])
                    ? Number(this.selectedEducation["Married"])
                    : 0) +
                (Number(this.selectedLanguageReading["Married"])
                    ? Number(this.selectedLanguageReading["Married"])
                    : 0) +
                (Number(this.selectedLanguageWritting["Married"])
                    ? Number(this.selectedLanguageWritting["Married"])
                    : 0) +
                (Number(this.selectedLanguageSpeaking["Married"])
                    ? Number(this.selectedLanguageSpeaking["Married"])
                    : 0) +
                (Number(this.selectedLanguageListening["Married"])
                    ? Number(this.selectedLanguageListening["Married"])
                    : 0) +
                (Number(this.selectedSecondLanguage["Married"])
                    ? Number(this.selectedSecondLanguage["Married"])
                    : 0);
            this.scoreForSingle =
                (Number(this.selectedAge["Single"])
                    ? Number(this.selectedAge["Single"])
                    : 0) +
                (Number(this.selectedExperiency["Single"])
                    ? Number(this.selectedExperiency["Single"])
                    : 0) +
                (Number(this.selectedEducation["Single"])
                    ? Number(this.selectedEducation["Single"])
                    : 0) +
                (Number(this.selectedLanguageReading["Single"])
                    ? Number(this.selectedLanguageReading["Single"])
                    : 0) +
                (Number(this.selectedLanguageWritting["Single"])
                    ? Number(this.selectedLanguageWritting["Single"])
                    : 0) +
                (Number(this.selectedLanguageSpeaking["Single"])
                    ? Number(this.selectedLanguageSpeaking["Single"])
                    : 0) +
                (Number(this.selectedLanguageListening["Single"])
                    ? Number(this.selectedLanguageListening["Single"])
                    : 0) +
                (Number(this.selectedSecondLanguage["Single"])
                    ? Number(this.selectedSecondLanguage["Single"])
                    : 0);
        },
    },
};
</script>
