<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <div class="form-check form-check-inline" id="maritial-status">
            <input
              class="form-check-input material-inputs"
              type="radio"
              :name="copyId + 'matrialStatusCopy'"
              :id="copyId + 'isSingleCopy'"
              :checked="maritialStatusCopy == 'Single'"
              @change="changeStatus('Single')"
            />
            <label class="form-check-label" :for="copyId + 'isSingleCopy'">Soltero</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input material-inputs"
              type="radio"
              :name="copyId + 'matrialStatusCopy'"
              :id="copyId + 'isMarriedCopy'"
              :checked="maritialStatusCopy == 'Married'"
              @change="changeStatus('Married')"
            />
            <label class="form-check-label" :for="copyId + 'isMarriedCopy'">Casado</label>
          </div>
        </div>

        <div class="col-md-2">
          <button
            class="btn btn-outline-info waves-effect waves-light"
            type="button"
            @click="saveScennarioCopy"
          >
            <span class="btn-label"> <i class="fas fa-save"></i></span> Guardar cambios en
            escenario
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
          <button
            class="btn btn-outline-danger waves-effect waves-light"
            type="button"
            @click="deleteScennary(copyId)"
          >
            <span class="btn-label"><i class="fas fa-trash-alt"></i></span> Eliminar
            escenario
          </button>
        </div>
      </div>
      <!-- Accordions -->
      <div class="row">
        <div class="col-12">
          <div id="accordion" class="custom-accordion mb-4">
            <div
              class="card mb-0"
              v-for="object in data"
              v-show="maritialStatusCopy === 'Single' ? object.factor.id != 5 : true"
            >
              <div class="card-header" id="headingOne">
                <div class="row">
                  <div class="col-8">
                    <h5 class="m-0">
                      <a
                        class="custom-accordion-title d-block pt-2 pb-2"
                        data-toggle="collapse"
                        :href="'#collapse' + object.factor.id"
                        aria-expanded="false"
                        :aria-controls="'collapse' + object.factor.id"
                      >
                        {{ object.factor.title + " " + object.factor.sub_title }}
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
                      :value="
                        maritialStatusCopy === 'Married'
                          ? factorScoreMarried[object.factor.id]
                          : factorScoreSingle[object.factor.id]
                      "
                      class="form-control float-right"
                    />
                  </div>
                </div>
              </div>

              <div
                :id="'collapse' + object.factor.id"
                class="collapse"
                aria-labelledby="headingOne"
                data-parent="#accordion"
              >
                <div class="card-body">
                  <div class="form-group">
                    <div class="row" v-for="subfactor in object.factor.subfactors">
                      <div class="col-6">
                        {{ subfactor.subfactor }}
                      </div>
                      <div class="col-4">
                        <select
                          class="form-control"
                          id="select2-search-hide"
                          style="width: 100%; height: 36px"
                          @change="criteriaVal"
                          v-model="selectedSubfactor.selections[subfactor.id]"
                        >
                          <option
                            v-for="criterion in subfactor.criteria"
                            :value="{
                              criterion,
                              factor: object.factor.id,
                              subfactor: subfactor.id,
                            }"
                            :class="criterion.selected ? 'bg-success' : ''"
                          >
                            {{ criterion.criterion }}
                          </option>
                        </select>
                      </div>

                      <div class="col-2">
                        <input
                          type="text"
                          class="form-control"
                          :value="
                            selectedSubfactor != undefined &&
                            selectedSubfactor.selections != undefined &&
                            selectedSubfactor.selections[subfactor.id] != undefined &&
                            'criterion' in selectedSubfactor.selections[subfactor.id]
                              ? maritialStatusCopy === 'Married' &&
                                selectedSubfactor.selections[
                                  subfactor.id
                                ].criterion.hasOwnProperty('married')
                                ? selectedSubfactor.selections[subfactor.id].criterion
                                    .married
                                : maritialStatusCopy === 'Single' &&
                                  selectedSubfactor.selections[
                                    subfactor.id
                                  ].criterion.hasOwnProperty('single')
                                ? selectedSubfactor.selections[subfactor.id].criterion
                                    .single
                                : 'a'
                              : 'b'
                          "
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["body", "factors", "maritialSituation", "copyId", "scennarioName"],
  data() {
    return {
      data: [],
      selectedSubfactor: {
        selections: [],
      },
      singleValues: [],
      marriedValues: [],
      maritialStatusCopy: "",
      factorScore: {},
      factorScoreMarried: {},
      factorScoreSingle: {},
      selectedCriterion: {},
      arraySums: [],
      selectedSituation: [],
      singleSelectedSituation: [],
      marriedSelectedSituation: [],
    };
  },
  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      let me = this;
      let arr = [];
      let body = JSON.parse(me.body);
      me.maritialStatusCopy = me.maritialSituation === 1 ? "Married" : "Single";
      if (me.factors.length > 0 && body.length > 0) {
        me.factors.forEach((factor) => {
          let items = [];
          body.forEach((item) => {
            if (item["factor"] === factor.id && factor.subfactors.length > 0) {
              factor.subfactors.forEach((subfactor) => {
                if (item["subfactor"] === subfactor.id) {
                  subfactor.criteria.forEach((criterion) => {
                    if (item["criterion"] == criterion.id) {
                      criterion.selected = true;
                      me.criteriaVal({
                        criterion: criterion,
                        factor: factor.id,
                        subfactor: subfactor.id,
                      });
                    } else {
                      criterion.selected = false;
                    }
                  });
                }
              });
            }
          });
          arr.push({ items: items, factor: factor });
        });
      }
      me.data = arr;
    },

    criteriaVal(event) {
      console.log("Criterionn changed");
      let me = this;
      let newVal = null;
      let existingS = null;
      let existingM = null;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      me.selectedSubfactor.selections[newVal.subfactor] = {
        criterion: newVal.criterion,
        factor: newVal.factor,
        subfactor: newVal.subfactor,
      };

      let factor = newVal.factor;
      let subfactor = newVal.subfactor;
      let criterion = newVal.criterion;

      me.singleValues.sort(function (a, b) {
        return a.subfactor - b.subfactor;
      });

      me.singleValues.forEach((element) => {
        if (element["factor"] == factor && element["subfactor"] == subfactor) {
          existingS = element;
          element["criterion"] = criterion.id;
          element["value"] = criterion.single != null ? criterion.single : 0;
        }
      });

      if (!existingS) {
        me.singleValues.push({
          factor,
          subfactor,
          criterion: criterion.id,
          value: criterion.single != null ? criterion.single : 0,
        });
      }

      me.marriedValues.forEach((element) => {
        //Find factor and subfactor for replace criterion value
        if (element["factor"] == factor && element["subfactor"] == subfactor) {
          existingM = element;
          element["criterion"] = criterion.id;
          element["value"] = criterion.married != null ? criterion.married : 0;
          //replace
        }
      });

      if (!existingM) {
        me.marriedValues.push({
          factor,
          subfactor,
          criterion: criterion.id,
          value: criterion.married != null ? criterion.married : 0,
        });
      }
      me.factorScoreMarried[factor] = 0;
      me.factorScoreSingle[factor] = 0;

      if (me.singleValues.length > 0) {
        let groupByFactoS = me.singleValues.reduce((group, product) => {
          const { factor } = product;
          group[factor] = group[factor] ? group[factor] : [];
          group[factor].push(product);
          return group;
        }, {});
        me.factorScoreSingle[factor] = groupByFactoS[factor].reduce(
          (n, { value }) => n + value,
          0
        );
      }

      if (me.marriedValues.length > 0) {
        let groupByFactoM = me.marriedValues.reduce((group, product) => {
          const { factor } = product;
          group[factor] = group[factor] ? group[factor] : [];
          group[factor].push(product);
          return group;
        }, {});

        me.factorScoreMarried[factor] = groupByFactoM[factor].reduce(
          (n, { value }) => n + value,
          0
        );
      }
      //grouped by factor
      let selectedSituation = [];
      let sSelectedSituation = [];
      let mSelectedSituation = [];

      selectedSituation[0] = me.maritialStatusCopy;
      me.selectedCriterion[subfactor] = criterion.id;

      sSelectedSituation[1] = me.singleValues;
      me.factorScore[factor] = me.factorScoreSingle[factor];
      me.singleSelectedSituation = sSelectedSituation;

      me.selectedCriterion[criterion.id] = criterion.married;
      mSelectedSituation[1] = me.marriedValues;
      me.factorScore[factor] = me.factorScoreMarried[factor];
      me.marriedSelectedSituation = mSelectedSituation;

      console.log({
        selectedSituation: [me.marriedSelectedSituation, me.singleSelectedSituation],
      });

      //Create or update scores array to emmit to another file
      let hasSumS = null;
      let hasSumM = null;

      me.arraySums.forEach((element) => {
        if (
          "singleSum" in element &&
          "factor" in element["singleSum"] &&
          element["singleSum"].factor === factor
        ) {
          hasSumS = element;
          element["singleSum"]["sum"] = me.factorScoreSingle[factor];
        }
      });

      me.arraySums.forEach((element) => {
        if (
          "marriedSum" in element &&
          "factor" in element["marriedSum"] &&
          element["marriedSum"].factor === factor
        ) {
          hasSumM = element;
          element["marriedSum"]["sum"] = me.factorScoreMarried[factor];
        }
      });

      if (!hasSumS) {
        me.arraySums.push({
          singleSum: {
            factor: factor,
            sum: me.factorScoreSingle[factor],
          },
        });
      }
      if (!hasSumM) {
        me.arraySums.push({
          marriedSum: {
            factor: factor,
            sum: me.factorScoreMarried[factor],
          },
        });
      }
    },

    changeStatus(value) {
      this.copyId = this.copyId;
      this.maritialStatusCop = value;
      console.log(this.copyId, this.maritialStatusCop);

      this.maritialStatusCopy = value;
    },

    saveScennarioCopy() {
      let me = this;
      let scenario = null;

      Swal.fire({
        title: "Guardar cambios en  " + me.scennarioName,
        type: "warning",
        showDenyButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          console.log(me.marriedSelectedSituation);
          console.log(me.singleSelectedSituation);
          console.log(me.maritialStatusCopy);
          let request = {
            scennarioId: me.copyId ? me.copyId : "crash",
            maritialStatus: me.maritialStatusCopy,
            actualSituation:
              me.maritialStatusCopy == "Married"
                ? me.marriedSelectedSituation
                : me.singleSelectedSituation,
          };

          console.log({ request });
          if ("value" in result) {
            axios.post("save-situation", request).then(function (response) {
              Swal.fire({
                type: "success",
                title: "Escenario guardado",
                text:
                  "Se ha" + scenario == null
                    ? "creado"
                    : "actualizado" + "este escenario",
              });

              me.$emit("CallReloader", Date.now());

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
      /* Save scennario as copy of current on view */
      let me = this;
      Swal.fire({
        title: "Guardar copia de  : " + me.scennarioName,
        type: "warning",
        text: "Ingrese nombre para la nueva copia ",
        input: "text",
        showDenyButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          if ("value" in result) {
            if (!result.value) {
              Swal.fire({
                type: "danger",
                title: "Ingrese algo en el campo nombre",
                timer: 3000,
              });
            } else {
              let request = {
                scennarioId: me.copyId ? me.copyId : "crash",
                scenarioName: result.value,
                maritialStatus: me.maritialStatusCopy,
                actualSituation:
                  me.maritialStatusCopy == "Married"
                    ? me.marriedSelectedSituation
                    : me.singleSelectedSituation,
              };

              axios.post("copy", request).then(function (response) {
                Swal.fire({
                  type: "success",
                  title: "Escenario guardado",
                  text: "Se ha guardado su copia exitosamente ",
                });
                console.log(response);
                me.$emit("CallReloader", Date.now());
              });
            }
          } else {
            Swal.fire({ type: "info", title: "No será guardado", timer: 3000 });
          }
        })
        .catch(function (error) {
          console.error(error);
        });
    },

    deleteScennary(id) {
      let me = this;
      Swal.fire({
        title: "Desea eliminar el escenario " + me.scennarioName + "?",
        type: "warning",
        icon: "trash",
        showDenyButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "red",
        showCancelButton: true,
      }).then(() => {
        axios
          .post("/delete/" + id)
          .then((response) => {
            Swal.fire({
              type: "success",
              title: "Escenario eliminado",
              text: "Se ha eliminado el escenario",
            });
            me.$emit("CallReloader", Date.now());
          })
          .catch((error) => {
            console.error(error);
          });
      });
    },
  },
};
</script>
