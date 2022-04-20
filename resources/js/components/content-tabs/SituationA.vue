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
                checked
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
                @change="changeStatus('Married')"
              />
              <label class="form-check-label" for="isMarried">Casado</label>
            </div>
          </div>

          <div class="col-2">
            <button
              class="btn btn-outline-info waves-effect waves-light"
              type="button"
              @click="saveSituation"
            >
              <span class="btn-label"> <i class="fas fa-save"></i></span> Guardar
              Situacion actual
            </button>
          </div>
          <div class="col-2">
            <button
              class="btn btn-outline-success waves-effect waves-light"
              type="button"
            >
              <span class="btn-label"> <i class="fas fa-copy"></i></span> Copiar ecenario
            </button>
          </div>
          <div class="col-2">
            <button class="btn btn-outline-danger waves-effect waves-light" type="button">
              <span class="btn-label"><i class="fas fa-trash-alt"></i></span> Eliminar
              escenario
            </button>
          </div>
        </div>

        <accordions @selectedSituation="getSituation" :maritialStatus="maritialStatus" />
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
    };
  },
  mounted() {},
  methods: {
    changeStatus(value) {
      this.maritialStatus = value;
    },
    getSituation(value) {
      console.log({ "actual situation": value });
      this.scenarios = value[1];
      this.userActualSituation = value;
    },

    async saveSituation() {
      console.log(this);
      let me = this;
      Swal.fire({
        title: "Sera guardado como : Scenario " + Number(me.scenarios.length + 1),
        icon: "warning",
        text:
          "Si desea guardarlo con otro nombre, ingreselo en el campo. De lo contrario dejelo vacio.",
        input: "text",
        showConfirmButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          console.log(result);
          console.table(me.userActualSituation);
          axios
            .post("save-situation", {
              scenarioName: result.value
                ? result.value
                : "Scenario " + Number(me.scenarios.length + 1),
              actualSituation: me.userActualSituation,
            })
            .then(function (response) {
              console.log(response);
            });
        })
        .catch(function (error) {
          console.table(error);
        });
    },
  },
};
</script>
