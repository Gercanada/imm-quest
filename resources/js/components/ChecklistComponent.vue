<template>
    <div class="card-body">
        <div class="shadow p-1 mt-4 rounded">
            <h3 class="card-title">
                <i class="mr-1 font-18 mdi mdi-timelapse"></i> Pending items
            </h3>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Help link</th>
                            <th scope="col">View</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="clitem_a in clitems"
                            v-if="
                                clitem_a.cf_1578 === 'Pending' ||
                                (clitem_a.cf_1578 === 'Replacement Needed' &&
                                    clitem_a.cf_1200 === 'Document')
                            "
                        >
                            <td>{{ clitem_a.name }}</td>
                            <td>{{ clitem_a.cf_1578 }}</td>
                            <td>
                                <a :href="clitem_a.cf_1212">{{
                                    clitem_a.cf_1212
                                }}</a>
                            </td>
                            <td>
                                <a
                                    :href="
                                        '/checklist/' +
                                        checklist.id +
                                        '/item/' +
                                        clitem_a.id
                                    "
                                    data-toggle="tooltip"
                                    title="View details"
                                    class="btn btn-outline-success btn-rounded"
                                >
                                    <i class="fas fa-eye"></i
                                ></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="shadow p-1 mt-4 rounded">
            <h3 class="card-title">
                <i class="mr-1 font-18 mdi mdi-textbox"></i> Electronic forms
            </h3>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Help link</th>
                            <th scope="col">Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="clitem_b in clitems"
                            v-if="clitem_b.cf_1200 === 'IMM Form'"
                        >
                            <td>{{ clitem_b.cf_1202 }}</td>
                            <td>{{ clitem_b.cf_1578 }}</td>
                            <td>
                                <a
                                    :href="
                                        '/checklist/' +
                                        checklist.id +
                                        '/item/' +
                                        clitem_b.id
                                    "
                                    >{{ clitem_b.name }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="shadow p-1 mt-4 rounded">
            <h3 class="card-title">
                <i class="mr-1 font-18 mdi mdi-help-circle-outline"></i
                >Questionnaire
            </h3>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Help link</th>
                            <th scope="col">Status</th>
                            <th>Refresh status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="clitem_c in clitems"
                            v-if="
                                (clitem_c.cf_1578 === 'Pending' ||
                                    clitem_c.cf_1578 === 'Replacement Needed' ||
                                    clitem_c.cf_1578 === '') &&
                                clitem_c.cf_1200 === 'Questionnaire'
                            "
                        >
                            <td>{{ clitem_c.name }}</td>
                            <td>
                                <a :href="clitem_c.cf_1212" target="_blank">
                                    {{ clitem_c.cf_1212 }}</a
                                >
                            </td>
                            <td>{{ clitem_c.cf_1578 }}</td>
                            <td>
                                <button
                                    v-if="loading == false"
                                    type="submit"
                                    class="btn btn-outline-success btn-rounded"
                                    @click="
                                        exportResponse(
                                            clitem_c.cf_1212,
                                            clitem_c.clitemsno
                                        )
                                    "
                                >
                                    <i class="icon-refresh"></i>
                                </button>
                                <button
                                    v-else
                                    type="submit"
                                    disabled
                                    class="btn btn-outline-success btn-rounded"
                                >
                                    <i class="icon-refresh fas fa-spin"></i>
                                </button>
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
                                    :href="
                                        '/checklist/' +
                                        checklist.id +
                                        '/item/' +
                                        clitem_e.id
                                    "
                                    data-toggle="tooltip"
                                    title="View details"
                                    class="btn btn-outline-success btn-rounded"
                                >
                                    <i class="fas fa-eye"></i
                                ></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
const urlParams = window.location.pathname.split("/");
export default {
    name: "checklistComponent",
    props: {
        name: String,
        f_checklist_id: String,
    },
    data() {
        return {
            clitems: [],
            checklist: "",
            loading: false,

            checklist_id: urlParams[2],
            session: "",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
                    .content,
            },
        };
    },
    mounted() {
        this.show();
    },

    methods: {
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
        exportResponse(survey_url, clitems_no) {
            let me = this;
            me.loading = true;
            axios
                .post("/questionaries/export_response", {
                    clitemsno: clitems_no,
                })
                .then(function (response) {
                    console.log(response);
                    console.log(response.data);
                    if (response.data === "success") {
                        Swal.fire({
                            type: "success",
                            title: " ✔ This survey has been answered and sent to manager. ✔ Await a few minutes to get this record updated",
                            timer: 2000,
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
                .catch(function (error) {
                    console.table(error);
                })
                .finally(() => (this.loading = false));
        },
    },
};
</script>
