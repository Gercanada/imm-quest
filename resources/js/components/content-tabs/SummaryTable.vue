<template>
  <!-- Table -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Sumario de puntos</h4>
      <!-- <p class="bg-danger">{{ maritialStatusChanged }}</p> -->
      <!-- <h6 class="card-subtitle">Basic sortable table</h6> -->
      <table
        data-toggle="table"
        data-mobile-responsive="true"
        class="table table-bordered"
        data-sort-order="default"
      >
        <!-- -->
        <thead>
          <!--  <tr v-for="sCopy in scennariosCopies">
            <td>{{ sCopy.name }}</td>
          </tr> -->
          <tr>
            <th></th>
            <th data-sortable="" data-width="auto">Actual situation</th>
            <th
              data-sortable=""
              data-width="auto"
              class="bg-warning"
              v-for="sCopy in scennariosCopies"
            >
              {{ sCopy.name }}
            </th>
            <!--  <th data-field="forks_count" data-sortable="" data-width="auto">
              Scenario 2
            </th>
            <th data-field="description" data-sortable="" data-width="auto">
              Scenario n
            </th> -->
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
            <td>{{ totalForFactor }}</td>
            <td v-for="sCopy2 in scennariosCopies">
              {{ JSON.parse(sCopy2.body) }}
            </td>
          </tr>

          <tr v-for="fact in factors">
            <td>
              <p class="left">{{ fact.name }}</p>
            </td>
            <td class="bg-info">
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
            <td>TonzHere</td>
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
      //   console.log({ toSumArr });
      let sum = 0;
      for (let i = 0; i < toSumArr.length; i++) {
        sum += toSumArr[i];
      }
      this.totalForFactor = sum;
    },

    scennariosCopies: function () {
      let snennarios = { copies: [], sumOf: [] };
      this.scennariosCopies.forEach((copy) => {
        let groupByFacto = JSON.parse(copy.body).reduce((group, product) => {
          const { factor } = product;
          group[factor] = group[factor] ? group[factor] : [];
          //   group[factor].push(product);
          group[factor].push(product.value);
          return group;
        }, {});
        snennarios["copies"][copy.name] = groupByFacto;

        console.log(snennarios["copies"]);
        return;

        snennarios["copies"].forEach((element) => {
          alert("any");
          console.log(element);
          /*  if (copy.name in snennarios["copies"]) {
            let sum = 0;
            for (let i = 0; i < snennarios["copies"][copy.name].length; i++) {
              sum += toSumArr[i];
            }
            snennarios["sumOf"][copy.name] = sum;
          } */
        });
        return;

        // console.log(groupByFacto["copies"]);
        return;
        /*  */
        groupByFacto.copies[copy.name].forEach((element) => {
          console.log(element);
          return;
          let toSumArr = [];
          snennarios["copies"][copy.name].forEach((element) => {
            toSumArr.push(element.value);
          });
          let sum = 0;
          let totel = 0;
          for (let i = 0; i < toSumArr.length; i++) {
            sum += toSumArr[i];
          }
          total = sum;

          snennarios["sumOf"][copy.name] = total;
        });

        return;
      });

      console.log(snennarios);
      return;
    },
  },

  data() {
    return {
      f1ScoreMarried: 0,
      f1ScoreSingle: 0,
      totalForFactor: 0,
      sumScoreCopies: [{ copy: 0 }],
    };
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
