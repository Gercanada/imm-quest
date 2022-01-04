
<template>
  <div v-if="loading">
    <div v-if="loading" style="heigth: 100%">
      <div class="card shadow-lg p-1">
        <div class="card-body">
          <div class="card-body d-flex justify-content-around">
            <div class="spinner-grow text-success center" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <div class="row">
      <div class="card shadow-lg p-1">
        <div class="card-header">
          <h3 class="text-themecolor mb-0">Documents</h3>
          <!--  <button
            type="button"
            class="btn btn-primary fas fa-edit float-right"
            @click="openModal('documents', 'store')"
          >
            New document
          </button> -->
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Document Type</th>
                  <th scope="col">File Type</th>
                  <th scope="col">File Name</th>
                  <th scope="col">Document No</th>
                  <th scope="col">date</th>
                  <th scope="col">download</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="document in docsArr"
                  :key="document.id"
                  :value="document.id"
                >
                  <td v-text="document.notes_title"></td>
                  <td v-text="document.cf_1491"></td>
                  <td v-text="document.filetype"></td>
                  <td v-text="document.filename"></td>
                  <td v-text="document.note_no"></td>
                  <td v-text="document.modifiedtime"></td>
                  <td>
                    <a
                      v-if="document.cf_2271 != ''"
                      :href="document.cf_2271"
                      class="btn btn-outline-success btn-rounded"
                      target="_blank"
                      download
                    >
                      <i class="fas fa-download"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="row">
            <div class="col-md-8 sm-8">
              <div style="overflow-x: auto; min-width: 80%"></div>
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
                    <div
                      style="overflow-x: auto; overflow-y: auto; min-width: 80%"
                    >
                      <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="inputTitle"
                          aria-describedby="textHelp"
                          placeholder="Document title"
                          v-model="title"
                        />
                        <small
                          v-if="submitted && errors.title"
                          class="text-danger font-14"
                          >{{ errors.title }}</small
                        >
                      </div>
                      <div class="form-group">
                        <label for="inputIssued">Issued date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="inputIssued"
                          aria-describedby="textHelp"
                          placeholder="2021/02/19"
                          v-model="issued_date"
                        />
                        <small
                          v-if="submitted && errors.issued_date"
                          class="text-danger font-14"
                          >{{ errors.issued_date }}</small
                        >
                      </div>
                      <div class="form-group">
                        <label for="inputExpiry">Expiry date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="inputExpiry"
                          aria-describedby="textHelp"
                          placeholder="2025/02/19"
                          v-model="expiry_date"
                        />
                        <small
                          v-if="submitted && errors.expiry_date"
                          class="text-danger font-14"
                          >{{ errors.expiry_date }}</small
                        >
                      </div>
                      <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <input
                          type="text"
                          class="form-control"
                          id="inputDescription"
                          aria-describedby="textHelp"
                          placeholder="Type description about"
                          v-model="description"
                        />
                        <small
                          v-if="submitted && errors.description"
                          class="text-danger font-14"
                          >{{ errors.description }}</small
                        >
                      </div>
                    </div>
                  </form>
                </div>
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
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  data() {
    return {
      dropzoneOptions: {
        url: "/documents",
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

      id: "",
      user_id: "",
      title: "",
      description: "",
      url_files: "",
      expiry_date: "",
      issued_date: "",

      //
      userObj: {},
      docsArr: [],
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
    //console.log("Component mounted.");
  },
  methods: {
    afterUploadComplete: async function (response) {
      if (response.status == "success") {
        console.log("upload successful");
        this.sendSuccess = true;
      } else {
        console.log("upload failed");
      }
    },
    shootMessage: async function () {
      this.submitted = true;
      this.errors = {};
      this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        console.log(this.errors);
        return;
      }

      console.log("done here");

      this.$refs.myVueDropzone.processQueue();

      let me = this;

      axios
        .post("/documents", {
          title: this.title,
          last_name: this.last_name,
          description: this.description,
          expiry_date: this.expiry_date,
          id: this.id,
        })
        .then(function (response) {
          me.closeModal();
          me.userFiles();
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    sendMessage: async function (files, xhr, formData) {
      formData.append("email", this.email);
      formData.append("message", this.message);
      formData.append("recipient", this.recipient);
    },

    ////////////////////////
    userFiles() {
      let me = this;
      this.loading = true;
      axios
        .get("/get_documents")
        .then(function (response) {
          console.log({ response });
          me.docsArr = response.data;
        })
        .finally(() => (this.loading = false))
        .catch(function (error) {
          console.log(error);
        });
    },

    closeModal() {
      //Cerrar modals
      this.modal = 0;
      (this.title = ""),
        (this.description = ""),
        (this.expiry_date = ""),
        (this.issued_date = ""),
        (this.submitted = false);
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
            case "update": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
              this.id = data.id;
              this.actionType = 2;
              break;
            }
            case "update": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
              this.id = data.id;
              this.actionType = 2;
              break;
            }
          }
        }
      }
    },
  },
};
</script>
