<template>
  <div class="row">
    <div class="col-9">
      <p>
        <a href="http://">Calcula Tus Puntos de Express Entry </a>
        <!--     </br> -->
        Tambien puedes crear Escenarios para calcular cuantos puntos tendrias si tuvieras
        Experiencia Canadiense o algun tipo de estudios. Para Guardar tus Resultados,
        Descargarlos en un PDF o comparar tus resultados,
        <a href="http://"> crea tu cuenta gratis</a>
      </p>
    </div>
    <div class="col-3">
      <button class="btn btn-outline-danger waves-effect waves-light" type="button">
        <span class="btn-label"><i class="far fa-file-pdf"></i></span> Generar pdf
      </button>
    </div>
    <div class="col-12">
      <SummaryTable
        :summary="summary"
        :factors="factors"
        :scores="scores"
        :FactorsWithScores="FactorsWithScores"
        :maritialStatusChanged="maritialStatusChanged"
      />
    </div>
  </div>
</template>
<script>
import SummaryTable from "./SummaryTable.vue";
export default {
  props: ["summary", "factors", "scores", "FactorsWithScores", "maritialStatusChanged"],
  components: {
    SummaryTable,
  },
  data() {
    return {};
  },
  //   mounted() {},
};
</script>
