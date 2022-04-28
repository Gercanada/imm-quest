<template>
  <div class="row">
    <div class="col-12">
      <div id="accordion" class="custom-accordion mb-4">
        <div class="card mb-0" v-for="object in data">
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
                <label class="bg-warning"
                  >Married {{ factorScoreMarried[object.factor.id] }}</label
                >
                <label class="bg-danger"
                  >Single{{ factorScoreSingle[object.factor.id] }}</label
                >
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
                      :value="selectedSubfactor[subfactor.id]"
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
                        selectedSubfactor[subfactor.id] != undefined &&
                        'criterion' in selectedSubfactor[subfactor.id]
                          ? mutableMaritialStatus === 'Married' &&
                            selectedSubfactor[subfactor.id].criterion.hasOwnProperty(
                              'married'
                            )
                            ? selectedSubfactor[subfactor.id].criterion.married
                            : mutableMaritialStatus === 'Single' &&
                              selectedSubfactor[subfactor.id].criterion.hasOwnProperty(
                                'single'
                              )
                            ? selectedSubfactor[subfactor.id].criterion.single
                            : ''
                          : null
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
