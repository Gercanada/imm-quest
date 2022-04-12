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
            <th class="detail"></th>
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
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      f1ScoreMarried: 0,
      f1ScoreSingle: 0,
    };
  },
  methods: {},
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
