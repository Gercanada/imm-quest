<template>
  <!-- Table -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Sortable table</h4>
      <h6 class="card-subtitle">Basic sortable table</h6>
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
              {{ [0] in summary && summary[0] != null ? summary[0] : "Single" }}
            </th>
          </tr>
          <tr>
            <th>Total de puntos</th>
            <td>{{ totalForFactor }}</td>
            <!-- <td>Sum here</td> -->
            <!-- <td>{{ totalScore }}</td> -->
          </tr>
          <tr v-for="fact in factors">
            <td>{{ fact.name }}</td>
            <td class="bg-info">
              {{
                [0] in summary && summary[0] != null && summary[0] === "Married"
                  ? fact.id in FactorsWithScores && FactorsWithScores[fact.id]
                    ? FactorsWithScores[fact.id][1].marriedSum
                    : [0] in summary && summary[0] != null && summary[0] === "Single"
                    ? fact.id in FactorsWithScores && FactorsWithScores[fact.id]
                      ? FactorsWithScores[fact.id][0].singleSum
                      : 0
                    : 0
                  : 0
              }}
            </td>
          </tr>
        </tbody>
        <!--

        <tbody>
          <tr>
            <td class="rowName">Total de puntos</td>
            <td>1</td>
            <td>3</td>
            <td>4</td>
          </tr>
          <tr>
            <td class="rowName">Factor 1: Factores centrales de capital humano</td>
            <td>1</td>
            <td>4</td>
            <td>3</td>
          </tr>
          <tr>
            <td class="rowName">Factor 2: Transferibilidad de actividades</td>
            <td>2</td>
            <td>3</td>
            <td>1</td>
          </tr>
          <tr>
            <td class="rowName">Factor 3: Puntos adicionales</td>
            <td>2</td>
            <td>3</td>
            <td>1</td>
          </tr>
          <tr>
            <td class="rowName">
              Factor 4: Atributos de pareja (En caso de que aplique)
            </td>
            <td>2</td>
            <td>3</td>
            <td>1</td>
          </tr>
        </tbody> -->
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["summary", "factors", "scores", "FactorsWithScores"],
  watch: {
    FactorsWithScores: function () {
      let toSumArr = [];

      this.factors.forEach((fact) => {
        toSumArr.push(
          [0] in this.summary && this.summary[0] != null && this.summary[0] === "Married"
            ? fact.id in this.FactorsWithScores && this.FactorsWithScores[fact.id]
              ? this.FactorsWithScores[fact.id][1].marriedSum
              : [0] in this.summary &&
                this.summary[0] != null &&
                this.summary[0] === "Single"
              ? fact.id in this.FactorsWithScores && this.FactorsWithScores[fact.id]
                ? this.FactorsWithScores[fact.id][0].singleSum
                : 0
              : 0
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
  mounted() {
    console.log("Summary Table");
    console.log(this.summary);
  },
  created() {
    // alert("here");
    console.log(this.scores);
  },

  methods: {
    getTotal() {
      console.log("total");
      console.log(this.FactorsWithScores);
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
tbody tr .rowName {
  text-align: left;
  width: 40%;
  min-width: 20%;
}
.card {
  height: 100%;
}
</style>
