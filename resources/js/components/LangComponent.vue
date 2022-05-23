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
      <a class="dropdown-item" @click="setLang('es')">
        <i class="flag-icon flag-icon-es"></i> Español
      </a>
      <a class="dropdown-item" @click="setLang('en')">
        <i class="flag-icon flag-icon-ca"></i> English
      </a>
    </div>
  </li>
</template>
<script>
export default {
  mounted() {
    this.getLocation();
  },
  methods: {
    getLocation() {
      this.$lang.getLocale();
      if (localStorage.getItem("locale")) {
        this.$lang.setLocale(localStorage.getItem("locale"));
      } else {
        this.$lang.setLocale("en");
      }
      console.log(this.$lang.getLocale());
    },
    setLang(val) {
      this.$lang.setLocale(val);
    },
  },
};
</script>
