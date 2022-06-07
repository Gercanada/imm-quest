<template>
  <li class="nav-item dropdown mr-4 d-md-block waves-effect waves-dark float-left">
    <a
      class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
      href=""
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="flag-icon flag-icon-ca"></i
    ></a>
    <div class="dropdown-menu dropdown-menu-right animated bounceInDown">
      <a
        class="dropdown-item"
        @click="setLang('es')"
        :class="lang === 'es' ? 'active' : ''"
      >
        <i class="flag-icon flag-icon-mx"></i> Español
      </a>
      <a
        class="dropdown-item"
        @click="setLang('en')"
        :class="lang === 'en' ? 'active' : ''"
      >
        <i class="flag-icon flag-icon-ca"></i> English
      </a>
    </div>
  </li>
</template>
<script>
export default {
  mounted() {},
  data() {
    return {
      lang: null,
    };
  },
  methods: {
    setLang(val) {
      console.log(val);
      this.lang = val;
      axios
        .get("set-lang/" + val)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.table(error);
        });
      window.location.reload();
    },
  },
};
</script>
