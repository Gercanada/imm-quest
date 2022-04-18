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
                parallelUploads: 3,
                maxFiles: 1,
                uploadMultiple: true,
                autoProcessQueue: false,
                acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf,.doc,.docx",
                addRemoveLinks: true,
                dictRemoveFile: "Remove file",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
                },

                init: function() {
                    this.on("addedfile", function(file) {
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
            SendStatus: 'fas fa-paper-plane',
            DeletingStatus: 'fas fa-trash-alt'
        };
    },
    mounted() {
        this.show();
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
    methods: {
        afterUploadComplete: async function() {
            let me = this;
            Swal.fire({
                type: "success",
                title: "Upload successfull!",
                timer: 2000,
                showConfirmButton: false,
            });
            me.closeModal();
        },
        shootMessage: async function() {
            this.submitted = true;
            this.errors = {};
            // console.log(Object.keys(this.errors));
            if (Object.keys(this.errors).length) {
                console.table(this.errors);
                return;
            }
            this.$refs.myVueDropzone.processQueue();
        },
        sendMessage: async function(files, xhr, formData, id) {
            formData.append("id", this.clitemID);
        },
        sendToImmcase(file, clitemsno) {
            let me = this;
            me.sending = true;
            me.SendStatus = 'fas fa-spinner fa-spin'
            axios
                .post("/cl-item/send_file", {
                    clitemsno: clitemsno,
                    file: file,
                })
                .then(function(response) {
                    if (response.data === "success" || response.status === 200) {
                        Swal.fire({
                            type: "success",
                            title: "Document sent. ",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }
                    me.show();
                })
                .catch(function(error) {
                    console.table(error);
                    Swal.fire({
                        type: "error",
                        title: "Document not sent",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                })
                .finally(() => {
                    me.sending = false, me.SendStatus = 'fas fa-paper-plane'
                });
        },
        deleteFile(file) {
            let me = this;
            me.deleting = true;
            me.DeletingStatus = 'fas fa-spinner fa-spin '
            axios
                .post("/cl-item/dropfile", { file: file })
                .then(function(response) {
                    console.log(response);
                    Swal.fire({
                        type: "success",
                        title: "Document deleted",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    me.show();
                })
                .catch(function(error) {
                    console.log(error);
                })
                .finally(() => (me.deleting = false, me.DeletingStatus = 'fas fa-trash-alt'));
        },
        removedfile: function(file, respuesta) {
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
            this.$refs.myVueDropzone.removeAllFiles();
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
                case "documents":
                    {
                        switch (action) {
                            case "store":
                                {
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
        show() {
            let me = this;
            this.loading = true;
            let checklistID = 0;
            me.f_checklist_id === undefined ?
                checklistID = me.checklist_id :
                checklistID = me.f_checklist_id;

            axios
                .get("/checklist/" + checklistID + "/items")
                .then(function(response) {
                    me.checklist = response.data[0];
                    me.clitems = response.data[1];
                })
                .catch(function(error) {
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
                .then(function(response) {
                    console.log(response)
                    if (response.data === "success" || response.status === 200) {
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
                    me.show();
                })
                .catch(function(error) {
                    Swal.fire({
                        type: "error",
                        title: "❌ This survey has NOT answered. Please open the link and answer the survey. ❌",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
    },
};