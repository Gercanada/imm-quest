<template>
  <div class="row">
    <div v-if="loading" class="col">
      <button
        disabled
        type="button"
        class="btn btn-outline-warning btn-rounded col-md-12"
      >
        <i class="fa fa-spin fas fa-sync-alt text-success"></i> Syncing ...
      </button>
    </div>
    <div v-else class="col">
      <button
        type="button"
        class="btn btn-outline-warning btn-rounded col-md-12"
        @click="sync()"
      >
        <i class="fas fa-sync-alt text-success"></i> Sync
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    sync() {
      let me = this;
      me.loading = true;
      axios
        .post("/viger/sync_data")
        .then(function (response) {
          //    console.log(response);
          Swal.fire({
            type: "success",
            title: "Updated fom source.",
            timer: 2000,
            showConfirmButton: false,
          });
          window.location.reload();
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
