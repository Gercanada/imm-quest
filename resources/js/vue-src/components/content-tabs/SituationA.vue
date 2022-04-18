<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
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

        <accordions :maritialStatus="maritialStatus" />
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
    };
  },
  mounted() {
    // console.log(this.$store.state.user.username);
  },
  methods: {
    changeStatus(value) {
      this.maritialStatus = value;
    },
  },
};
</script>
