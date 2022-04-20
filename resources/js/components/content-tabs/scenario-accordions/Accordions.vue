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
  data() {
    return {
      data: [],
      scenarios: [],
      selectedSubfactor: {},
      factorScoreMarried: {},
      factorScoreSingle: {},
      singleValues: [],
      marriedValues: [],
      subfactorsArr: [],
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
        me.data = response.data ? response.data[0] : [];
        me.scenarios = response.data[1] ? response.data[1] : [];
        console.log(me.data);
      });
    },
    criteriaVal(factor, subfactor) {
      let me = this;
      me.subfactorsArr.sort(function (a, b) {
        return a - b;
      });
      me.singleValues.sort(function (a, b) {
        return a.subfactor - b.subfactor;
      });

      if (!me.subfactorsArr.includes(subfactor)) {
        me.subfactorsArr.push(subfactor);

        me.singleValues.push({
          factor,
          subfactor,
          criterion: me.selectedSubfactor[subfactor].id,
          value: me.selectedSubfactor[subfactor].single,
        });

        me.marriedValues.push({
          factor,
          subfactor,
          criterion: me.selectedSubfactor[subfactor].id,
          value: me.selectedSubfactor[subfactor].married,
        });
      } else {
        function replace(arr, obj, newValue) {
          arr.splice(
            arr.findIndex((e) => (e.hasOwnProperty("value") ? e.value : e === obj)),
            1
          );
          let obKey = Object.keys(obj);

          let ovVal = Object.values(obj);
          let newObj = { [obKey]: ovVal[0], value: newValue };
          arr.push(newObj);
        }

        replace(
          me.singleValues,
          { factor: factor },
          { subfactor: subfactor },
          { criterion: me.selectedSubfactor[subfactor].id },
          me.selectedSubfactor[subfactor].single
        );

        replace(
          me.marriedValues,
          { factor: factor },
          { subfactor: subfactor },
          { criterion: me.selectedSubfactor[subfactor].id },
          me.selectedSubfactor[subfactor].married
        );
        replace(me.subfactorsArr, { subfactor: subfactor }, subfactor);
      }
      function sumArr(arr) {
        return arr.reduce(
          (previousValue, currentValue) => previousValue + currentValue.value,
          0
        );
      }
      console.log({ ForSingleValues: me.singleValues });
      console.log({ forMarried: me.marriedValues });

      me.factorScoreSingle[factor] = sumArr(me.singleValues);
      me.factorScoreMarried[factor] = sumArr(me.marriedValues);

      let selectedSituation = [];
      selectedSituation[0] = this.maritialStatus;
      selectedSituation[1] = this.scenarios;
      if (this.maritialStatus === "Single") {
        selectedSituation[2] = me.singleValues;
      } else {
        selectedSituation[2] = me.marriedValues;
      }
      this.$emit("selectedSituation", selectedSituation);

      console.log(me.factorScoreMarried[factor]);
      console.log(me.factorScoreSingle[factor]);
    },
  },
};
</script>
<style lang="css">
#accordion .card input {
  text-align: center;
}
</style>
