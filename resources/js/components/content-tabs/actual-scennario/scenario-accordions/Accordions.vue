<template>
  <div class="row">
    <div class="col-12">
      <div id="accordion" class="custom-accordion mb-4">
        <div
          class="card mb-0"
          v-for="object in data"
          v-show="maritialStatus === 'Single' ? object.factor.id != 5 : true"
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
                    maritialStatus === 'Married'
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
                          ? maritialStatus === 'Married' &&
                            selectedSubfactor.selections[
                              subfactor.id
                            ].criterion.hasOwnProperty('married')
                            ? selectedSubfactor.selections[subfactor.id].criterion.married
                            : maritialStatus === 'Single' &&
                              selectedSubfactor.selections[
                                subfactor.id
                              ].criterion.hasOwnProperty('single')
                            ? selectedSubfactor.selections[subfactor.id].criterion.single
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
</template>
<script src="./accordions.js"></script>
<style lang="css">
#accordion .card input {
  text-align: center;
}
</style>
