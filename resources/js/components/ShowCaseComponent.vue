<template>
  <div v-if="loading">
    <div v-if="loading" style="heigth: 100%">
      <div class="card">
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
      <div class="col-md-12">
        <div class="card shadow p-1 rounded">
          <div class="card-header">
            <a href="/cases" class="btn btn-outline-success btn-rounded"
              ><i class="fas fa-arrow-circle-left"></i
            ></a>
            <h4 class="card-title text-themecolor mb-0">
              <span class="lstick d-inline-block align-middle"></span>
              <span v-text="tkcase.ticket_title"></span>
            </h4>
          </div>
          <!-- Case info read only data v-if ? -->
          <div class="card-body">
            <table class="table v-middle fs-3 mb-0 mt-4">
              <tbody>
                <tr>
                  <td>Case No</td>
                  <td
                    class="text-end font-weight-medium"
                    v-text="tkcase.ticket_no"
                  ></td>
                </tr>
                <tr>
                  <td>Case title</td>
                  <td
                    class="text-end font-weight-medium"
                    tkcase.ticket_title
                  ></td>
                </tr>
                <tr>
                  <td>Case type</td>
                  <td
                    class="text-end font-weight-medium"
                    v-text="tkcase.ticketcategories"
                  ></td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td
                    class="text-end font-weight-medium"
                    v-text="tkcase.description"
                  ></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td
                    class="text-end font-weight-medium"
                    v-text="tkcase.ticketstatus"
                  ></td>
                </tr>
                <tr>
                  <td>No of Applicants</td>
                  <td
                    class="text-end font-weight-medium"
                    v-text="tkcase.cf_888"
                  ></td>
                </tr>
                <tr></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card shadow p-1 rounded">
          <div class="card-body">
            <ul class="nav nav-tabs nav-bordered mb-3 customtab">
              <li
                class="nav-item"
                v-for="checklist in ArrayChecklist"
                :key="checklist.name"
                :value="checklist.name"
              >
                <a
                  v-if="checklist"
                  class="nav-link"
                  @click.prevent="setActive(checklist.name)"
                  :class="{ active: isActive(checklist.name) }"
                  :href="'#tab_' + checklist.id"
                  data-toggle="tab"
                  :aria-expanded="true"
                >
                  <i class="mdi mdi-clipboard-check d-lg-none d-block mr-1"></i>
                  <span
                    class="d-none d-lg-block"
                    v-text="checklist.name"
                  ></span>
                </a>
              </li>
            </ul>

            <div
              class="tab-content"
              v-for="checklist in ArrayChecklist"
              :key="checklist.id"
              :value="checklist.id"
            >
              <div
                class="tab-pane"
                :class="{ 'show active': isActive(checklist.name) }"
                :id="'tab_' + checklist.id"
              >
                <div class="shadow p-1 mt-4 rounded">
                  <h3 class="card-title">
                    <i class="mr-1 font-18 mdi mdi-timelapse"></i> Pending items
                  </h3>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">CL Item name</th>
                          <th scope="col">Status</th>
                          <th scope="col">Help link</th>
                          <th scope="col">View</th>
                        </tr>
                      </thead>
                      <!--  <div :v-if="CLItemsArray.length == 0">

                      </div> -->

                      <tbody>
                        <tr
                          v-for="clitem in CLItemsArray"
                          :key="clitem.id"
                          :value="clitem.id"
                        >
                          <template
                            v-if="
                              clitem.cf_1216 === checklist.id &&
                              clitem.cf_1200 === 'Document' &&
                              (clitem.cf_1578 === 'Pending' ||
                                clitem.cf_1578 === 'Replacement Needed')
                            "
                          >
                            <td v-text="clitem.name"></td>
                            <td v-text="clitem.cf_1578"></td>
                            <td>
                              <a
                                :href="clitem.cf_1212"
                                v-text="clitem.cf_1212"
                              ></a>
                            </td>
                            <td>
                              <a
                                :href="
                                  '/checklist/' +
                                  checklist.id +
                                  '/item/' +
                                  clitem.id
                                "
                                class="btn btn-outline-success btn-rounded"
                              >
                                <i class="fas fa-eye"></i
                              ></a>
                            </td>
                            <td v-text="clitem.cf_1212"></td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="shadow p-1 mt-4 rounded">
                  <h3 class="card-title">
                    <i class="mr-1 font-18 mdi mdi-textbox"></i> Electronic
                    forms
                  </h3>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">CL Item name</th>
                          <th scope="col">Help link</th>
                          <th scope="col">Status</th>
                          <th scope="col">View</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="clitem in CLItemsArray"
                          :key="clitem.id"
                          :value="clitem.id"
                        >
                          <template
                            v-if="
                              clitem &&
                              clitem.cf_1216 == checklist.id &&
                              clitem.cf_1200 === 'IMM Form'
                            "
                          >
                            <td>
                              <a
                                :href="
                                  '/checklist/' +
                                  clitem.cf_1216 +
                                  '/item/' +
                                  clitem.id
                                "
                                v-text="clitem.name"
                              >
                              </a>
                            </td>
                            <td v-text="clitem.cf_1202"></td>
                            <td v-text="clitem.cf_1578"></td>

                            <td>
                              <a
                                :href="
                                  '/checklist/' +
                                  checklist.id +
                                  '/item/' +
                                  clitem.id
                                "
                                class="btn btn-outline-success btn-rounded"
                              >
                                <i class="fas fa-eye"></i
                              ></a>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="shadow p-1 mt-4 rounded">
                  <h3 class="card-title">
                    <i class="mr-1 font-18 mdi mdi-textbox"></i> Questionnaire
                  </h3>
                  <div class="table-responsive">
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
                          v-for="clitem in CLItemsArray"
                          :key="clitem.id"
                          :value="clitem.id"
                        >
                          <template
                            v-if="
                              clitem &&
                              clitem.cf_1216 == checklist.id &&
                              clitem.cf_1200 === 'Questionnaire' &&
                              (clitem.cf_1578 === 'Pending' ||
                                clitem.cf_1578 === 'Replacement Needed')
                            "
                          >
                            <td v-text="clitem.name"></td>
                            <td>
                              <a
                                :href="clitem.cf_1212"
                                target="_blank"
                                v-text="clitem.cf_1212"
                              ></a>
                            </td>
                            <td v-text="clitem.cf_1578"></td>

                            <td>
                              <form @submit.prevent>
                                <input
                                  type="hidden"
                                  name="surveyurl"
                                  id="surveyurl"
                                  :value="clitem.cf_1212"
                                />
                                <input
                                  type="hidden"
                                  name="clitemsno"
                                  id="clitemsno"
                                  :value="clitem.clitemsno"
                                />
                                <button
                                  @click="refreshStatus()"
                                  class="btn btn-outline-success btn-rounded"
                                >
                                  <i class="icon-refresh"></i>
                                </button>
                              </form>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                    <div
                      v-if="session_status === 'success'"
                      class="
                        alert alert-success
                        text-info text-center
                        font-weight-bold
                      "
                      id="surveyAlert"
                    >
                      ✔ This survey has been answered ✔
                    </div>
                    <div
                      v-else-if="session_status === 'error'"
                      class="
                        alert alert-danger
                        text-warning text-center
                        font-weight-bold
                      "
                      id="surveyAlert"
                    >
                      ❌ This survey has NOT answered. Please open the link and
                      answer the survey. ❌
                    </div>
                  </div>
                </div>

                <div class="shadow p-1 mt-4 rounded">
                  <!-- </div> -->
                  <h3 class="card-title">
                    <i class="mr-1 font-18 mdi mdi-telegram"></i>Submited items
                  </h3>
                  <div class="table-responsive">
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
                          v-for="clitem in CLItemsArray"
                          :key="clitem.id"
                          :value="clitem.id"
                          :v-if="
                            clitem &&
                            clitem.cf_1216 == checklist.id &&
                            clitem.cf_1578 === ('Received' || 'Accepted')
                          "
                        >
                          <template
                            v-if="
                              clitem &&
                              clitem.cf_1216 == checklist.id &&
                              clitem.cf_1578 === ('Received' || 'Accepted')
                            "
                          >
                            <td v-text="clitem.name"></td>
                            <td v-text="clitem.cf_1970"></td>

                            <td v-text="clitem.cf_1200"></td>
                            <td v-text="clitem.cf_1578"></td>

                            <td>
                              <a
                                :href="
                                  '/checklist/' +
                                  checklist.id +
                                  '/item/' +
                                  clitem.id
                                "
                                class="btn btn-outline-success btn-rounded"
                              >
                                <i class="fas fa-eye"></i
                              ></a>
                            </td>
                          </template>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end card-->
</template>

<script>
const urlParams = window.location.pathname.split("/");

export default {
  data() {
    return {
      tkcase: "",
      clitem: "",
      ArrayChecklist: [],
      CLItemsArray: [],
      id: urlParams[2],
      activeItem: "",
      loading: false,

      surveyurl: "",
      clitemsno: "",
      session_status: "",
    };
  },

  mounted() {
    this.showCase();
  },
  methods: {
    showCase() {
      let me = this;
      this.loading = true; //the loading begin
      axios
        .get("/details_case/" + me.id)
        .then(function (response) {
          console.log(response);
          me.tkcase = response.data[0];
          me.ArrayChecklist = response.data[1];
          me.CLItemsArray = response.data[2];
          me.activeItem = me.ArrayChecklist[0].name;
        })
        .finally(() => (this.loading = false))
        .catch(function (error) {
          console.table(error);
        });
    },

    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    },

    refreshStatus() {
      let me = this;
      axios
        .post("/questionaries/export_response", {
          surveyurl: surveyurl.value,
          clitemsno: clitemsno.value,
          form: "vue",
        })
        .then(function (response) {
          console.log(response);
          me.session_status = response.data;
          $("#surveyAlert").delay(10000).hide(0);
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>

