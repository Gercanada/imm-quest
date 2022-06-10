<template>
  <li class="nav-item dropdown float-right mr-2">
    <a
      type="button"
      class="nav-item"
      @click="setLang('es')"
      :class="lang === 'es' ? 'active' : ''"
    >
      <i class="flag-icon flag-icon-mx"></i> Español
    </a>
    <br />
    <a
      type="button"
      class="nav-item"
      @click="setLang('en')"
      :class="lang === 'en' ? 'active' : ''"
    >
      <i class="flag-icon flag-icon-ca"></i> English
    </a>
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
