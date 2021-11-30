<template>
  <main class="main">
    <div v-if="loading" style="heigth: 100%">
      <div class="card">
        <div class="card-body d-flex justify-content-around">
          <div class="spinner-grow text-success center" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>

    <div v-else>
      <div class="card">
        <div class="card-header">
          <a
            :href="'/checklist/' + clitem.cf_1216"
            class="btn btn-outline-info btn-rounded float-left"
            ><i class="fas fa-arrow-circle-left">Go to checklists</i></a
          >
          <h2 class="card-title">CL Item <b v-text="subject"></b></h2>
        </div>
        <div class="card-body">
          <div class="card-row">
            <div class="col border py-2">
              <h4>Case</h4>
              <table class="table v-middle fs-3 mb-0 mt-4">
                <tbody>
                  <tr>
                    <td>Case No</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.ticket_no"
                    ></td>
                  </tr>
                  <tr>
                    <td>Case title</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.ticket_title"
                    ></td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.ticketcategories"
                    ></td>
                  </tr>
                  <tr>
                    <td>Subcategory</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.cf_890"
                    ></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.ticketstatus"
                    ></td>
                  </tr>
                  <tr>
                    <td>No of Applicantions</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.cf_888"
                    ></td>
                  </tr>
                  <tr>
                    <td>Government App No</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.cf_884"
                    ></td>
                  </tr>
                  <tr>
                    <td>Open Date</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.cf_866"
                    ></td>
                  </tr>

                  <tr>
                    <td>Case type</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.ticketcategories"
                    ></td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="caseObj.description"
                    ></td>
                  </tr>

                  <tr></tr>
                </tbody>
              </table>

            </div>
            <div class="col border py-2">
              <h4>Checklist</h4>
              <table class="table v-middle fs-3 mb-0 mt-4">
                <tbody>
                  <tr>
                    <td>Checklist No</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.checklistno"
                    ></td>
                  </tr>
                  <tr>
                    <td>Subject</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.name"
                    ></td>
                  </tr>
                  <tr>
                    <td>% Completed</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_2079"
                    ></td>
                  </tr>
                  <tr>
                    <td>Checklist Type</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1706"
                    ></td>
                  </tr>
                  <tr>
                    <td>Applicant Full Name</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1181"
                    ></td>
                  </tr>
                  <tr>
                    <td>Completed Items</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1189"
                    ></td>
                  </tr>
                  <tr>
                    <td>Pending Items</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1187"
                    ></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1179"
                    ></td>
                  </tr>
                  <tr>
                    <td>Related to</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="checklistObj.cf_1183"
                    ></td>
                  </tr>
                  <tr></tr>
                </tbody>
              </table>
            </div>
            <div class="col border py-2">
              <h2>CL Item info</h2>

              <table class="table v-middle fs-3 mb-0 mt-4">
                <tbody>
                  <tr>
                    <td>CLItems No</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.clitemsno"
                    ></td>
                  </tr>
                  <tr>
                    <td>Subject</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.name"
                    ></td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_acf_rtf_1208"
                    ></td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1200"
                    ></td>
                  </tr>
                  <tr>
                    <td>Item Status</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1578"
                    ></td>
                  </tr>
                  <tr>
                    <td>Required To</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1202"
                    ></td>
                  </tr>

                  <tr>
                    <td>Required by</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1204"
                    ></td>
                  </tr>
                  <tr>
                    <td>Help Link</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1212"
                    ></td>
                  </tr>
                  <tr>
                    <td>Message to Client</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1898"
                    ></td>
                  </tr>

                  <tr>
                    <!-- Editables on CP -->
                    <td>Upload file</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_acf_ulf_1778"
                    ></td>
                  </tr>
                  <tr>
                    <!-- Editables on CP -->
                    <td>Uploaded date</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.modifiedtime"
                    ></td>
                    <!-- Modified date -->
                  </tr>
                  <tr>
                    <!-- Editables on CP -->
                    <td>Original File Name</td>
                    <td
                      class="text-end font-weight-medium"
                      v-text="clitem.cf_1970"
                    ></td>
                  </tr>
                  <tr></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>

        <!-- Modal edit acount -->
        <!--   <template v-if="actionType == 1"> -->

        <!-- </template> -->
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card" v-if="clitem.cf_1200 == 'IMM Form'">
            <div class="col border py-2">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <p>Helplink</p>
                    b
                  </div>
                  <div class="row">
                    <p>Status</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <p>Link</p>
                  </div>
                  <div class="row">
                    <p>Pending</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else-if="clitem.cf_1578 === 'Pending'">
            <button
              type="button"
              class="btn btn-primary btn-lg fas fa-edit float-right"
              data-toggle="modal"
              :data-target="'#modal_' + clitem.id"
              @click="openModal('documents', 'store', clitem.id)"
            >
              New document
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      :id="'modal_' + clitem.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="scrollableModalTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="modalTitle"></h4>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="closeModal()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" class="form-horizontal"></form>
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-full">
                <div class="relative">
                  <label
                    for="attachment"
                    class="leading-7 text-sm text-gray-600"
                    >Attachments</label
                  ><br />
                  <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                    @vdropzone-complete="afterUploadComplete"
                    @vdropzone-sending-multiple="sendMessage"
                  ></vue-dropzone>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button
              v-if="actionType == 1"
              type="button"
              class="btn btn-primary fas fa-save"
              @click="shootMessage"
            >
              Save
            </button>
            <button
              @click="closeModal()"
              type="button"
              v-if="actionType == 1"
              class="btn btn-danger"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </main>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
