<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card-header">
          account
          <button
            type="button"
            class="btn btn-primary fas fa-edit float-right"
            @click="openModal('account', 'update', userObj)"
          >
            Editar
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col md-5 sm-8">
              <fieldset class="border-success">
                <legend>Info</legend>
                <div>
                  <p class="bg-danger">
                    ! Incomplete profile. Fill required fields to start
                    leadment. !
                  </p>
                </div>
              </fieldset>
              <fieldset class="border-success">
                <legend>Activities</legend>
                <div><p>Nothing now</p></div>
              </fieldset>
              <fieldset class="border-info">
                <legend>Comments</legend>
                <div><p>Nothing now</p></div>
              </fieldset>
            </div>
            <div class="col-md-7 sm-8">
              <div style="overflow-x: auto; min-width: 80%">
                <table class="table table-bordered table-striped table-sm">
                  <thead></thead>
                  <tbody>
                    <tr></tr>
                    <tr>
                      <th>Name</th>
                      <td v-text="userObj.name"></td>
                    </tr>
                    <tr></tr>
                    <tr>
                      <th>Last name</th>
                      <td
                        v-text="
                          userObj.contact_details
                            ? userObj.contact_details.lastname
                            : ''
                        "
                      ></td>
                    </tr>
                    <tr>
                      <th>Nationalities</th>
                      <td v-text="userObj.nationalities"></td>
                    </tr>
                    <tr>
                      <th>Mobile phone</th>
                      <td
                        v-text="
                          userObj.contact_details
                            ? userObj.contact_details.mobile
                            : ''
                        "
                      ></td>
                    </tr>
                    <tr>
                      <th>Watsapp number</th>
                      <td v-text="userObj.watsapp_no"></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td v-text="userObj.email"></td>
                    </tr>
                    <tr>
                      <th>Secondary email</th>
                      <td
                        v-text="
                          userObj.contact_details
                            ? userObj.contact_details.secondaryemail
                            : ''
                        "
                      ></td>
                    </tr>
                    <tr>
                      <th>Lead source</th>
                      <td v-text="userObj.lead_source"></td>
                    </tr>
                    <tr>
                      <th>Refered by</th>
                      <td v-text="userObj.refered_by"></td>
                    </tr>
                    <tr>
                      <th>Assigned to</th>
                      <td v-text="userObj.assigned_to"></td>
                    </tr>
                    <tr>
                      <th>Qualified for</th>
                      <td v-text="userObj.qualified_for"></td>
                    </tr>
                    <tr>
                      <th>Care agent</th>
                      <td v-text="userObj.care_agent"></td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td v-text="userObj.phone"></td>
                    </tr>
                    <tr>
                      <th>Fax</th>
                      <td v-text="userObj.fax"></td>
                    </tr>
                    <tr>
                      <th>Passport expiration date</th>
                      <td v-text="userObj.passport_expiration_date"></td>
                    </tr>
                    <tr>
                      <th>Rating</th>
                      <td v-text="userObj.rating"></td>
                    </tr>
                    <tr>
                      <th>Description</th>
                      <td v-text="userObj.description"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit acount -->
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
            <div class="modal-header">
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
              <form enctype="multipart/form-data" class="form-horizontal">
                <div style="overflow-x: auto; overflow-y: auto; min-width: 80%">
                  <div class="form-group">
                    <!-- here shows username assigned by immcase, this cant be changed -->
                    <label for="inputEmail2">User name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputEmail2"
                      aria-describedby="secondary_emailHelp"
                      placeholder="Default username"
                      v-model="user_name"
                      disabled
                    />
                  </div>
                  <div class="form-group">
                    <!-- alternative username -->
                    <label for="alternative-username"
                      >Alternative username</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="alternative-username"
                      aria-describedby="alternative username"
                      placeholder="Enter alternative username"
                      v-model="alternative_username"
                    />
                    <small
                      v-if="submitted && errors.alternative_username"
                      class="text-danger font-14"
                      >{{ errors.alternative_username }}</small
                    >
                  </div>

                  <div class="form-group text-center mt-4">
                    <div class="col-xs-12">
                      <button
                        v-if="actionType == 1"
                        type="button"
                        class="btn btn-primary fas fa-user"
                        v-on:click="updateUsername()"
                      >
                        Update username
                      </button>
                    </div>
                  </div>
                  <!--  -->
                  <div class="form-group row">
                    <label
                      for="password"
                      class="col-md-4 col-form-label text-md-right"
                    >
                      Password</label
                    >

                    <div class="col-md-6">
                      <input
                        type="password"
                        class="
                          form-control
                          @error('password')
                          is-invalid
                          @enderror
                        "
                        v-model="password"
                        required
                        autocomplete="new-password"
                      />

                      <!-- @error('password') -->

                      <!--  @enderror -->
                    </div>
                  </div>

                  <div class="form-group row">
                    <label
                      for="password-confirm"
                      class="col-md-4 col-form-label text-md-right"
                      >Confirm Password</label
                    >

                    <div class="col-md-6">
                      <input
                        type="password"
                        class="form-control"
                        required
                        v-model="confirm_password"
                        autocomplete="new-password"
                      />

                      <small
                        v-if="submitted && errors.password"
                        class="text-danger font-14"
                        >{{ errors.password }}</small
                      >
                    </div>
                  </div>
                  <div class="form-group text-center mt-4">
                    <div class="col-xs-12">
                      <button
                        v-if="actionType == 1"
                        type="button"
                        class="btn btn-primary fas fa-key"
                        v-on:click="updatePassword()"
                      >
                        Change password
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
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
</template>

