<template>
  <!-- Table -->
  <div class="card">
    <div class="card-body">
      <div class="row pb-3 mb-2">
        <div class="col-md-8">
          <h4 class="card-title">Sumario de puntos</h4>
        </div>
        <div class="col-md-4">
          <button
            class="btn btn-outline-danger waves-effect waves-light"
            type="button"
            @click="
              printSummary([
                factors,
                scennariosCopies,
                maritialStatusChanged,
                totalForFactor,
                sumScoreCopies.copies,
                FactorsWithScores,
              ])
            "
          >
            <span class="btn-label"><i class="far fa-file-pdf"></i></span> Generar pdf
          </button>
        </div>
      </div>
      <table
        data-toggle="table"
        data-mobile-responsive="true"
        class="table table-bordered"
        data-sort-order="default"
      >
        <!-- -->
        <thead>
          <tr>
            <th></th>
            <th data-sortable="" data-width="auto">Actual situation</th>
            <th
              data-sortable=""
              data-width="auto"
              class="text-center"
              v-for="sCopy in scennariosCopies"
            >
              {{ sCopy.name }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><b>Maritial status</b></th>
            <th class="detail">
              {{ maritialStatusChanged != null ? maritialStatusChanged : "Single" }}
            </th>
            <th v-for="sCopy1 in scennariosCopies">
              {{ sCopy1.is_married == true ? "Married" : "Single" }}
            </th>
          </tr>
          <tr>
            <th>Total de puntos</th>
            <th class="text-center">{{ totalForFactor }}</th>
            <th class="text-center" v-for="sumS in sumScoreCopies.copies">
              {{ sumS.total }}
            </th>
          </tr>

          <tr v-for="fact in factors">
            <td>
              <p class="left">{{ fact.name }}</p>
            </td>
            <td class="">
              {{
                maritialStatusChanged === "Married" &&
                fact.id in FactorsWithScores &&
                FactorsWithScores[fact.id]
                  ? FactorsWithScores[fact.id][1].marriedSum
                  : maritialStatusChanged === "Single" &&
                    fact.id in FactorsWithScores &&
                    FactorsWithScores[fact.id]
                  ? FactorsWithScores[fact.id][0].singleSum
                  : 0
              }}
            </td>
            <td v-for="sumEach in sumScoreCopies.copies">
              <p
                v-for="(value, name, index) in sumEach.sums"
                v-if="Object.keys(value)[0] == fact.id"
              >
                {{ Object.values(value)[0] }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "summary",
    "factors",
    "scores",
    "FactorsWithScores",
    "maritialStatusChanged",
    "scennariosCopies",
  ],
  watch: {
    FactorsWithScores: function () {
      let toSumArr = [];
      this.factors.forEach((fact) => {
        toSumArr.push(
          this.maritialStatusChanged === "Married" &&
            [fact.id] in this.FactorsWithScores &&
            this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][1].marriedSum
            : this.maritialStatusChanged === "Single" &&
              [fact.id] in this.FactorsWithScores &&
              this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][0].singleSum
            : 0
        );
      });
      //   console.log({ toSumArr });
      let sum = 0;
      for (let i = 0; i < toSumArr.length; i++) {
        sum += toSumArr[i];
      }
      this.totalForFactor = sum;
    },

    maritialStatusChanged: function () {
      let toSumArr = [];
      this.factors.forEach((fact) => {
        // console.log("SUMMARY");
        // console.log(this.maritialStatusChanged);

        toSumArr.push(
          this.maritialStatusChanged === "Married" &&
            [fact.id] in this.FactorsWithScores &&
            this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][1].marriedSum
            : this.maritialStatusChanged === "Single" &&
              [fact.id] in this.FactorsWithScores &&
              this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][0].singleSum
            : 0
        );
      });
      let sum = 0;
      for (let i = 0; i < toSumArr.length; i++) {
        sum += toSumArr[i];
      }
      this.totalForFactor = sum;
    },

    scennariosCopies: function () {
      let scennarios = { copies: [] };
      let scNames = [];
      this.scennariosCopies.forEach((copy) => {
        let groupByFacto = JSON.parse(copy.body).reduce((group, product) => {
          const { factor } = product;
          group[factor] = group[factor] ? group[factor] : [];
          group[factor].push(product.value);
          return group;
        }, {});
        scNames.push(copy.name);
        scennarios["copies"].push({ [copy.name]: groupByFacto });
      });

      for (let i = 0; i < scennarios.copies.length; i++) {
        let scennary = scennarios.copies[i];
        for (const [key, value] of Object.entries(scennary)) {
          let totals = [];

          for (const [key, value] of Object.entries(value)) {
            let sum = 0;
            for (let b = 0; b < value.length; b++) {
              sum += value[b];
            }
            totals.push({ [key]: sum });
          }
          scennary["sums"] = totals;

          let total = 0;
          for (let b = 0; b < totals.length; b++) {
            total += Number(Object.values(totals[b]));
          }
          scennary["total"] = total;
        }
      }
      this.sumScoreCopies = scennarios;
      return;
    },
  },

  data() {
    return {
      f1ScoreMarried: 0,
      f1ScoreSingle: 0,
      totalForFactor: 0,
      sumScoreCopies: [],
    };
  },
  methods: {
    sumEachs(val, pos) {
      let newVal = 0;
      val.forEach((element) => {
        for (const [key, value] of Object.entries(element)) {
          newVal = { [pos]: value };
        }
      });
      return newVal;
      //   return "ok ox";
    },

    printSummary(data) {
      axios
        .post("print-summary", data)
        .then(function (response) {
          console.table(response);
        })
        .catch((error) => {
          console.table(error);
        });
    },
  },
};
</script>

<style scoped>
table {
  height: auto;
  overflow: auto;
  position: relative;
}
tbody tr td {
  text-align: center;
}

tbody tr td p .right {
  text-align: right;
}

tbody tr td p .left {
  text-align: left;
}

tbody tr .rowName {
  text-align: left;
  width: 40%;
  min-width: 20%;
}
.card {
  height: 100%;
}
</style>
