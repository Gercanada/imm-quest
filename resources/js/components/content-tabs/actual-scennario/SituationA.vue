<template>
  <div>
    <div class="card">
      <!-- <h1 class="bg-success">{{ language }}</h1> -->
      <div class="card-header">
        <div class="row justify-content-end">
          <div class="col-md-3 align-self-end" v-if="authenticated">
            <button
              class="btn btn-outline-info waves-effect waves-light"
              type="button"
              @click="saveSituation"
            >
              <span class="btn-label"> <i class="fas fa-save"></i></span>{{ save }}
            </button>
          </div>
          <div class="col-md-3 align-self-end" v-if="authenticated">
            <button
              class="btn btn-outline-success waves-effect waves-light"
              type="button"
              @click="copyScennario()"
            >
              <span class="btn-label"> <i class="fas fa-copy"></i></span> {{ copy }}
            </button>
          </div>
        </div>
      </div>
      <div class="card-body shadow">
        <!--  <div class="shadow-sm "> -->
        <div class="row justify-content-center shadow mb-4 mt-1">
          <div class="col-lg-6 col-md-12 pb-2">
            <div class="form-check form-check-inline" id="maritial-status">
              <input
                class="form-check-input material-inputs"
                type="radio"
                name="matrialStatus"
                id="isSingle"
                value="Single"
                :checked="maritialStatus == 'Single'"
                @change="changeStatus('Single')"
              />
              <label class="form-check-label" for="isSingle">{{ single }}</label>
            </div>
            <div class="form-check form-check-inline">
              <input
                class="form-check-input material-inputs"
                type="radio"
                name="matrialStatus"
                id="isMarried"
                value="Married"
                :checked="maritialStatus == 'Married'"
                @change="changeStatus('Married')"
              />
              <label class="form-check-label" for="isMarried">{{ married }}</label>
            </div>
          </div>
        </div>
        <accordions
          @sumScore="getScore"
          @factorNames="getFactors"
          @selectedSituation="getSituation"
          @mutableMaritialStatus="getUserData"
          @MaritialStatusChanged="maritialChanged"
          @additionalScennarios="getExtraScennarios"
          @factorsWithSubfactors="getFactsWSubfacts"
          :maritialStatus="maritialStatus"
          :reloader2="reloader2"
          :authenticated="authenticated"
          :language="language"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Accordions from "../actual-scennario/scenario-accordions/Accordions.vue";