<script>
export default {
  data() {
    return {
      alternative_username: "",
      message: "",
      password: "",
      confirm_password: "",
      user_name: "",
      ////
      id: "",
      name: "",
      last_name: "",
      nationalities: "",
      mobile_phone: "",
      watsapp_no: "",
      lead_source: "",
      refered_by: "",
      email: "",
      assigned_to: "",
      qualified_for: "",
      secondary_email: "",
      email_out_op: "",
      lead_status_id: "",
      lead_stage_id: "",
      care_agent: "",
      phone: "",
      fax: "",
      has_passport: "",
      passport_expiration_date: "",
      rating: "",
      watsapp_update_option: "",
      agent_id: "",
      description: "",

      //
      userObj: {},
      modal: 0,
      modalTitle: "",
      actionType: 0,
      arrayEmployes: [],
      submitted: false,
      errors: {},
    };
  },
  mounted() {
    this.userAccount();
    //console.log("Component mounted.");
  },
  methods: {
    userAccount() {
      let me = this;
      axios
        .get("/account")
        .then(function (response) {
          console.log("here");
          console.log(response.data);
          console.log(response.data.user_name);
          /*    me.userObj = response.data; */

          me.user_name = response.data.user_name;
          me.alternative_username = response.data.alternative_username;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    updateAccount() {
      this.submitted = true;
      this.errors = {};
      //this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      let me = this;
      axios
        .post("/account", {
          /*  name: this.name,
          last_name: this.last_name,
          nationalities: this.nationalities, */
          mobile_phone: this.mobile_phone,
          /*  lead_source: this.lead_source,
          watsapp_no: this.watsapp_no,
          refered_by: this.refered_by,
          email: this.email,
          assigned_to: this.assigned_to,
          qualified_for: this.qualified_for, */
          secondary_email: this.secondary_email,
          /* email_out_op: this.email_out_op,
          lead_status_id: this.lead_status_id,
          lead_stage_id: this.lead_stage_id,
          care_agent: this.name,
          phone: this.phone,
          fax: this.fax,
          has_passport: this.has_passport,
          passport_expiration_date: this.passport_expiration_date,
          rating: this.rating,
          watsapp_update_option: this.watsapp_update_option,
          // agent_id              : this.agent_id,
          description: this.description, */

          id: this.id,
        })
        .then(function (response) {
          me.closeModal();
          me.userAccount();
        })
        .catch(function (error) {
          console.table(error);
        });
    },

    updateUsername() {
      this.submitted = true;
      this.errors = {};
      this.valideUsername();
      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      axios
        .post("/new_username", {
          alternative_username: this.alternative_username,
        })
        .then(function (response) {
          me.closeModal();
        })
        .catch(function (error) {
          console.table(error);
        });
    },

    updatePassword() {
      this.submitted = true;
      this.errors = {};
      this.validePass();
      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      axios
        .post("/new_password", {
          new_password: this.new_password,
          confirm_password: this.confirm_password,
        })
        .then(function (response) {
          me.closeModal();
        })
        .catch(function (error) {
          console.table(error);
        });
    },

    closeModal() {
      //Cerrar modals
      this.modal = 0;
      (this.name = ""),
        (this.first_last_name = ""),
        (this.second_lastname = ""),
        (this.email = ""),
        (this.code = ""),
        //(this.active = false);

        (this.submitted = false);
      this.errors = {};
      //this.userAccount();
    },

    //Validar campos requeridos
    validePass() {
      if (!this.password && !this.confirm_password) {
        this.errors.password = "Password fields cant be blank";
      }
      if (this.password) {
        if (this.password !== this.confirm_password) {
          this.errors.password = "Password and  confirm not equals";
        }
      }
    },
    valideUsername() {
      if (!this.alternative_username) {
        this.errors.alternative_username =
          "Alternative username field cant be empty";
      }
    },

    openModal(model, action, data = []) {
      console.log(action);
      switch (model) {
        case "account": {
          switch (action) {
            case "update": {
              console.log(data);
              this.modal = 1;
              this.modalTitle = "Update data";

              (this.name = data.name),
                (this.user_name = data.user_name),
                (this.alternative_username = data.alternative_username),
                /* (this.last_name = data.last_name),
                (this.nationalities = data.nationalities),
                (this.mobile_phone = data.mobile_phone),
                (this.watsapp_no = data.watsapp_no),
                (this.lead_source = data.lead_source),
                (this.refered_by = data.refered_by),
                (this.email = data.email),
                (this.assigned_to = data.assigned_to),
                (this.qualified_for = data.qualified_for),
                (this.secondary_email = data.secondary_email),
                (this.email_out_op = data.email_out_op),
                (this.lead_status_id = data.lead_status_id),
                (this.lead_stage_id = data.lead_stage_id),
                (this.care_agent = data.care_agent),
                (this.phone = data.phone),
                (this.fax = data.fax),
                (this.has_passport = data.has_passport),
                (this.passport_expiration_date = data.passport_expiration_date),
                (this.rating = data.rating),
                (this.watsapp_update_option = data.watsapp_update_option),
                (this.agent_id = data.agent_id),
                (this.description = data.description), */
                (this.id = data.id);
              this.actionType = 1;
              break;
            }
          }
        }
      }
    },
  },
};
</script>

<style>
</style>

