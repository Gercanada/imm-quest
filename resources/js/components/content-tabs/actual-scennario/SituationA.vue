<template>
  <div>
    <div class="card">
      <div class="card-header">
        <div class="row justify-content-end">
          <div class="col-md-3 align-self-end" v-if="authenticated">
            <button
              class="btn btn-outline-info waves-effect waves-light"
              type="button"
              @click="saveSituation"
            >
              <span class="btn-label"> <i class="fas fa-save"></i></span> Guardar
              Escenario actual
            </button>
          </div>
          <div class="col-md-3 align-self-end" v-if="authenticated">
            <button
              class="btn btn-outline-success waves-effect waves-light"
              type="button"
              @click="copyScennario()"
            >
              <span class="btn-label"> <i class="fas fa-copy"></i></span> Copiar ecenario
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
              <label class="form-check-label" for="isSingle">Soltero</label>
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
              <label class="form-check-label" for="isMarried">Casado</label>
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
        />
      </div>
    </div>
  </div>
</template>

<script>
import Accordions from "../actual-scennario/scenario-accordions/Accordions.vue";
export default {
  props: ["reloader", "authenticated"],
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
    };
  },
  methods: {
    getUserData(value) {
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
        title: "Guardar Escenario actual ",
        type: "warning",
        text:
          "Guardar Escenario actual. A partir de este escenario podra crear otros nuevos para comparar y etc.",
        showDenyButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          if ("value" in result) {
            axios
              .post("save-situation", {
                scenarioName: "Escenario actual",
                actualSituation: me.userActualSituation,
                maritialStatus: me.maritialStatus,
              })
              .then(function (response) {
                Swal.fire({
                  type: "success",
                  title: "Escenario guardado",
                  text:
                    "Se ha" + scenario == null
                      ? "creado"
                      : "actualizado" + " este escenario",
                });
                let now = Date.now();
                me.reloader2 = now;
                // console.log(me.reloader2);
                me.$emit("reloader", now);
                window.location.reload();
                console.log(response);
              });
          } else {
            Swal.fire({ type: "info", title: "No será guardado", timer: 3000 });
          }
        })
        .catch(function (error) {
          console.table(error);
        });
    },

    copyScennario() {
      let me = this;
      if (!me.userActualSituation[2].length > 0) {
        Swal.fire({
          type: "warning",
          title: "Nada para guardar",
          text: "No ha hecho ningun cambio. No hay nada que guardar.",
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
          title: "Guardar copia de Escenario actual como : ",

          type: "warning",
          text: "Ingrese nombre para la nueva copia",
          input: "text",
          showDenyButton: true,
          showCancelButton: true,
        })
          .then(function (result) {
            if ("value" in result) {
              axios
                .post("copy", {
                  scenarioName: result.value
                    ? result.value
                    : "Scenario " + Number(me.scenarios.length + 1),
                  actualSituation: me.userActualSituation,
                  maritialStatus: me.maritialStatus,
                  isActual: true,
                })
                .then(function (response) {
                  console.log(response);
                  if (response.data == "has_max") {
                    Swal.fire({
                      type: "warning",
                      title: "Limite de escenarios completo",
                      text:
                        "Ya tiene 3 escenarios, No puede crear otro nuevo a menos que elimine alguno(s)",
                    });
                  } else {
                    Swal.fire({
                      type: "success",
                      title: "Escenario guardado",
                      text:
                        "Se ha" + scenario == null
                          ? "creado"
                          : "actualizado" + "este escenario",
                    });
                    let now = Date.now();
                    me.reloader2 = now;
                    console.log(response);
                    window.location.reload();
                    this.$emit("reloader", now);
                  }
                });
            } else {
              Swal.fire({ type: "info", title: "No será guardado", timer: 3000 });
            }
          })
          .catch(function (error) {
            console.table(error);
          });
      }
    },
  },
};
</script>
