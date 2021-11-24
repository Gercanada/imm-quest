<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">Enable or disable tools for users</div>

          <div class="table-responsive">
            <div class="table-header bg-ligth success">users</div>
            <table
              class="
                table
                dt_alt_pagination
                table-striped table-bordered
                display
              "
              style="width: 100%"
            >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in ArrayUsers" :key="user.id">
                  <td v-text="user.name"></td>
                  <td v-text="user.email"></td>
                  <td v-text="user.type"></td>
                  <!-- user status(Contact, lead, etc ..)  -->
                  <td>
                    <button
                      type="button"
                      @click="openModal('user', 'settings', user)"
                      class="btn btn-outline-success btn-rounded"
                    >
                      <i class="fas fa-cogs"> </i>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>Case title</th>
                  <th>Case type</th>
                  <th>Status</th>
                  <th>options</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <!--  <template v-if="actionType == 1"> -->
      <template>
        <div
          class="modal fade"
          tabindex="-1"
          :class="{ mostrar: modal }"
          role="dialog"
          aria-labelledby="myModalLabel"
          style="display: none; overflow-y: auto"
          aria-hidden="true"
        >
          <div
            class="modal-dialog modal-primary modal-lg"
            style="padding-top: 55px"
            role="document"
          >
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h4 class="modal-title" v-text="modalTitle"></h4>
                <button
                  type="button"
                  class="close"
                  @click="closeModal()"
                  aria-label="Close"
                >
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body">
                <!--  <form
                      enctype="multipart/form-data"
                      class="form-horizontal"
                    ></form> -->
                <div class="flex flex-wrap -m-2">
                  <div class="p-2 w-full">
                    <div class="relative">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>email</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td v-text="name"></td>
                              <td v-text="email"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">
                            Accesible modules for this user
                          </h4>
                          <h6 class="card-subtitle">
                            Select each modules that this user need to get
                            access
                          </h6>
                          <select
                            class="select2 form-control"
                            multiple="multiple"
                            style="height: 36px; width: 100%"
                            :options="ArrayTypes"
                            v-model="selected"
                            id="selectTypes"
                          >
                            <option
                              v-for="type in ArrayTypes"
                              :key="type.id"
                              :value="type.id"
                              :v-if="type.status == 1"
                              class="selected"
                            >
                              {{ type.text }}
                            </option>
                          </select>
                        </div>
                      </div>

                      <!-- <vue-select class="vue-select1" name="select1">
                          </vue-select> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer bg-info">
                <button
                  v-if="actionType == 1"
                  type="button"
                  class="btn btn-primary fas fa-save"
                  @click="updateTypes()"
                >
                  Save
                </button>
                <button
                  type="button"
                  v-if="actionType == 1"
                  class="btn btn-danger"
                  @click="closeModal()"
                >
                  Close
                </button>
              </div>
            </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </template>
    </div>
  </div>
</template>

<script type="text/JavaScript">
import { ServerTable, ClientTable, Event } from "vue-tables-2";

export default {
  data() {
    return {
      ArrayTypes: [],
      type: "",
      ArrayUsers: [],
      id: 0,
      name: "",
      email: "",
      //active: 0,

      modal: 0,
      modalTitle: "",
      actionType: 0,
      selected: [],
      user_id: 0,
    };
  },

  methods: {
    listUsers() {
      let me = this;
      axios
        .get("/users")
        .then(function (response) {
          me.ArrayUsers = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    closeModal() {
      this.modal = 0;
      this.modalTitle = "";
      this.submitted = false;
      this.errors = {};
      this.listUsers();
    },

    openModal(model, action, data = []) {
      switch (model) {
        case "user":
          switch (action) {
            case "settings": {
              this.modal = 1;
              this.modalTitle = "Enable or disable modules for this customer";
              this.user_id = data["id"];
              this.name = data["name"];
              this.email = data["email"];
              this.actionType = 1;
              this.selectTypes(data["id"]);
            }
          }
      }
    },

    selectTypes(user_id) {
      let me = this;
      axios
        .get(`/api/vtiger/types/${user_id}`)
        .then(function (response) {
          let selectedArr = [];
          let optionsArr = [];
          for (let i = 0; i < response.data.length; i++) {
            optionsArr.push({
              id: response.data[i].name,
              text: response.data[i].name,
            });
            if (response.data[i].active == 1) {
              selectedArr.push(response.data[i].name);
            }
          }
          me.ArrayTypes = optionsArr;
          me.selected = selectedArr;
          console.log({ optionsArr });
          console.log({ selectedArr });
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    updateTypes() {
      const newOptions = $(".select2").val();

      for (let i = 0; i < newOptions.length; i++) {
        if (!this.selected.includes(newOptions[i])) {
          this.selected.push(newOptions[i]);
        }
      }

      /*  console.log($(".select2").val());
      console.log("here"); */
      let me = this;
      //me.selected.push()
      axios
        .post("/api/vtiger_config", {
          id: me.user_id,
          object: me.selected,
        })
        .then(function (response) {
          me.closeModal();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },

  mounted() {
    this.listUsers();
  },
};
</script>


<style>
.modal-content {
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
}
</style>
