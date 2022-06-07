<template>
  <div class="row">
    <div class="col-md-12 p-0">
      <div id="accordion" class="custom-accordion">
        <div
          class="card shadow-lg mb-4 rounded"
          v-for="object in data"
          v-show="maritialStatus === 'Single' ? object.factor.id != 3 : true"
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
                <div
                  class="row shadow p-1 mb-2"
                  v-for="(subfactor, index) in object.factor.subfactors"
                >
                  <div class="col-lg-6 col-md-4">
                    {{ subfactor.subfactor }}
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <select
                      class="select2 form-control custom-select"
                      id="select2-search-hide"
                      style=""
                      v-model="selectedSubfactor.selections[subfactor.id]"
                      @change="criteriaVal"
                    >
                      <option
                        v-for="criterion in subfactor.criteria"
                        :value="{
                          criterion,
                          factor: object.factor.id,
                          subfactor: subfactor.id,
                        }"
                        :class="criterion.selected ? 'bg-success' : ''"
                        style="overflow-wrap: break-word; max-width: 60px"
                      >
                        <p>
                          {{ criterion.criterion }}
                        </p>
                        <br />
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
