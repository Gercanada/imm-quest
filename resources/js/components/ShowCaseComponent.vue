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
                  <td class="text-end font-weight-medium" v-text="tkcase.ticket_no"></td>
                </tr>
                <tr>
                  <td>Case title</td>
                  <td class="text-end font-weight-medium" tkcase.ticket_title></td>
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
                  <td class="text-end font-weight-medium" v-text="tkcase.cf_888"></td>
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
                :v-if="ArrayChecklist > 0"
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
                  @click="changeTab(checklist.id)"
                >
                  <i class="mdi mdi-clipboard-check d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block" v-text="checklist.name"></span>
                </a>
              </li>
            </ul>

            <div
              class="tab-content"
              :v-if="ArrayChecklist > 0"
              v-for="checklist in ArrayChecklist"
              :key="checklist.id"
              :value="checklist.id"
            >
              <div
                class="tab-pane"
                :class="{ 'show active': isActive(checklist.name) }"
                :id="'tab_' + checklist.id"
              >
                <input type="hidden" :value="checklist.id" name="checklist_id" />
                <!-- <checklistComponent /> -->
                <checklistComponent :f_checklist_id="checklist.id" />
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
import checklistComponent from "./Checklist/ChecklistComponent.vue";
const urlParams = window.location.pathname.split("/");

export default {
  name: "showCase",
  components: {
    checklistComponent,
  },
  data() {
    return {
      name: "Bruce",
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
      f_checklist_id: 0,
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
          me.tkcase = response.data[0];
          if (response.data[1].length > 0) {
            me.ArrayChecklist = response.data[1];
            me.activeItem = me.ArrayChecklist[0].name;
            if (me.ArrayChecklist.length > 0) {
              me.f_checklist_id = me.ArrayChecklist[0].id;
            }
          }
          if (response.data[2]) {
            me.CLItemsArray = response.data[2];
          }
        })
        .finally(() => (this.loading = false))
        .catch(function (error) {
          console.table(error);
        });
    },

    changeTab(checklist) {
      this.f_checklist_id = checklist;
    },

    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    },
  },
};
</script>
