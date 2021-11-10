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
                      <td v-text="userObj.last_name"></td>
                    </tr>
                    <tr>
                      <th>Nationalities</th>
                      <td v-text="userObj.nationalities"></td>
                    </tr>
                    <tr>
                      <th>Mobile phone</th>
                      <td v-text="userObj.mobile_phone"></td>
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
                      <td v-text="userObj.secondary_email"></td>
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
                    <label for="inputEmail">Email address</label>
                    <input
                      type="email"
                      class="form-control"
                      id="inputEmail"
                      aria-describedby="emailHelp"
                      placeholder="Enter email"
                      v-model="email"
                    />
                    <small
                      v-if="submitted && errors.email"
                      class="text-danger font-14"
                      >{{ errors.email }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputEmail2">Secondary email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="inputEmail2"
                      aria-describedby="secondary_emailHelp"
                      placeholder="Enter secondary_email"
                      v-model="secondary_email"
                    />
                    <small
                      v-if="submitted && errors.secondary_email"
                      class="text-danger font-14"
                      >{{ errors.secondary_email }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputName"
                      aria-describedby="textHelp"
                      placeholder="Type your name or names"
                      v-model="name"
                    />
                    <small
                      v-if="submitted && errors.name"
                      class="text-danger font-14"
                      >{{ errors.name }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputLastName">Last name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputLastName"
                      aria-describedby="textHelp"
                      placeholder="Ingrese primer apellido"
                      v-model="last_name"
                    />
                    <small
                      v-if="submitted && errors.last_name"
                      class="text-danger font-14"
                      >{{ errors.last_name }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputNationalities">Nationalities</label>
                    <!-- Be dropdown -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputNationalities"
                      aria-describedby="textHelp"
                      placeholder="Ingrese primer apellido"
                      v-model="nationalities"
                    />
                    <small
                      v-if="submitted && errors.nationalities"
                      class="text-danger font-14"
                      >{{ errors.nationalities }}</small
                    >
                  </div>

                  <div class="form-group">
                    <label for="inputmobphone">Mobile phone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputmobphone"
                      aria-describedby="textHelp"
                      placeholder="Type your principal Mobile phone number"
                      v-model="mobile_phone"
                    />
                    <small
                      v-if="submitted && errors.mobile_phone"
                      class="text-danger font-14"
                      >{{ errors.mobile_phone }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputphone">Phone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputphone"
                      aria-describedby="textHelp"
                      placeholder="Type your home phone"
                      v-model="phone"
                    />
                    <small
                      v-if="submitted && errors.phone"
                      class="text-danger font-14"
                      >{{ errors.phone }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputfax">Fax</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputfax"
                      aria-describedby="textHelp"
                      placeholder="Type your fax number"
                      v-model="fax"
                    />
                    <small
                      v-if="submitted && errors.fax"
                      class="text-danger font-14"
                      >{{ errors.fax }}</small
                    >
                  </div>

                  <div class="form-group">
                    <label for="inputSecondLastName">Watsapp number</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputSecondLastName"
                      aria-describedby="textHelp"
                      placeholder="Type number that user for wasapp"
                      v-model="watsapp_no"
                    />
                    <small
                      v-if="submitted && errors.watsapp_no"
                      class="text-danger font-14"
                      >{{ errors.watsapp_no }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputCareAgent">Care agent</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputCareAgent"
                      aria-describedby="textHelp"
                      placeholder="Type number that user for wasapp"
                      v-model="care_agent"
                    />
                    <small
                      v-if="submitted && errors.care_agent"
                      class="text-danger font-14"
                      >{{ errors.care_agent }}</small
                    >
                  </div>

                  <div class="form-check">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      id="statusCheck"
                      v-model="email_out_op"
                    />
                    <label class="form-check-label" for="statusCheck"
                      >Email out option ?</label
                    >
                    <small id="textHelp" class="form-text text-muted"
                      >Now email out is :</small
                    >
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-check">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="passportCheck"
                          v-model="has_passport"
                        />
                        <label class="form-check-label" for="passportCheck"
                          >Has passport
                        </label>
                        <small id="textHelp" class="form-text text-muted"
                          >Actual status :
                        </small>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="inputPassportExpiration"
                          >Passport expiration date</label
                        >
                        <input
                          type="date"
                          class="form-control"
                          id="inputPassportExpiration"
                          aria-describedby="textHelp"
                          placeholder="Type number that user for wasapp"
                          v-model="watsapp_no"
                        />
                        <small
                          v-if="submitted && errors.watsapp_no"
                          class="text-danger font-14"
                          >{{ errors.watsapp_no }}</small
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button
                v-if="actionType == 1"
                type="button"
                class="btn btn-primary fas fa-save"
                v-on:click="updateAccount()"
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
</template>

<script>
export default {
  data() {
    return {
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
          me.userObj = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    updateAccount() {
      this.submitted = true;
      this.errors = {};
      this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      let me = this;
      axios
        .put("/account", {
          name: this.name,
          last_name: this.last_name,
          nationalities: this.nationalities,
          mobile_phone: this.mobile_phone,
          lead_source: this.lead_source,
          watsapp_no: this.watsapp_no,
          refered_by: this.refered_by,
          email: this.email,
          assigned_to: this.assigned_to,
          qualified_for: this.qualified_for,
          secondary_email: this.secondary_email,
          email_out_op: this.email_out_op,
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
          description: this.description,

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

    closeModal() {
      //Cerrar modals
      this.modal = 0;
      (this.name = ""),
        (this.first_last_name = ""),
        (this.second_lastname = ""),
        (this.email = ""),
        (this.contract_type = ""),
        (this.code = ""),
        //(this.active = false);

        (this.submitted = false);
      this.errors = {};
      this.userAccount();
    },

    //Validar campos requeridos
    valideForm() {
      if (!this.code) {
        this.errors.code = "El código es un campo requerido";
      }

      if (!this.name) {
        this.errors.name = "El nombre es un campo requerido";
      }
      this.validateField("name");

      if (!this.last_name) {
        this.errors.last_name =
          "Last name is required";
      }
      this.validateField("last_name");

      if (!this.nationalities) {
        this.errors.nationalities =
          "Nationalities is required";
      }
      this.validateField("nationalities");

      if (!this.phone) {
        this.errors.phone =
          "Phone is required";
      }
      this.validateField("phone");

      if (!this.email) {
        this.errors.email = "El correo electrónico es un campo requerido";
      }
      this.validateField("email");
    },
    validateField(field) {
      if (field === "email") {
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
          this.errors.email = "Please enter a valid email address";
        }
        return;
      }
      if (field === "secondary_email") {
        if (
          !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
            this.secondary_email
          )
        ) {
          this.errors.secondary_email = "Please enter a valid email address";
        }
        return;
      }

      if (!/^[A-Za-z\u00C0-\u00FF\-\_]*$/i.test(this.field)) {
        this.errors[field] = `El campo ${field} solo admite letras y guiones`;
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
                (this.last_name = data.last_name),
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
                (this.description = data.description),
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
.modal-content {
  width: 100% !important;
  position: fixed !important;
  overflow-y: visible;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: fixed !important;
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

