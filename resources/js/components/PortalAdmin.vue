<template>
    <div v-if="loading">
        <div v-if="loading" style="heigth: 100%">
            <div class="card shadow p-1 rounded">
                <div class="card-body">
                    <div class="card-body d-flex justify-content-around">
                        <div
                            class="spinner-grow text-success center"
                            role="status"
                        >
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">
                    <i class="fas fa-cog"></i> Settings
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow p-1 rounded">
                    <div class="card-header">
                        Seleccione los elementos que se han de clonar de Vtiger
                        al portal de clientes y la fila que se relaciona con el
                        usuario
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table dt_alt_pagination table-striped table-bordered display"
                                style="width: 100%"
                            >
                                <thead>
                                    <tr>
                                        <th>Types</th>
                                        <th>User field for type</th>
                                        <th>Change user field</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="type in types">
                                        <td>
                                            <div class="col-md-3">
                                                <!--  <input
                                                    type="checkbox"
                                                    :id="type"
                                                    class="material-inputs filled-in chk-col-light-green"
                                                    
                                                /> -->
                                                <label :for="type">
                                                    {{ type }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>current</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-outline-warning btn-rounded float-right"
                                                @click="
                                                    openModal(
                                                        'type',
                                                        'relate',
                                                        type
                                                    )
                                                "
                                            >
                                                <i class="fas fa-cogs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                <div class="card">
                                    <div class="card-body">
                                        <input
                                            class="form-control"
                                            placeholder="search ..."
                                            v-model="search"
                                        />

                                        <div class="table-responsive mt-4">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Label</th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="field in filteredFields"
                                                    >
                                                        <td>
                                                            <div
                                                                class="col-md-3"
                                                            >
                                                                <input
                                                                    type="radio"
                                                                    class="with-gap material-inputs"
                                                                    name="any"
                                                                    :id="
                                                                        field.name
                                                                    "
                                                                    :value="[
                                                                        type,
                                                                        field.name,
                                                                    ]"
                                                                    :checked="
                                                                        field.selected ===
                                                                        true
                                                                            ? true
                                                                            : false
                                                                    "
                                                                    @change="
                                                                        updateBox
                                                                    "
                                                                />
                                                                <label
                                                                    :for="
                                                                        field.name
                                                                    "
                                                                    v-text="
                                                                        field.label
                                                                    "
                                                                ></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ field.name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
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
<script>
export default {
    data() {
        return {
            types: [],
            fields: [],
            selected: [],
            type: "",
            modal: 0,
            modalTitle: "",
            actionType: 0,
            submitted: false,
            loading: false,
            search: null,
        };
    },
    mounted() {
        this.vtTypes();
    },

    methods: {
        vtTypes() {
            let me = this;
            me.loading = true;
            axios
                .get("/admin/types")
                .then(function (response) {
                    me.types = response.data;
                })
                .catch(function (error) {
                    console.table(error);
                })
                .finally(() => {
                    return (this.loading = false);
                });
        },

        updateBox(e) {
            let me = this;
            let opt = e.target.value;
            console.log(opt);
            const newArr = opt.split(",");
            // console.table(newArr);

            Swal.fire({
                type: "warning",
                title:
                    "Now user field in " +
                    newArr[0] +
                    " be: " +
                    newArr[1] +
                    " ",
                text: "Are you sure to save relation ?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
            }).then(function (result) {
                if (result.value === true) {
                    me.save(newArr[0], newArr[1]);
                }
            });
        },

        closeModal() {
            this.modal = 0;
            this.submitted = false;
        },

        async describe(type) {
            let me = this;
            await axios
                .post("/admin/types/describe", { type: type })
                .then(function (response) {
                    me.type = response.data.type;
                    me.fields = response.data.fields;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        openModal(model, action, data = []) {
            this.describe(data);
            switch (model) {
                case "type": {
                    switch (action) {
                        case "relate": {
                            this.modal = 1;
                            this.modalTitle = "User relation";
                            this.actionType = 1;
                            break;
                        }
                    }
                }
            }
        },

        save(type, field) {
            axios
                .post("admin/types/save", { type: type, field: field })
                .then(function (response) {
                    console.log(response);
                    Swal.fire({
                        type: "success",
                        title:
                            " ✔ Now user field in " +
                            type +
                            " is" +
                            field +
                            " ✔",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    console.log(type);
                })
                .catch(function (error) {
                    Swal.fire({
                        type: "error",
                        title: "Can't save relation",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    console.table(error);
                });
        },
    },

    computed: {
        filteredFields() {
            let result;
            if (this.search) {
                result = this.fields.filter((field) =>
                    field.name.includes(this.search)
                )
                    ? this.fields.filter((field) =>
                          field.name.includes(this.search)
                      )
                    : this.fields.filter((field) =>
                          field.label.includes(this.search)
                      );
            } else {
                result = this.fields;
            }
            return result;
        },
    },
};
</script>
