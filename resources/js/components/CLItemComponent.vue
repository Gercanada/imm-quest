<template>
    <div v-if="loading" style="heigth: 100%">
        <div class="card shadow p-1 rounded">
            <div class="card-body d-flex justify-content-around">
                <div class="spinner-grow text-success center" role="status">
                    <span class="sr-only" style="">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <div class="card shadow p-1 rounded">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <a
                        :href="'/checklist/' + clitem.cf_1216"
                        class="btn btn-outline-success btn-rounded"
                        ><i class="fas fa-arrow-circle-left"></i
                    ></a>
                </div>
                <div class="col-md-9 col-sm-12">
                    <h2 class="card-title">
                        CL Item <b v-text="clitem.name"></b>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow p-1 rounded">
                    <div class="card-body">
                        <div class="card-row">
                            <div class="col py-2">
                                <div class="row">
                                    <div class="col shadow p-1 rounded pt-1">
                                        <h4 class="card-title">
                                            <span
                                                class="
                                                    lstick
                                                    d-inline-block
                                                    align-middle
                                                "
                                            ></span>
                                            Case
                                            <b
                                                v-text="caseObj.ticket_title"
                                            ></b>
                                        </h4>
                                    </div>
                                </div>
                                <table class="table v-middle fs-3 mb-0 mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Status</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="caseObj.ticketstatus"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Open Date</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="caseObj.cf_866"
                                            ></td>
                                        </tr>

                                        <tr>
                                            <td>Case type</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="
                                                    caseObj.ticketcategories
                                                "
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="caseObj.description"
                                            ></td>
                                        </tr>

                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow p-1 rounded">
                    <div class="card-body">
                        <div class="card-row">
                            <div class="col py-2">
                                <div class="row">
                                    <div class="col shadow p-1 rounded pt-1">
                                        <h4 class="card-title">
                                            <span
                                                class="
                                                    lstick
                                                    d-inline-block
                                                    align-middle
                                                "
                                            ></span>
                                            Checklist
                                            <b v-text="checklistObj.name"></b>
                                        </h4>
                                    </div>
                                </div>
                                <table class="table v-middle fs-3 mb-0 mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Checklist No</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="
                                                    checklistObj.checklistno
                                                "
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>% Completed</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_2079"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Checklist Type</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_1706"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Applicant Full Name</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_1181"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Completed Items</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_1189"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Pending Items</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_1187"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="checklistObj.cf_1179"
                                            ></td>
                                        </tr>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow p-1 rounded">
                    <div class="card-body">
                        <div class="card-row">
                            <div class="col py-2">
                                <div class="row">
                                    <div
                                        class="col col shadow p-1 rounded pt-1"
                                    >
                                        <h4 class="card-title">
                                            <span
                                                class="
                                                    lstick
                                                    d-inline-block
                                                    align-middle
                                                "
                                            ></span>
                                            CLItem
                                        </h4>
                                    </div>
                                </div>

                                <table class="table v-middle fs-3 mb-0 mt-4">
                                    <tbody>
                                        <tr>
                                            <td>CLItems No</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.clitemsno"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Subject</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.name"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.cf_acf_rtf_1208"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.cf_1200"
                                            ></td>
                                        </tr>

                                        <tr>
                                            <!-- Editables on CP -->
                                            <td>Original File Name</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.cf_1970"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td>Item Status</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="clitem.cf_1578"
                                            ></td>
                                        </tr>

                                        <tr
                                            v-if="
                                                clitem.cf_1200 ===
                                                'Questionnaire'
                                            "
                                        >
                                            <!-- Editables on CP -->
                                            <td>Help link</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                            >
                                                <a :href="clitem.cf_1212">{{
                                                    clitem.cf_1212
                                                }}</a>
                                            </td>
                                        </tr>
                                        <tr
                                            v-if="
                                                clitem.cf_1200 ===
                                                'Questionnaire'
                                            "
                                        >
                                            <!-- Editables on CP -->
                                            <td>Completed survey</td>
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                            >
                                                <p
                                                    v-if="
                                                        survey.length > 0 &&
                                                        survey.submitdate != ''
                                                    "
                                                >
                                                    Yes
                                                </p>
                                                <p v-else>No</p>
                                            </td>
                                        </tr>

                                        <tr
                                            v-for="file in clFiles"
                                            :v-if="clFiles.length > 0"
                                            :key="file"
                                        >
                                            <td>Current file to send</td>
                                            <!--  <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                                v-text="file"
                                            ></td> -->
                                            <td
                                                class="
                                                    text-end
                                                    font-weight-medium
                                                "
                                            >
                                                <div
                                                    class="flex-container"
                                                    v-if="appEnv === 'local'"
                                                >
                                                    <div id="imgsrc">
                                                        <img
                                                            :src="
                                                                '/storage/' +
                                                                file
                                                            "
                                                            :alt="
                                                                file
                                                                    ? file.split(
                                                                          '/'
                                                                      )[9]
                                                                    : 'current-file'
                                                            "
                                                        />
                                                    </div>
                                                    <label
                                                        for="imgsrc"
                                                        class="labelforimg"
                                                        v-text="
                                                            file
                                                                ? file.split(
                                                                      '/'
                                                                  )[9]
                                                                : ''
                                                        "
                                                    ></label>
                                                </div>
                                                <div
                                                    v-else
                                                    class="flex-container"
                                                >
                                                    <div id="imgsrc">
                                                        <img
                                                            :src="
                                                                '/storage/app/public/' +
                                                                file
                                                            "
                                                            :alt="
                                                                file
                                                                    ? file.split(
                                                                          '/'
                                                                      )[9]
                                                                    : 'current-file'
                                                            "
                                                        />
                                                    </div>

                                                    <label
                                                        for="imgsrc"
                                                        class="labelforimg"
                                                        v-text="
                                                            file
                                                                ? file.split(
                                                                      '/'
                                                                  )[9]
                                                                : ''
                                                        "
                                                    ></label>
                                                </div>
                                                <!-- -->
                                            </td>
                                        </tr>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit acount -->
                </div>
                <!-- TODO check statues ofclitem -->
                <div class="card shadow p-1 rounded">
                    <div class="card-body">
                        <div
                            class="card shadow p-1 rounded"
                            v-if="clitem.cf_1200 == 'IMM Form'"
                        >
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
                        <!-- <h1 v-text="clitem"></h1> -->
                        <div class="row float-right">
                            <div class="col">
                                <div
                                    class="btn-list"
                                    v-if="
                                        clitem.cf_1200 != 'Questionnaire' &&
                                        (clitem.cf_1578 === 'Pending' ||
                                            clitem.cf_1578 ===
                                                'Replacement Needed') &&
                                        clFiles.length == 0
                                    "
                                >
                                    <button
                                        type="button"
                                        class="
                                            btn btn-primary btn-lg
                                            fas
                                            fa-edit
                                        "
                                        @click="
                                            openModal(
                                                'documents',
                                                'store',
                                                clitem.id
                                            )
                                        "
                                    >
                                        New document
                                    </button>
                                </div>

                                <div class="btn-list">
                                    <!-- survey -->
                                    <!-- $item->cf_1200 === "Questionnaire" -->
                                    <div
                                        v-if="
                                            clitem.cf_1200 ===
                                                'Questionnaire' &&
                                            survey.length > 0 &&
                                            survey.submitdate != '' &&
                                            (clitem.cf_1578 === 'Pending' ||
                                                clitem.cf_1578 ===
                                                    'Replacement Needed')
                                        "
                                        class="text-end font-weight-medium"
                                    >
                                        <!-- btn here -->
                                        <td>
                                            <button
                                                type="button"
                                                class="
                                                    btn btn-success btn-lg
                                                    fas
                                                    fa-paper-plane
                                                "
                                                @click="
                                                    exportResponse(
                                                        clitem.clitemsno
                                                    )
                                                "
                                            >
                                                Send survey document
                                            </button>
                                            <!--   <button
                                                v-else
                                                type="button"
                                                disabled
                                                class="
                                                    btn
                                                    btn-outline-success
                                                    btn-rounded
                                                "
                                            >
                                                <i
                                                    class="
                                                        fas
                                                        fa-plane
                                                        fas
                                                        fa-spin
                                                    "
                                                ></i>
                                            </button> -->
                                            <!--  <button
                                            type="button"
                                            class="
                                                btn btn-success btn-lg
                                                fas
                                                fa-paper-plane
                                            "
                                            @click="
                                                sendToImmcase(
                                                    file,
                                                    clitem.clitemsno
                                                )
                                            "
                                        >
                                            Send document
                                        </button> -->
                                            <!--  <button
                                                type="button"
                                                class="
                                                    btn btn-danger btn-lg
                                                    fas
                                                    fa-trash-alt
                                                "
                                                @click="deleteFile(file)"
                                            >
                                                Remove document
                                            </button> -->
                                        </td>
                                    </div>

                                    <!--  -->

                                    <div
                                        :v-if="
                                            clitem.cf_1200 != 'Questionnaire' &&
                                            (clitem.cf_1578 === 'Pending' ||
                                                clitem.cf_1578 ===
                                                    'Replacement Needed') &&
                                            clFiles.length > 0
                                        "
                                        v-for="file in clFiles"
                                        :key="file"
                                        class="text-end font-weight-medium"
                                    >
                                        <button
                                            type="button"
                                            class="
                                                btn btn-success btn-lg
                                                fas
                                                fa-paper-plane
                                            "
                                            @click="
                                                sendToImmcase(
                                                    file,
                                                    clitem.clitemsno
                                                )
                                            "
                                        >
                                            Send document
                                        </button>
                                        <button
                                            type="button"
                                            class="
                                                btn btn-danger btn-lg
                                                fas
                                                fa-trash-alt
                                            "
                                            @click="deleteFile(file)"
                                        >
                                            Remove document
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <h4
                                    class="modal-title"
                                    v-text="modalTitle"
                                ></h4>

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
                                            <label
                                                for="attachment"
                                                class="
                                                    leading-7
                                                    text-sm text-gray-600
                                                "
                                                >Attachments</label
                                            ><br />
                                            <vue-dropzone
                                                ref="myVueDropzone"
                                                id="dropzone"
                                                :options="dropzoneOptions"
                                                @vdropzone-complete="
                                                    afterUploadComplete
                                                "
                                                @vdropzone-sending-multiple="
                                                    sendMessage
                                                "
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
    </div>
