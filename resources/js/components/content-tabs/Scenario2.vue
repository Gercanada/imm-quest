<template>
  <div>
    Subfactors <br />
    {{ subfactors }}
    factors <br />
    {{ factors }}
    <p>This uis scenario 2</p>
    <br />
    {{ body }}
  </div>
  <!--

      TODO Esto sigue siendo accordions y cnsume la  ruta factors que devuelve factores y escenarios.
      Para este caso, excluimos actualsituation, y se mostrara el acordion(estatico) en base al tab seleccionado
      Checar maritial status al momento de guardar. Tal vez esta tomando el mutable
      Good job, see tomorrow sr
   -->
</template>
<script>
export default { props: ["body", "factors", "subfactors"] };
</script>
