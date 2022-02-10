<template>
  <div class="form-group" autocomplete="none">
    <div class="switch col-md-12">
      <label
        ><i class="far fa-moon"></i>
        <input
          id="themme_layout"
          v-model="themme_layout"
          true-value="1"
          false-value="0"
          type="checkbox"
          @change="setThemme($event)"
          data-toggle="tooltip"
          title="Select themme layout" />
        <span class="lever switch-col-grey"></span><i class="fas fa-sun"></i
      ></label>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      themme_layout: false,
    };
  },
  mounted() {
    this.userThemme();
  },
  methods: {
    userThemme() {
      let me = this;
      axios
        .get("/user_themme")
        .then(function (response) {
          me.themme_layout = response.data;
          if (response.data === 1) {
            me.themme_layout = 1;
          } else {
            me.themme_layout = 0;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    setThemme(event) {
      let me = this; /*
      var data = event.target.value;
      console.log(data); */
      axios
        .post("/user_themme", {
          themme_layout: me.themme_layout,
        })
        .then(function (res) {
          Swal.fire({
            type: "success",
            title: "Themme changed",
            timer: 2000,
            showConfirmButton: false,
          });
          window.location.reload();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
