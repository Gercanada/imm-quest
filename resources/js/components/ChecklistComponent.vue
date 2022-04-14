<template>
  <div class="card-body">
    <div class="table-responsive mt-0">
      <table class="table">
        <tbody>
          <tr>
            <th>Checklist No</th>
            <td>{{ checklist.checklistno }}</td>
          </tr>
          <!--   <tr>
                        <th>Active Items</th>
                        <td>{{ checklist.cf_1185 }}</td>
                    </tr>
                    <tr>
                        <th>Completed Items</th>
                        <td>{{ checklist.cf_1189 }}</td>
                    </tr> -->
          <tr>
            <th>Status</th>
            <td>{{ checklist.cf_1179 }}</td>
          </tr>
          <tr>
            <th>Checklist Type</th>
            <td>{{ checklist.cf_1706 }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="shadow p-1 mt-4 rounded">
      <h3 class="card-title">
        <i class="mr-1 font-18 mdi mdi-timelapse"></i> Pending items
      </h3>
      <div class="table-responsive mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">CL Item Name</th>
              <!-- <td>Description</td> -->
              <th scope="col">Status</th>
              <th scope="col">Category</th>
              <!--   <td>Uploaded file Name</td>
                            <th scope="col">Upload file</th> -->
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="clitem_a in clitems"
              v-if="
                (clitem_a.cf_1578 === 'Pending' ||
                  clitem_a.cf_1578 === 'Replacement Needed') &&
                clitem_a.cf_1200 === 'Document'
              "
            >
              <td>{{ clitem_a.name }}</td>
              <!-- <td>{{ clitem_a.cf_acf_rtf_1208 }}</td> -->
              <td>{{ clitem_a.cf_1578 }}</td>
              <td>{{ clitem_a.cf_1200 }}</td>
              <!-- <td>{{ clitem_a.cf_1970 }}</td>
                            <td>
                                <a :href="clitem_a.cf_1212">{{
                                    clitem_a.cf_1212
                                }}</a>
                            </td> -->
              <td>
                <div
                  v-if="
                    clitem_a.cf_1578 === 'Pending' ||
                    clitem_a.cf_1578 === 'Replacement Needed'
                  "
                >
                  <div class="btn-list" v-if="clitem_a.files['files'].length == 0">
                    <button
                      type="button"
                      class="btn btn-outline-primary btn-rounded"
                      @click="openModal('documents', 'store', clitem_a.id)"
                    >
                      <i class="fas fa-upload"></i>Upload file
                    </button>
                  </div>

                  <div v-else>
                    <div v-for="file in clitem_a.files['files']">
                      <label
                        class="text-center"
                        for=""
                        v-text="file.split('/')[file.split('/').length - 1]"
                      ></label>
                      <div class="btn-list">
                        <button
                          v-if="sending === true"
                          type="button"
                          class="btn btn-outline-success btn-rounded"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Send document"
                          disabled
                        >
                          <i class="fas fa-spinner fa-spin"></i>
                          Send
                        </button>

                        <button
                          v-else
                          type="button"
                          class="btn btn-outline-success btn-rounded"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Send document"
                          @click="sendToImmcase(file, clitem_a.clitemsno)"
                        >
                          <i class="fas fa-paper-plane"></i>
                          Send
                        </button>

                        <button
                          v-if="deleting === true"
                          type="button"
                          class="btn btn-outline-danger btn-rounded"
                          disabled
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Remove document"
                        >
                          <i class="fas fa-spinner fa-spin"></i>
                          Delete
                        </button>

                        <button
                          v-else
                          type="button"
                          class="btn btn-outline-danger btn-rounded"
                          @click="deleteFile(file)"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Remove document"
                        >
                          <i class="fas fa-trash-alt"></i>
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="shadow p-1 mt-4 rounded">
      <h3 class="card-title">
        <i class="mr-1 font-18 mdi mdi-telegram"></i>Submited items
      </h3>
      <div class="table-responsive mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">CL Item Name</th>
              <th scope="col">File Name</th>
              <th scope="col">Category</th>
              <th scope="col">Status</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="clitem_e in clitems"
              v-if="
                clitem_e.cf_1578 === 'Received' ||
                clitem_e.cf_1578 === 'Accepted' ||
                clitem_e.cf_1578 === 'Not Required Anymore'
              "
            >
              <td>{{ clitem_e.name }}</td>
              <td>{{ clitem_e.cf_1970 }}</td>
              <td>{{ clitem_e.cf_1200 }}</td>
              <td>{{ clitem_e.cf_1578 }}</td>
              <td>
                <a
                  :href="'/checklist/' + checklist.id + '/item/' + clitem_e.id"
                  data-toggle="tooltip"
                  title="View details"
                  class="btn btn-outline-success btn-rounded"
                >
                  <i class="fas fa-eye"></i>Details
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

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
                data-dismiss="modal"
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
                    <!--  <label for="attachment" class="leading-7 text-sm text-gray-600"
                      >Attachments</label
                    > -->
                    <br />
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
                type="button"
                class="btn btn-primary fas fa-save"
                @click="shootMessage"
              >
                Save
              </button>
              <button
                @click="closeModal()"
                type="button"
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
    </template>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
const urlParams = window.location.pathname.split("/");
export default {
  name: "checklistComponent",
  props: {
    name: String,
    f_checklist_id: String,
  },
  data() {
    return {
      dropzoneOptions: {
        url: "/cl-item/upload/file",
        thumbnailWidth: 150,
        maxFilesize: 5,
        parallelUploads: 1,
        maxFiles: 1,
        uploadMultiple: false,
        autoProcessQueue: false,
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf,.doc,.docx",
        addRemoveLinks: true,
        dictRemoveFile: "Remove file",
        // clickable: false,
        headers: {
          "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
        },

        init: function () {
          this.on("addedfile", function (file) {
            if (this.files.length > 1) {
              this.removeFile(this.files[0]);
            }
          });
        },
      },
      clitems: [],
      checklist: "",
      loading: false,
      sending: false,
      deleting: false,
      checklist_id: urlParams[2],
      modal: 0,
      modalTitle: "",
      actionType: 0,
      submitted: false,
      errors: {},
      sendSuccess: false,
      clFiles: [],
    };
  },
  mounted() {
    this.show();
  },
  components: {
    vueDropzone: vue2Dropzone,
  },

  methods: {
    afterUploadComplete: async function () {
      let me = this;
      Swal.fire({
        type: "success",
        title: "Upload successfull!",
        timer: 2000,
        showConfirmButton: false,
      });
      me.closeModal();
    },

    shootMessage: async function () {
      this.submitted = true;
      this.errors = {};
      //   console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        console.table(this.errors);
        return;
      }
      this.$refs.myVueDropzone.processQueue();
    },

    sendMessage: async function (files, xhr, formData, id) {
      formData.append("id", this.clitemID);
    },

    sendToImmcase(file, clitemsno) {
      let me = this;
      me.sending = true;
      axios
        .post("/cl-item/send_file", {
          clitemsno: clitemsno,
          file: file,
        })
        .then(function (response) {
          //   console.log(response);
          if (response.data === "success" || response.status === 200) {
            Swal.fire({
              type: "success",
              title: "Document sent. ",
              timer: 3000,
              showConfirmButton: false,
            });
            me.deleteFile(file);
          }
          me.show();
        })
        .catch(function (error) {
          console.table(error);
          Swal.fire({
            type: "error",
            title: "Document not sent",
            timer: 2000,
            showConfirmButton: false,
          });
        })
        .finally(() => (this.sending = false));
    },

    deleteFile(file) {
      let me = this;
      me.deleting = true;
      axios
        .post("/cl-item/dropfile", { file: file })
        .then(function (response) {
          //   console.log(response);
          Swal.fire({
            type: "success",
            title: "Document deleted",
            timer: 2000,
            showConfirmButton: false,
          });
          me.show();
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (me.deleting = false));
    },

    removedfile: function (file, respuesta) {
      const params = {
        imagen: file.nombreServidor,
        uuid: document.querySelector("#dropzone").value,
      };

      axios.post("/drive/delete", params).then((respuesta) => {
        // Eliminar del DOM
        file.previewElement.parentNode.removeChild(file.previewElement);
      });
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.description = "";
      this.expiry_date = "";
      this.issued_date = "";
      this.dropzone = null;
      this.submitted = false;
      this.errors = {};
      this.show();
    },

    openModal(model, action, data = []) {
      console.log(data);
      switch (model) {
        case "documents": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.clitemID = data;
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

    /*  */
    show() {
      let me = this;
      this.loading = true;
      let checklistID = 0;
      if (me.f_checklist_id === undefined) {
        checklistID = me.checklist_id;
      } else {
        checklistID = me.f_checklist_id;
      }
      axios
        .get("/checklist/" + checklistID + "/items")
        .then(function (response) {
          me.checklist = response.data[0];
          me.clitems = response.data[1];
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    exportResponse(clitems_no) {
      let me = this;
      me.loading = true;
      axios
        .post("/questionaries/export_response", {
          clitemsno: clitems_no,
        })
        .then(function (response) {
          if (response.data === "success" || response.data === "Success") {
            Swal.fire({
              type: "success",
              title: " ✔ This survey has been answered and sent to manager. ✔",
              timer: 5000,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              type: "error",
              title:
                "❌ This survey has NOT answered. Please open the link and answer the survey. ❌",
              timer: 2000,
              showConfirmButton: false,
            });
          }
          me.show();
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title:
              "❌ This survey has NOT answered. Please open the link and answer the survey. ❌",
            timer: 2000,
            showConfirmButton: false,
          });
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
