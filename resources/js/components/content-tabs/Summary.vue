<template>
  <div class="row">
    <div class="col-md-12">
      <p>
        <a href="http://">Calcula Tus Puntos de Express Entry </a>
        <!--     </br> -->
        Tambien puedes crear Escenarios para calcular cuantos puntos tendrias si tuvieras
        Experiencia Canadiense o algun tipo de estudios. Para Guardar tus Resultados,
        Descargarlos en un PDF o comparar tus resultados,
        <a href="http://"> crea tu cuenta gratis</a>
      </p>
    </div>

    <div class="col-12">
      <!--  v-if="authenticated" TODO  -->
      <SummaryTable
        :summary="summary"
        :factors="factors"
        :scores="scores"
        :FactorsWithScores="FactorsWithScores"
        :maritialStatusChanged="maritialStatusChanged"
        :scennariosCopies="scennariosCopies"
      />
    </div>
  </div>
</template>
<script>
import SummaryTable from "./SummaryTable.vue";
export default {
  props: [
    "summary",
    "factors",
    "scores",
    "FactorsWithScores",
    "maritialStatusChanged",
    "scennariosCopies",
  ],
  components: {
    SummaryTable,
  },
  data() {
    return {};
  },
  //   mounted() {},
};
</script>
