<template>
  <Content />
</template>

<script>
/*
Cualquier usuario puede entrar y probar la calculadora de puntos.
Si un usuario quiere guardar su situacion actual y/o copiar como escenario debera autenticarse.
Si al intentar guardar o copiar no se esta autenticado sera redirigido a la vista de login.
Para lo cual de la vista content importamos una variable como requiredBeAuth = true
*/

import Content from "./Content";

export default {
  components: {
    Content,
  },
  data() {
    return {};
  },
  created() {},
  methods: {},
};
</script>
