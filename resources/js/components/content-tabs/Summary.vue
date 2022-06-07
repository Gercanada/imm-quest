<template>
  <div class="row">
    <div class="col-md-12" v-if="!authenticated">
      <p>
        <a href="/register">Calcula Tus Puntos de Express Entry </a>
        <!--     </br> -->
        Tambien puedes crear Escenarios para calcular cuantos puntos tendrias si tuvieras
        Experiencia Canadiense o algun tipo de estudios. Para Guardar tus Resultados,
        Descargarlos en un PDF o comparar tus resultados,
        <a href="/register"> crea tu cuenta gratis</a>
      </p>
    </div>

    <div class="col-12">
      <SummaryTable
        v-if="authenticated"
        :summary="summary"
        :factors="factors"
        :scores="scores"
        :FactorsWithScores="FactorsWithScores"
        :maritialStatusChanged="maritialStatusChanged"
        :scennariosCopies="scennariosCopies"
        :authenticated="authenticated"
        :reloadAt="reloadAt"
        :language="language"
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
    "authenticated",
    "reloadAt",
    "language",
  ],
  components: {
    SummaryTable,
  },
};
</script>
