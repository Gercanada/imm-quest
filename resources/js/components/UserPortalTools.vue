<template>
  <div v-if="loading" style="heigth: 100%">
    <div class="card shadow-lg p-1">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <div class="row">
      <div class="col-md-12 col-lg-62">
        <div class="card shadow-lg p-1">
          <div class="row card-header">
            <div class="col-md-8">
              <h2>Customer portal users</h2>
            </div>
            <div class="col-md-4">
              <button
                type="button"
                @click="openModal('user', 'import')"
                class="btn btn-outline-success btn-rounded"
              >
                <i class="fas fa-users">Import IMM contacts to CP users </i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table table-striped table-bordered table-responsive">
              <!-- <div class="table-header">Users</div> -->
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
                   <!--  <th>Type</th> -->
                    <th>options</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in ArrayUsers" :key="user.id">
                    <td v-text="user.name"></td>
                    <td v-text="user.email"></td>
                    <!-- <td v-text="user.type"></td> -->
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
                    <!-- <th>Status</th> -->
                    <th>options</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--  <template v-if="actionType == 1"> -->
      <template v-if="actionType == 1">
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
                <div class="flex flex-wrap -m-2">
                  <div class="p-2 w-full">
                    <div class="relative">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>email</th>
                              <th>Contact ID</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td v-text="name"></td>
                              <td v-text="email"></td>
                              <td v-text="vtContactId"></td>
                              <!--  <td>
                                <input type="text" v-model="" />
                              </td> -->
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="card shadow-lg p-1">
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
      <template v-if="actionType == 2">
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
                <div class="flex flex-wrap -m-2">
                  <div class="p-2 w-full">
                    <div class="relative">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>email</th>
                              <th>Contact ID</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="user in newUsersArr"
                              :key="user"
                              :value="user"
                              :v-model="newUsersArr"
                            >
                              <td>
                                <p
                                  class="d-inline p-1"
                                  v-if="user.salutationtype"
                                  v-text="user.salutationtype"
                                ></p>
                                <p
                                  class="d-inline p-1"
                                  v-if="user.firstname"
                                  v-text="user.firstname"
                                ></p>
                                <p
                                  class="d-inline p-1"
                                  v-if="user.lastname"
                                  v-text="user.lastname"
                                ></p>
                              </td>
                              <td v-text="user.email"></td>
                              <td v-text="user.id"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer bg-info">
                <div class="bg-info text-left">
                  <label for="newPass">Set password for new users</label>
                  <input
                    class="text-left"
                    type="text"
                    name=""
                    id="newPass"
                    v-model="newPassword"
                    required
                  />
                  <br />
                  <small
                    v-if="submitted && errors.newPassword"
                    class="text-danger font-14"
                    >{{ errors.newPassword }}</small
                  >
                </div>
                <!--  <label for="sync-btn" class="text-left"
                  >Import <b>965</b> Users to CP</label
                > -->
                <button
                  id="sync-btm"
                  type="button"
                  class="btn btn-primary"
                  @click="importUsers()"
                >
                  <i class="fas fa-sync">Import All</i>
                </button>
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="closeModal()"
                >
                  <i class="far fa-window-close">Close</i>
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
      newOptions: [],
      newUsersArr: [],
      user_id: 0,

      vtContactId: 0,
      loading: false,

      user_salutationtype: "",
      user_firstname: "",
      user_lastname: "",
      user_email: "",
      user_id: "",

      newPassword: "",

      submitted: false,
      errors: {},
    };
  },

  methods: {
    listUsers() {
      let me = this;
      this.loading = true;

      axios
        .get("/users")
        .then(function (response) {
          me.ArrayUsers = response.data;
        })
        .finally(() => (this.loading = false))
        .catch(function (error) {
          console.log(error);
        });
    },

    closeModal() {
      this.modal = 0;
      this.actionType = 0;
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
              this.vtContactId = data["vtiger_contact_id"];
              this.selectTypes(data["id"]);

              console.log(this.actionType);

              //const newOptions = $(".select2").change().val();

              $(".select2").on("change", function (e) {
                // console.log($(".select2").val());
                this.newOptions = $(".select2").val();
                console.log({ options: this.newOptions });
              });
              break;
            }
            case "import": {
              this.listNewUsers();
              this.modal = 1;
              this.modalTitle = "Import contacts from IMMCase as CP users";
              this.user_id = data["id"];
              this.name = data["name"];
              this.email = data["email"];
              this.actionType = 2; //import
              this.vtContactId = data["vtiger_contact_id"];
              break;
            }
          }
      }
    },

    selectTypes(user_id) {
      let me = this;
      axios
        .get(`/vtiger/describe/types/${user_id}`)
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
      const newOptions = $(".select2").change().val();
      this.selected = newOptions;
      let me = this;
      axios
        .post("/vtiger_config", {
          id: me.user_id,
          object: me.selected,
          vtid: me.vtContactId,
        })
        .then(function (response) {
          me.closeModal();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    listNewUsers() {
      let me = this;
      this.loading = true;
      axios
        .get("/imm/contacts")
        .then(function (response) {
          console.log(response);
          me.newUsersArr = response.data;
        })
        .finally(() => (this.loading = false))
        .catch(function (error) {
          console.table(error);
        });
    },
    importUsers() {
      this.submitted = true;
      this.errors = {};
      this.valideForm();
      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }

      let me = this;
      axios
        .post("/imm/contacts", {
          newUsers: me.newUsersArr,
          newPassword: me.newPassword,
        })
        .then(function (response) {
          me.closeModal();
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    valideForm() {
      if (!this.newPassword) {
        this.errors.newPassword = "Password for all users is required";
      }
    },
  },

  mounted() {
    this.listUsers();
  },
};
</script>

