<template>
  <div id="main-wrapper">
    <NavbarHeader />
    <Aside />
    <Content />
    <Footer />
  </div>

  <!--   <div v-else><Login /></div> -->
</template>

<script>
/*
Cualquier usuario puede entrar y probar la calculadora de puntos.
Si un usuario quiere guardar su situacion actual y/o copiar como escenario debera autenticarse.
Si al intentar guardar o copiar no se esta autenticado sera redirigido a la vista de login.
Para lo cual de la vista content importamos una variable como requiredBeAuth = true


*/
import NavbarHeader from "./layout/Nav";
import Aside from "./layout/Aside";
import Footer from "./layout/Footer";
import Content from "./layout/Content";

import Login from "./auth/LoginComponent";

export default {
  components: {
    NavbarHeader,
    Aside,
    Footer,
    Content,
    Login,
  },
  data() {
    return {
      isLoggedIn: false,
    };
  },
  mounted() {},
  created() {
    if (window.Laravel.isLoggedin) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    logout(e) {
      console.log("here");
      e.preventDefault();
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          //   .post("/api/logout")
          .post("/logout")
          .then((response) => {
            if (response.data.success) {
              window.location.href = "/";
            } else {
              console.log(response);
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>