</template>

<style scoped>
.flex-container {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.flex-container > div {
    margin: 10px;
    text-align: center;
    line-height: 75px;
    font-size: 30px;
}

#imgsrc {
    border: solid 2px gray;
    width: 100%;
    height: auto;
    max-height: 400px;
    position: relative;
    align-items: center;
    flex-grow: 8;
}
.labelforimg {
    text-align: center;
    flex-grow: 1;
}
img {
    width: auto;
    height: auto;
    max-width: 400px;
    max-height: 400px;
}
</style>
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
const urlParams = window.location.pathname.split("/");
export default {
    data() {
        return {
            appEnv: process.env.MIX_APP_ENV,
            dropzoneOptions: {
                url: "/cl-item/upload/file",
                thumbnailWidth: 150,
                maxFilesize: 5,
                parallelUploads: 3,
                maxFiles: 1,
                uploadMultiple: true,
                autoProcessQueue: false,
                acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf,.doc,.docx",
                addRemoveLinks: true,
                dictRemoveFile: "Remove file",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        "meta[name=csrf-token]"
                    ).content,
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
            clitem: {},
            caseObj: {},
            checklistObj: {},
            modal: 0,
            modalTitle: "",
            actionType: 0,
            submitted: false,
            errors: {},
            sendSuccess: false,

            loading: false,
            file: "",
            clFiles: [],
            survey: {},
        };
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
    mounted() {
        this.userFiles();
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
            console.log(Object.keys(this.errors));
            if (Object.keys(this.errors).length) {
                console.log(this.errors);
                return;
            }
            this.$refs.myVueDropzone.processQueue();
            /*  let me = this;
            axios
                .post("/cl-item/upload/file", {
                    id: me.id,
                })
                .then(function (response) {
                    console.table(response);
                })
                .catch(function (error) {
                    console.table(error);
                }); */
        },

        sendMessage: async function (files, xhr, formData) {
            formData.append("id", this.id);
        },

        sendToImmcase(file, clitemsno) {
            let me = this;
            this.loading = true;
            axios
                .post("/cl-item/send_file", {
                    clitemsno: clitemsno,
                    file: file,
                })
                .then(function (response) {
                    console.table(response);
                    console.log(response);
                    if (response.data === "success") {
                        Swal.fire({
                            type: "success",
                            title: "Document sent. ",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    me.userFiles();
                })
                .catch(function (error) {
                     console.table(error);
                    console.log(error);
                    Swal.fire({
                        type: "error",
                        title: "Document not sent",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                })
                .finally(() => (this.loading = false));
        },

        deleteFile(file) {
            let me = this;
            this.loading = true;
            axios
                .post("/cl-item/dropfile", { file: file })
                .then(function (response) {
                    //console.log(response);
                    Swal.fire({
                        type: "success",
                        title: "Document deleted",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    me.userFiles();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
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

        userFiles() {
            let me = this;
            this.loading = true;
            axios
                .post("/cl-item", { id: urlParams[4] })
                .then(function (response) {
                    // console.table(response);
                    me.clitem = response.data[0];
                    me.caseObj = response.data[1];
                    me.checklistObj = response.data[2];
                    me.survey = response.data[3];
                    // console.log(me.survey);
                    if ("files" in me.clitem.files) {
                        me.clFiles = me.clitem.files.files;
                        //console.log(me.clFiles);
                    }
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
            this.submitted = false;
            this.errors = {};
            this.userFiles();
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
                    }
                }
            }
        },

        exportResponse(clitems_no) {
            let me = this;
            me.loading = true;
            axios
                .post("/questionaries/export_response", {
                    clitemsno: clitems_no,
                })
                .then(function (response) {
                    if (response.data === "success") {
                        Swal.fire({
                            type: "success",
                            title: " ✔ This survey has been answered and sent to manager. ✔",
                            timer: 5000,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            type: "error",
                            title: "❌ This survey has NOT answered. Please open the link and answer the survey. ❌",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }

                    me.userFiles();
                })
                .catch(function (error) {
                    Swal.fire({
                        type: "error",
                        title: "❌ This survey has NOT answered. Please open the link and answer the survey. ❌",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    console.log(error);
                    // console.log( error);
                })
                .finally(() => (this.loading = false));
        },
    },
};
</script>
