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
          <tr>
            <th></th>
            <th data-sortable="" data-width="auto">Actual situation</th>
            <th data-field="forks_count" data-sortable="" data-width="auto">
              Scenario 2
            </th>
            <th data-field="description" data-sortable="" data-width="auto">
              Scenario n
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><b>Maritial status</b></th>
            <th class="detail">
              {{ maritialStatusChanged != null ? maritialStatusChanged : "Single" }}
            </th>
          </tr>
          <tr>
            <th>Total de puntos</th>
            <td>{{ totalForFactor }}</td>
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
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["summary", "factors", "scores", "FactorsWithScores", "maritialStatusChanged"],
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
  },

  data() {
    return {
      f1ScoreMarried: 0,
      f1ScoreSingle: 0,
      totalForFactor: 0,
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
