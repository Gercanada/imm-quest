<template>
  <div class="card">
    <div v-if="loading">
      <div v-if="loading" style="heigth: 100%">
        <div class="card">
          <div class="card-body d-flex justify-content-around">
            <div class="spinner-grow text-success center" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-else>
      <div class="card-body">
        <h4 class="card-title" v-text="'Case' + tkcase.ticket_title"></h4>
        <h6 class="card-subtitle">Some info abouth this case as read only</h6>

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
              <span class="d-none d-lg-block" v-text="checklist.name"></span>
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
            <h6 class="card-title mt-5">
              <i
                class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"
              ></i>
              Pending items
            </h6>

            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">CL Item name</th>
                        <th scope="col">Required by</th>
                        <th scope="col">Upload</th>
                        <th scope="col">Help link</th>
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
                            clitem.cf_1216 === checklist.id &&
                            clitem.cf_1578 === 'Pending'
                          "
                        >
                          <td v-text="clitem.name"></td>
                          <td v-text="clitem.cf_1202"></td>
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
                              <i class="fas fa-upload"></i
                            ></a>
                          </td>
                          <td v-text="clitem.cf_1212"></td>
                        </template>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <h6 class="card-title">
                  <i
                    class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"
                  ></i>
                  Electronic forms
                </h6>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">CL Item name</th>
                      <th scope="col">Required by</th>
                      <th scope="col">Help link</th>
                      <th scope="col">Status</th>
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
                        <td v-text="clitem.cf_1212"></td>
                        <td v-text="clitem.cf_1578"></td>
                      </template>
                    </tr>
                  </tbody>
                </table>
              </div>
              <h6 class="card-title">
                <i
                  class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"
                ></i
                >Submited items
              </h6>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">CL Item name</th>
                      <th scope="col">Status</th>
                      <th scope="col">File name</th>
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
                        <td v-text="clitem.cf_1578"></td>
                        <td v-text="clitem.cf_1970"></td>
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
          me.ArrayChecklist = response.data[1];
          me.CLItemsArray = response.data[2];
          me.activeItem = me.ArrayChecklist[0].name;
        })
        .catch(function (error) {
          console.table(error);
        })
        .finally(() => (this.loading = false));
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

