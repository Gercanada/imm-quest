<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
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

          <div class="col-md-2">
            <button
              class="btn btn-outline-info waves-effect waves-light"
              type="button"
              @click="saveSituation"
            >
              <span class="btn-label"> <i class="fas fa-save"></i></span> Guardar
              Situacion actual
            </button>
          </div>
          <div class="col-md-2">
            <button
              class="btn btn-outline-success waves-effect waves-light"
              type="button"
              @click="copyScennario()"
            >
              <span class="btn-label"> <i class="fas fa-copy"></i></span> Copiar ecenario
            </button>
          </div>
          <div class="col-md-2">
            <button class="btn btn-outline-danger waves-effect waves-light" type="button">
              <span class="btn-label"><i class="fas fa-trash-alt"></i></span> Eliminar
              escenario
            </button>
          </div>
        </div>
        <accordions
          @sumScore="getScore"
          @factorNames="getFactors"
          @selectedSituation="getSituation"
          @mutableMaritialStatus="getUserData"
          @MaritialStatusChanged="maritialChanged"
          :maritialStatus="maritialStatus"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Accordions from "./scenario-accordions/Accordions.vue";
export default {
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
    };
  },
  methods: {
    getUserData(value) {
      this.maritialStatus = value;
    },

    changeStatus(value) {
      //   console.log("changed");
      this.maritialStatus = value;
    },

    maritialChanged(value) {
      console.log("changed emmit");
      this.$emit("maritialChanged", value);
      console.log(value);
    },

    getSituation(value) {
      console.log("getted");
      let scenario = null;
      let me = this;
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
          me.maritialStatus = scenario["is_married"] == false ? "Single" : "Married";
        }
      }
      this.$emit("selectedSituation", me.userActualSituation);
    },

    async saveSituation() {
      let me = this;
      if (me.scenarios.length === 0) {
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

        Swal.fire({
          title:
            "Sera guardado como : " +
            (scenario == null
              ? "Scenario " + Number(me.scenarios.length + 1)
              : scenario["name"]),
          type: "warning",
          text:
            "Si desea guardarlo con otro nombre, ingreselo en el campo. De lo contrario dejelo vacio.",
          input: "text",

          showDenyButton: true,
          showCancelButton: true,
        })
          .then(function (result) {
            if ("value" in result) {
              axios
                .post("save-situation", {
                  scenarioName: result.value
                    ? result.value
                    : "Scenario " + Number(me.scenarios.length + 1),
                  actualSituation: me.userActualSituation,
                })
                .then(function (response) {
                  Swal.fire({
                    type: "success",
                    title: "Escenario guardado",
                    text:
                      "Se ha" + scenario == null
                        ? "creado"
                        : "actualizado" + "este escenario",
                  });
                  console.log(response);
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

    getFactors(value) {
      console.log("factors");
      this.$emit("FactorsTitles", value);
      this.factors = value;
      //   let factors = value;
    },

    getScore(value) {
      console.log("getScore");
      this.$emit("scoresArr", value);
      this.scores = value[0];
    },

    copyScennario() {
      /* Save scennario as copy of current on view */
      let me = this;
      console.log(me.userActualSituation[2]);

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
          title:
            "Sera guardado como : " +
            (scenario == null
              ? "Scenario " + Number(me.scenarios.length + 1)
              : scenario["name"]),
          type: "warning",
          text:
            "Si desea guardarlo con otro nombre, ingreselo en el campo. De lo contrario dejelo vacio.",
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
                })
                .then(function (response) {
                  Swal.fire({
                    type: "success",
                    title: "Escenario guardado",
                    text:
                      "Se ha" + scenario == null
                        ? "creado"
                        : "actualizado" + "este escenario",
                  });
                  console.log(response);
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
