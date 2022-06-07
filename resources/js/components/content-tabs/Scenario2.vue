<template>
  <div class="card">
    <div class="card-header">
      <div class="row justify-content-end">
        <div class="col-md-3 align-self-end">
          <button
            class="btn btn-outline-info waves-effect waves-light"
            type="button"
            @click="saveScennarioCopy"
          >
            <span class="btn-label"> <i class="fas fa-save"></i></span> {{ save }}
          </button>
        </div>
        <div class="col-md-3 align-self-end">
          <button
            class="btn btn-outline-success waves-effect waves-light"
            type="button"
            @click="copyScennario()"
          >
            <span class="btn-label"> <i class="fas fa-copy"></i></span> {{ copy }}
          </button>
        </div>
        <div class="col-md-3 align-self-end">
          <button
            class="btn btn-outline-danger waves-effect waves-light"
            type="button"
            @click="deleteScennary(copyId)"
          >
            <span class="btn-label"><i class="fas fa-trash-alt"></i></span>{{ deleteSc }}
          </button>
        </div>
      </div>
    </div>
    <div class="card-body shadow">
      <div class="row row justify-content-center shadow mb-4 mt-1">
        <div class="col-lg-6 col-md-12 pb-2">
          <div class="form-check form-check-inline" id="maritial-status">
            <input
              class="form-check-input material-inputs"
              type="radio"
              :name="copyId + 'matrialStatusCopy'"
              :id="copyId + 'isSingleCopy'"
              :checked="maritialStatusCopy == 'Single'"
              @change="changeStatus('Single')"
            />
            <label class="form-check-label" :for="copyId + 'isSingleCopy'">{{
              single
            }}</label>
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
            <label class="form-check-label" :for="copyId + 'isMarriedCopy'">{{
              married
            }}</label>
          </div>
        </div>
      </div>
      <!-- Accordions -->
      <div class="row">
        <div class="col-md-12 p-0">
          <div id="accordion" class="custom-accordion">
            <div
              class="card shadow-lg mb-4 rounded"
              v-for="object in data"
              v-show="maritialStatusCopy === 'Single' ? object.factor.id != 3 : true"
            >
              <div class="card-header" id="headingOne">
                <div class="row">
                  <div class="col-lg-8 col-md-6">
                    <h5 class="m-0">
                      <a
                        class="custom-accordion-title d-block align-items-center"
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
                  <div class="col-lg-4 col-md-6">
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
                    <div
                      class="row shadow p-1 mb-2 rounded"
                      v-for="subfactor in object.factor.subfactors"
                    >
                      <div class="col-lg-6 col-md-4">
                        {{ subfactor.subfactor }}
                      </div>
                      <div class="col-lg-4 col-md-4">
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

                      <div class="col-lg-2 col-md-4">
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
                                : 0
                              : 0
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
  props: ["body", "factors", "maritialSituation", "copyId", "scennarioName", "language"],
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
      single: this.language == "es" ? "Soltero" : "Single",
      married: this.language == "es" ? "Casado" : "Married",
      copy: this.language == "es" ? "Copiar escenario" : "Copy scennary",
      save: this.language == "es" ? "Guardar cambios" : "Save changes",
      deleteSc: this.language == "es" ? " Eliminar escenario" : "Delete this scennary",
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
      //   console.log("Criterionn changed");
      let me = this;
      let newVal = null;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      let factor = newVal.factor;
      let subfactor = newVal.subfactor;
      let criterion = newVal.criterion;

      me.selectedSubfactor.selections[subfactor] = {
        criterion: criterion,
        factor: factor,
        subfactor: subfactor,
      };

      //Limit sum for factor 3
      if (factor === 4 || factor === 5) {
        me.selectedSubfactor.selections.forEach((element, index) => {
          if (element.factor === 4) {
            if (
              me.selectedSubfactor.selections[index].subfactor == 17 &&
              me.selectedSubfactor.selections[index - 1] &&
              me.selectedSubfactor.selections[index - 1].subfactor == 16 &&
              me.selectedSubfactor.selections[index - 1].criterion.single >= 50
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 106,
                  //   criterion:
                  //     "No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.",
                  single: 0,
                  married: 0,
                  subfactor_id: 17,
                  selected: true,
                },
                factor: 4,
                subfactor: 17,
              };
            }
            //
            if (
              me.selectedSubfactor.selections[index].subfactor == 16 &&
              me.selectedSubfactor.selections[index].criterion.single < 50 &&
              me.selectedSubfactor.selections[index + 1] &&
              me.selectedSubfactor.selections[index + 1].subfactor == 17 &&
              me.selectedSubfactor.selections[index + 1].criterion.single >= 50
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 101,
                  //   criterion:
                  //     "No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.",
                  single: 0,
                  married: 0,
                  subfactor_id: 16,
                  selected: true,
                },
                factor: 4,
                subfactor: 16,
              };
            }
            //19
            if (
              me.selectedSubfactor.selections[index].subfactor == 19 &&
              me.selectedSubfactor.selections[index - 1] &&
              me.selectedSubfactor.selections[index - 1].subfactor == 18 &&
              (me.selectedSubfactor.selections[index - 1].criterion.single >= 50 ||
                (me.selectedSubfactor.selections[index + 1] &&
                  (me.selectedSubfactor.selections[index + 1].criterion.single >= 50 ||
                    me.selectedSubfactor.selections[index + 1].criterion.single +
                      me.selectedSubfactor.selections[index - 1].criterion.single >=
                      50)))
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 116,
                  //   criterion:
                  //     "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                  single: 0,
                  married: 0,
                  subfactor_id: 19,
                },
                factor: 4,
                subfactor: 19,
              };
            }
            // 18
            if (
              me.selectedSubfactor.selections[index].subfactor == 18 &&
              me.selectedSubfactor.selections[index].criterion.single < 50 &&
              me.selectedSubfactor.selections[index + 1] &&
              me.selectedSubfactor.selections[index + 1].subfactor == 19 &&
              (me.selectedSubfactor.selections[index + 1].criterion.single >= 50 ||
                (me.selectedSubfactor.selections[index + 2] &&
                  ((me.selectedSubfactor.selections[index + 2].subfactor == 20 &&
                    me.selectedSubfactor.selections[index + 2].criterion.single >= 50) ||
                    me.selectedSubfactor.selections[index + 1].criterion.single +
                      me.selectedSubfactor.selections[index + 2].criterion.single >=
                      50)))
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 111,
                  //   criterion:
                  //     "No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.",
                  single: 0,
                  married: 0,
                  subfactor_id: 18,
                },
                factor: 4,
                subfactor: 18,
              };
            }
            //20
            if (
              me.selectedSubfactor.selections[index].subfactor == 20 &&
              me.selectedSubfactor.selections[index - 1] &&
              me.selectedSubfactor.selections[index - 1].subfactor == 19 &&
              (me.selectedSubfactor.selections[index - 1].criterion.single >= 50 ||
                (me.selectedSubfactor.selections[index - 2] &&
                  me.selectedSubfactor.selections[index - 2].subfactor == 18 &&
                  (me.selectedSubfactor.selections[index - 2].criterion.single >= 50 ||
                    (me.selectedSubfactor.selections[index - 2].subfactor == 18 &&
                      me.selectedSubfactor.selections[index - 1].criterion.single +
                        me.selectedSubfactor.selections[index - 2].criterion.single >=
                        50))))
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 116,
                  //   criterion:
                  //     "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                  single: 0,
                  married: 0,
                  subfactor_id: 20,
                },
                factor: 4,
                subfactor: 20,
              };
            }
          }

          //Max 600
          if (element.factor === 5) {
            if (
              me.selectedSubfactor.selections[index].subfactor == 21 &&
              me.selectedSubfactor.selections[index + 2] &&
              me.selectedSubfactor.selections[index + 2].subfactor === 23 &&
              me.selectedSubfactor.selections[index + 2].criterion.single >= 600
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 124,
                  //   criterion: "Sin estudios en Canadá o menos de 1 año de duración.",
                  single: 0,
                  married: 0,
                  subfactor_id: 21,
                },
                factor: 5,
                subfactor: 21,
              };
            }

            if (
              me.selectedSubfactor.selections[index].subfactor == 22 &&
              me.selectedSubfactor.selections[index + 1] &&
              me.selectedSubfactor.selections[index + 1].subfactor === 23 &&
              me.selectedSubfactor.selections[index + 1].criterion.single >= 600
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 127,
                  //   criterion: "Sin oferta de trabajo laboral.",
                  single: 0,
                  married: 0,
                  subfactor_id: 22,
                },
                factor: 5,
                subfactor: 22,
              };
            }
            if (
              me.selectedSubfactor.selections[index].subfactor == 24 &&
              me.selectedSubfactor.selections[index - 1].subfactor === 23 &&
              me.selectedSubfactor.selections[index - 1].criterion.single >= 600
            ) {
              me.selectedSubfactor.selections[index] = {
                criterion: {
                  id: 132,
                  //   criterion: "Sin familiar directo en Canadá",
                  single: 0,
                  married: 0,
                  subfactor_id: 24,
                },
                factor: 5,
                subfactor: 24,
              };
            }
          }
        });
      }

      me.singleValues.sort(function (a, b) {
        return a.subfactor - b.subfactor;
      });

      me.selectedSubfactor.selections.forEach((selection) => {
        let existingS = null;
        let existingM = null;

        me.singleValues.forEach((element) => {
          if (
            element["factor"] == selection.factor &&
            element["subfactor"] == selection.subfactor
          ) {
            existingS = element;
            element["criterion"] = selection.criterion.id;
            element["value"] =
              selection.criterion.single != null ? selection.criterion.single : 0;
          }
        });

        if (!existingS) {
          me.singleValues.push({
            factor: selection.factor,
            subfactor: selection.subfactor,
            criterion: selection.criterion.id,
            value: selection.criterion.single != null ? selection.criterion.single : 0,
          });
        }

        me.marriedValues.forEach((element) => {
          //Find factor and subfactor for replace criterion value
          if (
            element["factor"] == selection.factor &&
            element["subfactor"] == selection.subfactor
          ) {
            existingM = element;
            element["criterion"] = selection.criterion.id;
            element["value"] =
              selection.criterion.married != null ? selection.criterion.married : 0;
            //replace
          }
        });

        if (!existingM) {
          me.marriedValues.push({
            factor: selection.factor,
            subfactor: selection.subfactor,
            criterion: selection.criterion.id,
            value: selection.criterion.married != null ? selection.criterion.married : 0,
          });
        }
        /*
         */
      });

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

      /*  console.log({
        selectedSituation: [me.marriedSelectedSituation, me.singleSelectedSituation],
      }); */

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
      //   console.log(this.copyId, this.maritialStatusCop);

      this.maritialStatusCopy = value;
    },

    saveScennarioCopy() {
      let me = this;
      let scenario = null;

      Swal.fire({
        title:
          (me.language == "es" ? "Guardar cambios en  " : "Save changes to") +
          me.scennarioName,
        type: "warning",
        showDenyButton: true,
        showCancelButton: true,
      })
        .then(function (result) {
          let request = {
            scennarioId: me.copyId ? me.copyId : "crash",
            maritialStatus: me.maritialStatusCopy,
            actualSituation:
              me.maritialStatusCopy == "Married"
                ? me.marriedSelectedSituation
                : me.singleSelectedSituation,
          };

          if ("value" in result) {
            axios
              .post("save-situation", request)
              .then(function (response) {
                Swal.fire({
                  type: "success",
                  title: me.language == "es" ? "Escenario guardado" : "Saved scennary",
                  text:
                    me.language == "es"
                      ? "Se ha" + scenario == null
                        ? "creado"
                        : "actualizado" + " este escenario"
                      : "Was" + scenario == null
                      ? "created"
                      : "updated" + " This scennary",
                });
                me.$emit("CallReloader", Date.now());
                window.location.reload();
              })
              .catch(function (error) {
                console.table(error);
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
          console.table(error);
        });
    },

    copyScennario() {
      /* Save scennario as copy of current on view */
      let me = this;
      Swal.fire({
        title:
          (me.language == "es" ? "Guardar copia de  : " : "Save copy of: ") +
          me.scennarioName,
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
                scennarioId: me.copyId ? me.copyId : "crash",
                scenarioName: result.value,
                maritialStatus: me.maritialStatusCopy,
                actualSituation:
                  me.maritialStatusCopy == "Married"
                    ? me.marriedSelectedSituation
                    : me.singleSelectedSituation,
              };

              axios.post("copy", request).then(function (response) {
                // console.log(response);
                if (response.data == "has_max") {
                  Swal.fire({
                    type: "warning",
                    title:  me.language == "es"
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
                    title:  me.language == "es" ? "Escenario guardado" : "Saved Scenario",
                      text:
                        me.language == "es"
                          ? "Se ha guardado su copia exitosamente "
                          : "Your copy has been saved successfully",
                      timer: 3000,
                  });
                  me.$emit("CallReloader", Date.now());
                  window.location.reload();
                }
              });
            }
          } else {
            Swal.fire({ type: "info", title: me.language == "es" ? "No será guardado" : "Will not be saved", timer: 3000 });
          }
        })
        .catch(function (error) {
          console.error(error);
        });
    },

    deleteScennary(id) {
      let me = this;
      Swal.fire({
        title:  (me.language == "es" ? "Desea eliminar el escenario ":"Really wish to delete " )+ me.scennarioName + "?",
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
              title: me.language == "es" ? "Escenario eliminado":"Deleted scennary",
              text: me.language == "es" ? "Se ha eliminado el escenario":"Scennary was deleted",
            });
            me.$emit("CallReloader", Date.now());
            window.location.reload();
          })
          .catch((error) => {
            console.error(error);
          });
      });
    },
  },
};
</script>
