<template>
  <div class="row">
    <div class="col-12">
      <div id="accordion" class="custom-accordion mb-4">
        <!-- <div class="card mb-0" v-for="factor in data">
          <div class="card-header" id="headingOne">
            <div class="row">
              <div class="col-8">
                <h5 class="m-0">
                  <a
                    class="custom-accordion-title d-block pt-2 pb-2"
                    data-toggle="collapse"
                    :href="'#collapse' + factor.id"
                    aria-expanded="false"
                    :aria-controls="'collapse' + factor.id"
                  >
                    {{ factor.title + " " + factor.sub_title }}
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
                    mutableMaritialStatus === 'Married'
                      ? factorScoreMarried[factor.id]
                      : factorScoreSingle[factor.id]
                  "
                  class="form-control float-right"
                />
              </div>
            </div>
          </div>
          <div
            :id="'collapse' + factor.id"
            class="collapse"
            aria-labelledby="headingOne"
            data-parent="#accordion"
          >
            <div class="card-body">
              <div class="form-group">
                <div class="row" v-for="subfactor in factor.subfactors">
                  <div class="col-6">
                    <label>{{ subfactor.subfactor }}</label>
                  </div>
                  <div class="col-4">
                    <select
                      class="form-control"
                      id="select2-search-hide"
                      style="width: 100%; height: 36px"
                      v-model="selectedSubfactor[subfactor.id]"
                      @change="criteriaVal(factor.id, subfactor.id)"
                    >
                      <option v-for="criterion in subfactor.criteria" :value="criterion">
                        {{ criterion.criterion }}
                      </option>
                    </select>
                  </div>

                  <div class="col-2">
                    <input
                      type="text"
                      class="form-control"
                      :value="
                        selectedSubfactor[subfactor.id] != undefined
                          ? mutableMaritialStatus === 'Married' &&
                            selectedSubfactor[subfactor.id].hasOwnProperty('married')
                            ? selectedSubfactor[subfactor.id].married
                            : mutableMaritialStatus === 'Single' &&
                              selectedSubfactor[subfactor.id].hasOwnProperty('single')
                            ? selectedSubfactor[subfactor.id].single
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
        </div> -->

        <!-- +==============+ -->

        <div class="card mb-0" v-for="object in data">
          <div v-text="object.items"></div>
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
                    mutableMaritialStatus === 'Married'
                      ? factorScoreMarried[object.factor.id]
                      : factorScoreSingle[object.factor.id]
                  "
                  class="form-control float-right"
                />
              </div>
            </div>
          </div>

          <!--   <select class="form-control c-select" name="user_type">
            <option>Parent</option>
            <option>Student</option>
            <option :selected="1 < 2">Teacher</option>
          </select> -->

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
                    <label>{{ subfactor.subfactor }}</label>
                  </div>
                  <div class="col-4">
                    <!--   <button
                      class="btn-info"
                      @click="
                        factorWasSelected(
                          [object.items], //x
                          [
                            { factorId: object.factor.id },
                            { subfactorId: subfactor.id },
                            { criterionId: criterion.id },
                          ] //y
                        )
                      "
                    >
                      <i class="fas fa-refresh"></i>
                    </button> -->

                    <button
                      @click="setSelection()"
                      class="fas fa-refresh success"
                    ></button>

                    <select
                      class="form-control"
                      id="select2-search-hide"
                      style="width: 100%; height: 36px"
                      @change="criteriaVal"
                      v-model="selectedSubfactor[subfactor.id]"
                    >
                      <!-- v-model="selectedSubfactor[subfactor.id]" -->
                      <!-- @change="criteriaVal(object.factor.id, subfactor.id)" -->
                      <option
                        :v-for="criterion in subfactor.criteria"
                        :value="{
                          criterion,
                          factor: object.factor.id,
                          subfactor: subfactor.id,
                        }"
                        :selected="
                          factorWasSelected(
                            objectItems(object.items, {
                              opt: {
                                factorId: object.factor.id,
                                subfactorId: subfactor.id,
                                criterionId: criterion.id,
                              },
                            }),
                            {
                              opt: {
                                factorId: object.factor.id,
                                subfactorId: subfactor.id,
                                criterionId: criterion.id,
                              },
                            }
                          )
                        "
                      >
                        criterion:{{ criterion.id }}, subfactor{{ subfactor.id }},
                        factor:{{ object.factor.id }}
                      </option>

                      <!--  <option
                        v-for="criterion in subfactor.criteria"
                        :value="criterion.id"
                        :class="
                          factorWasSelected(
                            objectItems(object.items, {
                              opt: {
                                factorId: object.factor.id,
                                subfactorId: subfactor.id,
                                criterionId: criterion.id,
                              },
                            }),
                            {
                              opt: {
                                factorId: object.factor.id,
                                subfactorId: subfactor.id,
                                criterionId: criterion.id,
                              },
                            } //y
                          ) == true
                            ? 'bg-success'
                            : ''
                        "
                      >
                        criterion:{{ criterion.id }}, subfactor{{ subfactor.id }},
                        factor:{{ object.factor.id }}
                      </option> -->
                    </select>
                  </div>

                  <div class="col-2">
                    <input
                      type="text"
                      class="form-control"
                      :value="
                        selectedSubfactor[subfactor.id] != undefined
                          ? mutableMaritialStatus === 'Married' &&
                            selectedSubfactor[subfactor.id].hasOwnProperty('married')
                            ? selectedSubfactor[subfactor.id].married
                            : mutableMaritialStatus === 'Single' &&
                              selectedSubfactor[subfactor.id].hasOwnProperty('single')
                            ? selectedSubfactor[subfactor.id].single
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
        <!--  -->
      </div>
    </div>
  </div>
</template>
<script src="./accordions.js"></script>

<style lang="css">
#accordion .card input {
  text-align: center;
}
</style>