const urlParams = window.location.pathname.split("/");

export default {
  data() {
    return {
      dropzoneOptions: {
        // url: "/drive/upload",
        url: "/cl-item/upload/file",
        thumbnailWidth: 150,
        maxFilesize: 5,
        parallelUploads: 3,
        maxFiles: 3,
        uploadMultiple: true,
        autoProcessQueue: false,

        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",
        addRemoveLinks: true,
        dictRemoveFile: "Remove file",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
            .content,
        },
      },

      id: urlParams[4],
      user_id: "",
      checklist_id: "",

      title: "",
      subject: "",
      description: "",
      url_files: "",
      expiry_date: "",
      issued_date: "",

      //
      clitem: {},
      caseObj: {},
      checklistObj: {},
      modal: 0,
      modalTitle: "",
      actionType: 0,
      submitted: false,
      errors: {},

      loading: false,
    };
  },
  components: {
    vueDropzone: vue2Dropzone,
  },
  mounted() {
    this.userFiles();
  },
  methods: {
    afterUploadComplete: async function (response) {
      if (response.status == "200") {
        console.log("upload successful");
        this.sendSuccess = true;
      } else {
        console.log("upload failed");
      }
    },
    shootMessage: async function () {
      this.submitted = true;
      this.errors = {};
      // this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        console.log(this.errors);
        return;
      }
      this.$refs.myVueDropzone.processQueue();

      let me = this;

      axios
        //.post("/drive/upload", { file })
        .post("/cl-item/upload/file", {
          title: this.title,
          last_name: this.last_name,
          description: this.description,
          expiry_date: this.expiry_date,
          id: this.id,
        })
        .then(function (response) {
          console.log({ response });
          me.closeModal();
          //me.userFiles();
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    sendMessage: async function (files, xhr, formData) {
      formData.append("id", this.id);
      formData.append("email", this.email);
      formData.append("message", this.message);
      formData.append("recipient", this.recipient);
    },

    removedfile: function (file, respuesta) {
      console.log(file);

      const params = {
        imagen: file.nombreServidor,
        uuid: document.querySelector("#dropzone").value,
      };

      axios.post("/drive/delete", params).then((respuesta) => {
        console.log(respuesta);

        // Eliminar del DOM
        file.previewElement.parentNode.removeChild(file.previewElement);
      });
    },

    ////////////////////////
    userFiles() {
      /*  const urlParams = window.location.pathname.split("/");
      console.log(urlParams); */

      let me = this;
      this.loading = true;
      axios
        .post("/cl-item", { id: me.id })
        .then(function (response) {
          console.log(response.data);
          me.clitem = response.data[0];
          me.caseObj = response.data[1];
          me.checklistObj = response.data[2];
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    closeModal() {
      //Cerrar modals
      this.modal = 0;
      this.title = "";
      this.description = "";
      this.expiry_date = "";
      this.issued_date = "";
      this.dropzone = null;
      //(this.active = false);

      this.submitted = false;
      this.errors = {};
      this.userFiles();
    },

    //Validar campos requeridos
    valideForm() {
      if (!this.title) {
        this.errors.title = "Title field is required";
      }
      this.validateField("title");

      if (!this.description) {
        this.errors.description = "Description is required";
      }
      this.validateField("description");

      if (!this.issued_date) {
        this.errors.issued_date = "Issued date is required";
      }
      this.validateField("issued_date");
      if (!this.expiry_date) {
        this.errors.expiry_date = "Expiry date is required";
      }
      this.validateField("expiry_date");
    },
    validateField(field) {
      if ("" == this.field) {
        this.errors[field] = `El campo ${field} solo admite letras y guiones`;
      }
    },

    openModal(model, action, data = []) {
      console.log(action);
      switch (model) {
        case "documents": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
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


