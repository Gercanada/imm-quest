<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            account
            <button
              type="button"
              class="btn btn-primary fas fa-edit float-right"
              @click="openModal('account', 'update')"
            >
              Editar
            </button>
          </div>
          <div class="card-body">
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
          <!-- Modal edit acount -->
        </div>
      </div>
    </div>

    <template v-if="actionType == 1">
      <div
        class="modal fade"
        tabindex="-1"
        :class="{ mostrar: modal }"
        role="dialog"
        aria-labelledby="myModalLabel"
        style="display: none"
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
                    <label for="inputName">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputName"
                      aria-describedby="textHelp"
                      placeholder="Ingrese nombre"
                      v-model="name"
                    />
                    <small
                      v-if="submitted && errors.name"
                      class="text-danger font-14"
                      >{{ errors.name }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputcode">Codigo</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputcode"
                      aria-describedby="textHelp"
                      placeholder="Ingrese su codigo"
                      v-model="code"
                    />
                    <small
                      v-if="submitted && errors.code"
                      class="text-danger font-14"
                      >{{ errors.code }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputFirstLastName">Primer apellido</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputFirstLastName"
                      aria-describedby="textHelp"
                      placeholder="Ingrese primer apellido"
                      v-model="first_last_name"
                    />
                    <small
                      v-if="submitted && errors.first_last_name"
                      class="text-danger font-14"
                      >{{ errors.first_last_name }}</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="inputSecondLastName">Segundo paellido</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputSecondLastName"
                      aria-describedby="textHelp"
                      placeholder="Ingrese segundo apellido"
                      v-model="second_lastname"
                    />
                    <small
                      v-if="submitted && errors.second_lastname"
                      class="text-danger font-14"
                      >{{ errors.second_lastname }}</small
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      id="statusCheck"
                      v-model="active"
                    />
                    <label class="form-check-label" for="statusCheck"
                      >Activo /Inactivo</label
                    >
                    <small id="textHelp" class="form-text text-muted"
                      >Estado actual</small
                    >
                  </div>

                  <div class="form-group">
                    <label for="inputContractType">Tipo de contrato</label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputContractType"
                      aria-describedby="textHelp"
                      placeholder="Ingrese su tipo de contrato"
                      v-model="contract_type"
                    />
                    <small
                      v-if="submitted && errors.contract_type"
                      class="text-danger font-14"
                      >{{ errors.contract_type }}</small
                    >
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
    this.userInfo();
    //console.log("Component mounted.");
  },
  methods: {
    userInfo() {
      let me = this;
      axios
        .get("/userinfo")
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
          /*  name: this.name,
          first_last_name: this.first_last_name,
          second_lastname: this.second_lastname,
          email: this.email,
          contract_type: this.contract_type,
          code: this.code,
          active: this.active, */
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
          // agent_id: this.agent_id,
          description: this.description,

          id: this.id,
        })
        .then(function (response) {
          me.closeModal();
          me.userInfo();
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
        (this.active = false);

      this.submitted = false;
      this.errors = {};
      this.userInfo();
    },

    openModal(model, action, data = []) {
      console.log(action);
      switch (model) {
        case "account": {
          switch (action) {
            case "update": {
              this.modal = 1;
              this.modalTitle = "Update data";
              (this.name = data.name),
                (this.first_last_name = data.first_last_name),
                (this.second_lastname = data.second_lastname),
                (this.email = data.email),
                (this.contract_type = data.contract_type),
                (this.code = data.code),
                (this.active = data.active);
              this.id = data.id;
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

