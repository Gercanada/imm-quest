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
              aria-expanded="false"
              aria-controls="collapseHabilityTransfer"
            >
              Factor 2: Transferibilidad de actividades
              <span class="float-right"
                ><i class="mdi mdi-chevron-down accordion-arrow"></i>
              </span>
            </a>
          </h5>
        </div>
        <div class="col-4">
          <input
            type="text"
            disabled
            :value="maritialStatus === 'Married' ? f2ScoreForMarried : f2ScoreForSingle"
            class="form-control float-right"
          />
        </div>
      </div>
    </div>
    <div
      id="collapseHabilityTransfer"
      class="collapse"
      aria-labelledby="headingOne"
      data-parent="#accordion"
      style=""
    >
      <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Education and language</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Education and Language')"
                v-model="selectedEdAndLan"
              >
                <option v-for="item in educationandlanguages" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
              <input
                type="text"
                class="form-control"
                :value="
                  maritialStatus === 'Married'
                    ? selectedEdAndLan['Married']
                    : selectedEdAndLan['Single']
                "
              />
            </div>
          </div>
        </div>
        <!-- education and langs factor -->
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Education and Canadian Wok Experience</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Education and Canadian Wok Experience')"
                v-model="selectedWorkExperiency"
              >
                <option v-for="item in canadianWorkExperiencies" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>
            <div class="col-2">
              <input
                type="text"
                class="form-control"
                :value="
                  maritialStatus === 'Married'
                    ? selectedWorkExperiency['Married']
                    : selectedWorkExperiency['Single']
                "
              />
            </div>
          </div>
        </div>
        <!-- education and canadian experiency factor -->
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Language and Foeign Wok Experience</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Language and Foeign Wok Experience')"
                v-model="selectedForeignLanExperiency"
              >
                <option v-for="item in ForeignLanWorkExperiencies" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
              <input
                type="text"
                class="form-control"
                :value="
                  maritialStatus === 'Married'
                    ? selectedForeignLanExperiency['Married']
                    : selectedForeignLanExperiency['Single']
                "
              />
            </div>
          </div>
        </div>
        <!-- Language and Foeign Wok Experiencey factor -->
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Canadian Wok Experience and Foeign Wok Experience</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="
                  getSubFactor('Canadian Wok Experience and Foeign Wok Experience')
                "
                v-model="selectedForeignAndCanadian"
              >
                <option v-for="item in ForeignAndCanadianWorkExperiencies" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
              <input
                type="text"
                class="form-control"
                :value="
                  maritialStatus === 'Married'
                    ? selectedForeignAndCanadian['Married']
                    : selectedForeignAndCanadian['Single']
                "
              />
            </div>
          </div>
        </div>
        <!--Canadian Wok Experience and Foeign Wok Experience factor -->
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Certificate of Qualification and Language</label>
            </div>
            <div class="col-4">
              <select
                class="form-control"
                id="select2-search-hide"
                style="width: 100%; height: 36px"
                @change="getSubFactor('Certificate of Qualification and Language')"
                v-model="selectedLangCertificateQualification"
              >
                <option v-for="item in LangCertificateQualifications" :value="item">
                  {{ item.Criterion }}
                </option>
              </select>
            </div>

            <div class="col-2">
              <input
                type="text"
                class="form-control"
                :value="
                  maritialStatus === 'Married'
                    ? selectedLangCertificateQualification['Married']
                    : selectedLangCertificateQualification['Single']
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
      f2ScoreForMarried: 0,
      f2ScoreForSingle: 0,
      educationandlanguages: [],
      canadianWorkExperiencies: [],
      ForeignLanWorkExperiencies: [],
      ForeignAndCanadianWorkExperiencies: [],
      LangCertificateQualifications: [],
      selectedEdAndLan: "",
      selectedWorkExperiency: "",
      selectedForeignLanExperiency: "",
      selectedForeignAndCanadian: "",
      selectedLangCertificateQualification: "",
    };
  },
  mounted() {
    this.getSubFactor("Education and Language");
    this.getSubFactor("Education and Canadian Wok Experience");
    this.getSubFactor("Language and Foeign Wok Experience");
    this.getSubFactor("Canadian Wok Experience and Foeign Wok Experience");
    this.getSubFactor("Certificate of Qualification and Language");
  },
  methods: {
    getSubFactor(subFactor) {
      let me = this;
      axios.get("/factor/" + subFactor).then(function (response) {
        if (subFactor === "Education and Language") {
          me.educationandlanguages = response.data;
        }
        if (subFactor === "Education and Canadian Wok Experience") {
          console.log(response.data);
          me.canadianWorkExperiencies = response.data;
        }
        if (subFactor === "Language and Foeign Wok Experience") {
          console.log(response.data);
          me.ForeignLanWorkExperiencies = response.data;
        }
        if (subFactor === "Canadian Wok Experience and Foeign Wok Experience") {
          console.log(response.data);
          me.ForeignAndCanadianWorkExperiencies = response.data;
        }
        if (subFactor === "Certificate of Qualification and Language") {
          console.log(response.data);
          me.LangCertificateQualifications = response.data;
        }
      });
      this.sumScore();
    },

    sumScore() {
      // console.log(this.maritialStatus);
      this.f2ScoreForMarried =
        (this.selectedEdAndLan["Married"]
          ? Number(this.selectedEdAndLan["Married"])
          : 0) +
        (this.selectedWorkExperiency["Married"]
          ? Number(this.selectedWorkExperiency["Married"])
          : 0) +
        (this.selectedForeignLanExperiency["Married"]
          ? Number(this.selectedForeignLanExperiency["Married"])
          : 0) +
        (this.selectedForeignAndCanadian["Married"]
          ? Number(this.selectedForeignAndCanadian["Married"])
          : 0) +
        (this.selectedLangCertificateQualification["Married"]
          ? Number(this.selectedLangCertificateQualification["Married"])
          : 0);

      this.f2ScoreForSingle =
        (this.selectedEdAndLan["Single"] ? Number(this.selectedEdAndLan["Single"]) : 0) +
        (this.selectedWorkExperiency["Single"]
          ? Number(this.selectedWorkExperiency["Single"])
          : 0) +
        (this.selectedForeignLanExperiency["Single"]
          ? Number(this.selectedForeignLanExperiency["Single"])
          : 0) +
        (this.selectedForeignAndCanadian["Single"]
          ? Number(this.selectedForeignAndCanadian["Single"])
          : 0) +
        (this.selectedLangCertificateQualification["Single"]
          ? Number(this.selectedLangCertificateQualification["Single"])
          : 0);
    },
  },
};
</script>
