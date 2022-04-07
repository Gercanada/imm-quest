<template>
  <div class="row">
    <div class="col-12">
      <form class="form-horizontal r-separator">
        <div class="card shadow-lg p-1">
          <div class="card-body">
            <h4 class="card-title">Event Registration</h4>
            <h6 class="card-subtitle">
              To use add <code>.r-separator</code> class in the form with form
              styling.
            </h6>
          </div>
          <hr class="mt-0" />
          <div class="card-body">
            <div class="form-group row align-items-center mb-0">
              <label
                for="inputEmail3"
                class="col-md-3 text-center control-label col-form-label"
                >Full Name</label
              >
              <div class="col-md-9 border-left pb-2 pt-2">
                <input
                  type="text"
                  class="form-control"
                  id="inputEmail3"
                  placeholder="Full Name Here"
                />
              </div>
            </div>
            <div class="form-group row align-items-center mb-0">
              <label
                for="inputEmail3"
                class="col-md-3 text-center control-label col-form-label"
                >Maritial status</label
              >
              <div class="col-md-9 border-left pb-2 pt-2">
                <input
                  name="radio-stacked"
                  type="radio"
                  id="customControlValidation2"
                  class="radio-col-indigo material-inputs"
                />
                <label for="customControlValidation2" class="mb-0 mt-2"
                  >Married</label
                >
                <input
                  name="radio-stacked"
                  type="radio"
                  id="customControlValidation3"
                  class="radio-col-indigo material-inputs"
                />
                <label for="customControlValidation3" class="mb-0 mt-2"
                  >Single</label
                >
                <input
                  name="radio-stacked"
                  type="radio"
                  id="customControlValidation4"
                  class="radio-col-indigo material-inputs"
                />
                <label for="customControlValidation4" class="mb-0 mt-2"
                  >other</label
                >
              </div>
            </div>
          </div>
          <hr class="mt-0 pt-1" />
          <div class="card-body">
            <h4 class="card-title mb-3">Default Tabs</h4>

            <ul class="nav nav-tabs mb-3">
              <li class="nav-item">
                <a
                  href="#home"
                  data-toggle="tab"
                  aria-expanded="false"
                  class="nav-link"
                >
                  <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Factor 1 </span>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#profile"
                  data-toggle="tab"
                  aria-expanded="true"
                  class="nav-link active"
                >
                  <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Factor 2 </span>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#settings"
                  data-toggle="tab"
                  aria-expanded="false"
                  class="nav-link"
                >
                  <i
                    class="mdi mdi-settings-outline d-lg-none d-block mr-1"
                  ></i>
                  <span class="d-none d-lg-block">Factor 3</span>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#maritials"
                  data-toggle="tab"
                  aria-expanded="false"
                  class="nav-link"
                >
                  <i
                    class="mdi mdi-maritials-outline d-lg-none d-block mr-1"
                  ></i>
                  <span class="d-none d-lg-block">Factor 4</span>
                </a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane" id="home">
                <div class="page-titles">
                  <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">
                      <span class="lstick d-inline-block align-middle"></span
                      >Factores centrales del Capital Humano
                    </h3>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edad</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="age in ages"
                        :key="age"
                        v-text="age.description"
                        :value="age.id"
                      ></option>
                    </select>

                    <h4 class="card-title">Educación</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="edu in educationOpts"
                        :key="edu"
                        v-text="edu.description"
                        :value="edu.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Reading</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageReadingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Listening</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageListenOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Writting</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageWrittingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - speaking</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageSpeakingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Segundo idioma</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in secondLanguageOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="tab-pane show active" id="profile">
                <div class="page-titles">
                  <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">
                      <span class="lstick d-inline-block align-middle"></span
                      >Transferibilidad de habilidades
                    </h3>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Education and Language</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="eduAndLan in educationAndLanguageOpts"
                        :key="eduAndLan"
                        v-text="eduAndLan.description"
                        :value="eduAndLan.id"
                      ></option>
                    </select>

                    <h4 class="card-title">
                      Education and Canadian Work Experience
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="CAWex in canadianWorkExperienceOpts"
                        :key="CAWex"
                        v-text="CAWex.description"
                        :value="CAWex.id"
                      ></option>
                    </select>
                    <h4 class="card-title">
                      Language and Foreign Work Experience
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="lfe in languageAndForeginExperienceOpts"
                        :key="lfe"
                        v-text="lfe.description"
                        :value="lfe.id"
                      ></option>
                    </select>
                    <h4 class="card-title">
                      Canadian Work Experience and Foreign Work Experience
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="foreingEx in CanadianAndForeingWorkExperience"
                        :key="foreingEx"
                        v-text="foreingEx.description"
                        :value="foreingEx.id"
                      ></option>
                    </select>
                    <h4 class="card-title">
                      Certificate of Qualification and Language
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="certLang in certificateQualificationAndLanguageOpts"
                        :key="certLang"
                        v-text="certLang.description"
                        :value="certLang.id"
                      ></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="settings">
                <div class="page-titles">
                  <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">
                      <span class="lstick d-inline-block align-middle"></span
                      >Puntos Adicionales
                    </h3>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">
                      Additional Points - Family member in Canada
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="fam in fMemberInCanadaOpts"
                        :key="fam"
                        v-text="fam.description"
                        :value="fam.id"
                      ></option>
                    </select>

                    <h4 class="card-title">Additional Points - Education</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="edu in apEducationOpts"
                        :key="edu"
                        v-text="edu.description"
                        :value="edu.id"
                      ></option>
                    </select>
                    <h4 class="card-title">
                      Additional Points - Job offer in Canada
                    </h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="apJob in apJobOfferInCaOpts"
                        :key="apJob"
                        v-text="apJob.description"
                        :value="apJob.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Additional Points - PNP</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="pnp in apPNPOpts"
                        :key="pnp"
                        v-text="pnp.description"
                        :value="pnp.id"
                      ></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="maritials">
                <div class="page-titles">
                  <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">
                      <span class="lstick d-inline-block align-middle"></span
                      >Atributos de la pareja (en caso de que aplique)
                    </h3>
                  </div>
                </div>
                <!-- Mate Attributes if apply -->
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edad</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="age in ages"
                        :key="age"
                        v-text="age.description"
                        :value="age.id"
                      ></option>
                    </select>

                    <h4 class="card-title">Educación</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="edu in educationOpts"
                        :key="edu"
                        v-text="edu.description"
                        :value="edu.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Reading</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageReadingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Listening</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageListenOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - Writting</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageWrittingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Idioma - speaking</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in languageSpeakingOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                    <h4 class="card-title">Segundo idioma</h4>
                    <h6 class="card-subtitle">
                      To use add <code>selected</code> to any particuler menu.
                    </h6>
                    <select
                      class="select2 form-control custom-select"
                      style="width: 100%; height: 36px"
                    >
                      <option>Select</option>
                      <option
                        v-for="read in secondLanguageOpts"
                        :key="read"
                        v-text="read.description"
                        :value="read.id"
                      ></option>
                    </select>
                  </div>
                </div>
                <!-- Mate Attributes -->
              </div>
            </div>
          </div>
          <hr class="mt-0 pt-1" />

          <div class="card-body bg-light">
            <div class="form-group mb-0 text-center">
              <button
                type="submit"
                class="btn btn-info waves-effect waves-light"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-dark waves-effect waves-light"
              >
                Cancel
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ages: [],
      educationOpts: [],
      languageListenOpts: [],
      languageReadingOpts: [],
      languageWrittingOpts: [],
      languageSpeakingOpts: [],
      secondLanguageOpts: [],

      canadianWorkExperienceOpts: [],
      languageAndForeginExperienceOpts: [],
      CanadianAndForeingWorkExperience: [],
      certificateQualificationAndLanguageOpts: [],
      educationAndLanguageOpts: [],
      fMemberInCanadaOpts: [],
      apEducationOpts: [],
      apJobOfferInCaOpts: [],
      apPNPOpts: [],
      loading: false,
    };
  },
  mounted() {
    this.humanCaps();
  },
  methods: {
    humanCaps() {
      let me = this;
      axios
        .get("/questions")
        .then(function (response) {
          console.log(response);
          const questions = response.data[0];
          const options = response.data[1];
          const factors = response.data[2];
          for (let i = 0; i < options.length; i++) {
            if (options[i].question_id === 1) {
              //Ages
              me.ages.push(options[i]);
            }
            if (options[i].question_id === 3) {
              //education options
              me.educationOpts.push(options[i]);
            }
            if (options[i].question_id === 4) {
              //Language Reading
              me.languageReadingOpts.push(options[i]);
            }
            if (options[i].question_id === 5) {
              //Language Listening
              me.languageListenOpts.push(options[i]);
            }
            if (options[i].question_id === 6) {
              //Language writing
              me.languageWrittingOpts.push(options[i]);
            }
            if (options[i].question_id === 7) {
              //Language speaking
              me.languageSpeakingOpts.push(options[i]);
            }
            if (options[i].question_id === 8) {
              //Language Level clb
              me.secondLanguageOpts.push(options[i]);
            }
            if (options[i].question_id === 9) {
              //Language Level carrer
              me.educationAndLanguageOpts.push(options[i]);
            }
            if (options[i].question_id === 10) {
              //work experience
              me.canadianWorkExperienceOpts.push(options[i]);
            }
            if (options[i].question_id === 11) {
              //work experience out
              me.languageAndForeginExperienceOpts.push(options[i]);
            }
            if (options[i].question_id === 12) {
              //work experience inn
              me.CanadianAndForeingWorkExperience.push(options[i]);
            }
            if (options[i].question_id === 13) {
              //COQ
              me.certificateQualificationAndLanguageOpts.push(options[i]);
            }
            if (options[i].question_id === 14) {
              //COQ
              me.fMemberInCanadaOpts.push(options[i]);
            }
            if (options[i].question_id === 15) {
              //COQ
              me.apEducationOpts.push(options[i]);
            }
            if (options[i].question_id === 16) {
              //COQ
              me.apJobOfferInCaOpts.push(options[i]);
            }
            if (options[i].question_id === 17) {
              //COQ
              me.apPNPOpts.push(options[i]);
            }
          }
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
