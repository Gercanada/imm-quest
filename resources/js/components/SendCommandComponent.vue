<template>
  <div v-if="loading" style="heigth: 100%">
    <div class="card shadow  p-1 rounded">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <div class="row page-titles">
      <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Send development command</h3>
      </div>
    </div>
    <!-- Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow  p-1 rounded">
          <!-- Tabs -->
          <div class="card-body">
            <form
              class="form-horizontal form-material"
              method="get"
              autocomplete="nope"
            >
              <input
                autocomplete="off"
                name="hidden"
                type="text"
                style="display: none"
              />
              <section autocomplete="disabled">
                <div class="form-group" autocomplete="nope">
                  <label class="col-md-12" for="command">Command</label>
                  <div class="col-md-12">
                    <input
                      class="form-control form-control-line"
                      v-model="command"
                      name="command"
                      type="text"
                    />
                    <small
                      v-if="submitted && errors.command"
                      class="text-danger font-14"
                      >{{ errors.command }}</small
                    >
                    <small
                      v-else
                      class="text-success font-14"
                      >{{ command_track }}</small
                    >
                  </div>
                </div>
              </section>
              <div class="form-group">
                <div class="col-sm-12">
                  <button class="btn btn-success" v-on:click="sendCommand()"
                    ><i class="fas fa-terminal"> send command </i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Column -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loading: false,
      command: "",
      command_track: "",

      userObj: {},
      submitted: false,
      errors: {},
    };
  },
  mounted() {
    this.inputClean();
  },
  methods: {
    sendCommand() {
      let me = this;
      axios.post("/dev_cmd", {
        command: me.command,
      }).then(function (response) {
          console.log(response.data);
          me.command_track = response;
          Swal.fire({
            type: "success",
            title: "Account updated",
            timer: 2000,
            showConfirmButton: false,
          });
          //debugger;
          me.inputClean();
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title: "Account wasn't updated !",
            timer: 2000,
            showConfirmButton: false,
          });
          console.log(error);
        });
    },
    inputClean() {
      this.command = "";
      this.command_type = "";
    },
  },
};
</script>
