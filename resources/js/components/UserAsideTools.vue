<template >
  <ul>
    <li
      class="sidebar-item"
      v-for="type in ArrayTypes"
      :key="type"
      :value="type"
    >
      <a
        class="sidebar-link waves-effect waves-dark sidebar-link"
        :href="'/vtiger/list/' + type"
        aria-expanded="false"
        ><i data-feather="home" class="feather-icon"></i>
        <span class="hide-menu"> {{ type }}</span></a
      >
    </li>
  </ul>
</template>

<script type="text/JavaScript">
export default {
  data() {
    return {
      ArrayTypes: [],
      type: "",
      id: 0,
      name: "",
      email: "",
      //active: 0,

      modal: 0,
      modalTitle: "",
      actionType: 0,
      selected: [],
      newOptions: [],
      user_id: 0,
    };
  },

  methods: {
    listOptions() {
      let me = this;
      axios
        .get("/user/tools")
        .then(function (response) {
          me.ArrayTypes = response.data;
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },

  mounted() {
    this.listOptions();
  },
};
</script>


<style>
/* .modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
} */
</style>
