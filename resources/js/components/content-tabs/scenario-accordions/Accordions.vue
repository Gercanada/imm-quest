<template>
  <div class="row">
    <div class="col-12">
      <div id="accordion" class="custom-accordion mb-4">
        <div class="card mb-0" v-for="factor in data">
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
                    maritialStatus === 'Married'
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
                          ? maritialStatus === 'Married' &&
                            selectedSubfactor[subfactor.id].hasOwnProperty('married')
                            ? selectedSubfactor[subfactor.id].married
                            : maritialStatus === 'Single' &&
                              selectedSubfactor[subfactor.id].hasOwnProperty('single')
                            ? selectedSubfactor[subfactor.id].single
                            : 0
                          : 0
                      "
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
<script>
export default {
  props: ["maritialStatus"],
  selectedSubfactor: null,
  /*  components: {
    Factor1HumanCap,
    Factor2HabilityTransfer,
    Factor3AdditionalPoints,
    Factor4SpouseAttributes,
  }, */
  data() {
    return {
      data: [],
      selectedSubfactor: {},
      factorScoreMarried: {},
      factorScoreSingle: {},
      singleValues: [],
      marredValues: [],
    };
  },

  mounted() {
    console.log(this.maritialStatus);
    this.getData();
  },
  methods: {
    getData() {
      let me = this;
      axios.get("/factors").then(function (response) {
        console.log(response);
        me.data = response.data ? response.data : [];
        console.log(me.data);
      });
    },
    criteriaVal(factor, subfactor) {
      console.log(factor);
      console.log(this.selectedSubfactor);
      console.log(this.selectedSubfactor[subfactor]);

      if (!this.singleValues.includes(this.selectedSubfactor[subfactor].subfactor_id)) {
        this.singleValues.push('subfactor':subfactor,'score':this.selectedSubfactor[subfactor].single);
      }
    //   console.log(this.singleValues);

      this.factorScoreMarried[factor] = this.selectedSubfactor[subfactor].married;
      this.factorScoreSingle[factor] = this.selectedSubfactor[subfactor].single;
      //   console.log(this.factorScoreMarried[factor]);
    },
  },
};
</script>
<style lang="css">
#accordion .card input {
  text-align: center;
}
</style>
