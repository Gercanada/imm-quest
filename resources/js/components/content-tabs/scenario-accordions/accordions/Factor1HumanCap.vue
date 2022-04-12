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
                ><i class="mdi mdi-chevron-down accordion-arrow"></i
              ></span>
            </a>
          </h5>
        </div>
        <div class="col-4">
          <input
            type="text"
            disabled
            :value="maritialStatus === 'Married' ? f1ScoreForMarried : f1ScoreForSingle"
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
            <div class="col-6">
              <label>Edad</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Age')"
                v-model="selectedAge"
              >
                <option v-for="age in ages" :value="age">
                  {{ age.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Experiencia laboral en canada</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Canada Experience')"
                v-model="selectedExperiency"
              >
                <option v-for="experiency in experiencies" :value="experiency">
                  {{ experiency.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Educacion</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Education')"
                v-model="selectedEducation"
              >
                <option v-for="education in educations" :value="education">
                  {{ education.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Idioma | reading </label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Language | Reading')"
                v-model="selectedLanguageReading"
              >
                <option v-for="item in readinglangs" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Idioma | listening </label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Language | Listening')"
                v-model="selectedLanguageListening"
              >
                <option v-for="item in listeninglangs" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Idioma | writting </label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Language | Writing')"
                v-model="selectedLanguageWritting"
              >
                <option v-for="item in writtinglangs" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
            <div class="col-6">
              <label>Segundo idioma </label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Second Language')"
                v-model="selectedSecondLanguage"
              >
                <option v-for="item in speakinglangs" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
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
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    maritialStatus: String,
  },
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
      f1ScoreForMarried: 0,
      f1ScoreForSingle: 0,
    };
  },
  mounted() {
    this.getSubFactor("Age");
    this.getSubFactor("Canada Experience");
    this.getSubFactor("Education");
    this.getSubFactor("Language | Reading");
    this.getSubFactor("Language | Writing");
    this.getSubFactor("Language | Listening");
    this.getSubFactor("Language | Speaking");
    this.getSubFactor("Second Language");
    this.sumScore();
  },

  methods: {
    getSubFactor(subFactor) {
      let me = this;
      axios.get("/factor/" + subFactor).then(function (response) {
        if (subFactor === "Age") {
          me.ages = response.data;
        }
        if (subFactor === "Canada Experience") {
          me.experiencies = response.data;
        }
        if (subFactor === "Education") {
          me.educations = response.data;
        }
        if (subFactor === "Language | Reading") {
          me.readinglangs = response.data;
        }
        if (subFactor === "Language | Writing") {
          me.writtinglangs = response.data;
        }
        if (subFactor === "Language | Listening") {
          me.listeninglangs = response.data;
        }
        if (subFactor === "Language | Speaking") {
          me.speakinglangs = response.data;
        }
        if (subFactor === "Second Language") {
          me.secondlangs = response.data;
        }
      });
      this.sumScore();
    },

    sumScore() {
      this.f1ScoreForMarried =
        (Number(this.selectedAge["Married"]) ? Number(this.selectedAge["Married"]) : 0) +
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

      this.f1ScoreForSingle =
        (Number(this.selectedAge["Single"]) ? Number(this.selectedAge["Single"]) : 0) +
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

      this.$emit("sumScore", [this.f1ScoreForMarried, this.f1ScoreForSingle]);
    },
  },
};
</script>
