<template>
<div>
    <p>
        <a href="http://">Calcula Tus Puntos de Express Entry </a>
    <!--     </br> -->
        Tambien puedes crear Escenarios para calcular cuantos puntos tendrias si
        tuvieras Experiencia Canadiense o algun tipo de estudios. Para Guardar
        tus Resultados, Descargarlos en un PDF o comparar tus resultados,
        <a href="http://"> crea tu cuenta gratis</a>
    </p>
    <SumaryTable/>

</div>
</template>
<script>
import SumaryTable from "./SumaryTable.vue";
export default {
    components: {
        SumaryTable,
    },
};
</script>