export default {
  props: ["reloader", "authenticated", "language"],
  components: {
    Accordions,
  },
  data() {
    return {
      maritialStatus: "Single",
      scenarioName: "",
      scenarios: [],
      userActualSituation: [],
      scores: [],
      Factors: [],
      reloader2: null,
      single: this.language == "es" ? "Soltero" : "Single",
      married: this.language == "es" ? "Casado" : "Married",
      copy: this.language == "es" ? "Copiar escenario" : "Copy scennary",
      save: this.language == "es" ? "Guardar situacion actual" : "Save actual situation",
    };
  },
  methods: {
    getUserData(value) {
      //   alert(this.language);
      this.maritialStatus = value;
    },

    changeStatus(value) {
      this.maritialStatus = value;
    },

    getFactsWSubfacts(value) {
      this.$emit("factorsWithSubfactors", value);
    },

    maritialChanged(value) {
      this.$emit("maritialChanged", value);
    },

    getExtraScennarios(value) {
      this.$emit("additionalScennarios", value);
    },

    getSituation(value) {
      let scenario = null;
      let me = this;
      let changed = value[0] ? value[0] : null;
      me.scenarios = value[1];
      me.userActualSituation = value;
      if (me.scenarios.length > 0) {
        me.scenarios.forEach((element) => {
          if ("is_theactual" in element) {
            if (element["is_theactual"] == true) {
              scenario = element;
            }
          }
        });
        if (scenario != null) {
          me.maritialStatus =
            changed != null
              ? changed
              : scenario["is_married"] == false
              ? "Single"
              : "Married";
        }
      }
      this.$emit("selectedSituation", me.userActualSituation);
    },

    getFactors(value) {
      this.$emit("FactorsTitles", value);
      this.factors = value;
    },

    getScore(value) {
      this.$emit("scoresArr", value);
      this.scores = value[0];
    },

    saveSituation() {
      let me = this;
      let scenario = null;
      if (me.scenarios.length > 0) {
        me.scenarios.forEach((element) => {
          if ("is_theactual" in element) {
            if (element["is_theactual"] == true) {
              scenario = element;
            }
          }
        });
      }

      Swal.fire({
        title:
          me.language == "es" ? "Guardar Escenario actual " : "Save actual scennario",
        type: "warning",
        text:
          me.language == "es"
            ? "Guardar Escenario actual. A partir de este escenario podra crear otros nuevos para comparar y etc."
            : "Save Current Scenario. From this scenario you could create new ones to compare and etc.",
        showDenyButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          if ("value" in result) {
            axios
              .post("save-situation", {
                scenarioName:
                  me.language == "es" ? "Escenario actual" : "Actual scennary",
                actualSituation: me.userActualSituation,
                maritialStatus: me.maritialStatus,
              })
              .then(function (response) {
                Swal.fire({
                  type: "success",
                  title: me.language == "es" ? "Escenario guardado" : "Saved Scennary",
                  text:
                    me.language == "es"
                      ? "Se ha" + scenario == null
                        ? "creado"
                        : "actualizado" + " este escenario"
                      : "Was" + scenario == null
                      ? "created"
                      : "updated" + " This scennary",
                });
                window.location.reload();
              });
          } else {
            Swal.fire({
              type: "info",
              title:
                me.language == "es"
                  ? "No será guardado. Debe ingresar un nombre"
                  : "It will not be saved. You must enter a name",
              timer: 3000,
            });
          }
        })
        .catch(function (error) {
          console.error(error);
        });
    },

    copyScennario() {
      let me = this;
      if (!me.userActualSituation[2].length > 0) {
        Swal.fire({
          type: "warning",
          title: me.language == "es" ? "Nada para guardar" : "nothing to save",
          text:
            me.language == "es"
              ? "No ha hecho ningun cambio. No hay nada que guardar."
              : "He hasn't made any changes. There is nothing to save.",
        });
      } else {
        let scenario = null;
        me.scenarios.forEach((element) => {
          if ("is_theactual" in element) {
            if (element["is_theactual"] == true) {
              scenario = element;
            }
          }
        });
        //copy of
        Swal.fire({
          title:
            me.language == "es"
              ? "Guardar copia de Escenario actual como : "
              : "Save copy of Current Scenario as : ",
          type: "warning",
          text:
            me.language == "es"
              ? "Ingrese nombre para la nueva copia"
              : "Enter a name for the new copy",
          input: "text",
          showDenyButton: true,
          showCancelButton: true,
        })
          .then(function (result) {
            if ("value" in result) {
              if (!result.value) {
                Swal.fire({
                  type: "danger",
                  title:
                    me.language == "es"
                      ? "Ingrese algo en el campo nombre"
                      : "Enter something in the name field",
                  timer: 3000,
                });
              } else {
                let request = {
                  scenarioName: result.value,
                  actualSituation: me.userActualSituation,
                  maritialStatus: me.maritialStatus,
                  isActual: true,
                };

                axios.post("copy", request).then(function (response) {
                  //   console.log(response);
                  if (response.data == "has_max") {
                    Swal.fire({
                      type: "warning",
                      title:
                        me.language == "es"
                          ? "Limite de escenarios completo"
                          : "Full Scenario Limit",
                      text:
                        me.language == "es"
                          ? "Ya tiene 3 escenarios, No puede crear otro nuevo a menos que elimine alguno(s)"
                          : "You already have 3 scenarios, you can't create a new one unless you delete one(s)",
                      timer: 3000,
                    });
                  } else {
                    Swal.fire({
                      type: "success",
                      title:
                        me.language == "es" ? "Escenario guardado" : "Saved Scenario",
                      text:
                        me.language == "es"
                          ? "Se ha guardado su copia exitosamente "
                          : "Your copy has been saved successfully",
                      timer: 3000,
                    });
                    window.location.reload();
                  }
                });
              }
            } else {
              Swal.fire({
                type: "info",
                title: me.language == "es" ? "No será guardado" : "Will not be saved",
                timer: 3000,
              });
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      }
    },
  },
};
</script>
