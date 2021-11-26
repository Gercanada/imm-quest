<template>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title" v-text="'Case' + tkcase.ticket_title"></h4>
      <h6 class="card-subtitle">Some info abouth this case as read only</h6>

      <ul
        class="nav nav-tabs nav-bordered mb-3 customtab"
        v-for="checklist in ArrayChecklist"
        :key="checklist.name"
        :value="checklist.name"
      >
        <li class="nav-item" v-if="checklist">
          <a
            v-if="ArrayChecklist.length >= 0"
            :href="'#tab_' + checklist.id"
            data-toggle="tab"
            aria-expanded="true"
            class="nav-link"
          >
            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
            <span class="d-none d-lg-block" v-text="checklist.name"></span>
          </a>
          <a
            v-else
            :href="'#tab_' + checklist.id"
            data-toggle="tab"
            aria-expanded="false"
            class="nav-link"
          >
            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
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
          v-if="ArrayChecklist.length == 0 && checklist != null"
          class="tab-pane show active"
          :id="'tab_' + checklist.id"
        >
          <!-- <div v-else class="tab-pane"></div> -->

          <h6 class="card-title mt-5">
            <i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>
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
                    <!-- <tr
                      v-for="clitem in CLItemsArray"
                      :key="clitem"
                      :value="clitem"
                      :v-if="clitem.cf_1216 == $checklist.id"
                    >
                      <td v-text="clitem.name"></td>
                      <td v-text="clitem.cf_1202"></td>
                      <td v-text="clitem.cf_acf_ulf_1778">
                        <a
                          href="#"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#myModal"
                          ><i class="fas fa-file"></i
                        ></a>
                      </td>
                      <td v-text="clitem.cf_1212"></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>

              <!-- sample modal content -->
              <div
                id="myModal"
                class="modal fade"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">
                        Modal Heading
                      </h4>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-hidden="true"
                      >
                        ×
                      </button>
                    </div>
                    <div class="modal-body">
                      <h6>Text in a modal</h6>
                      <p>
                        Duis mollis, est non commodo luctus, nisi erat porttitor
                        ligula.
                      </p>
                      <hr />
                      <h6>Overflowing text to show scroll behavior</h6>
                      <p>
                        Cras mattis consectetur purus sit amet fermentum. Cras
                        justo odio, dapibus ac facilisis in, egestas eget quam.
                        Morbi leo risus, porta ac consectetur ac, vestibulum at
                        eros.
                      </p>
                      <p>
                        Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Vivamus sagittis lacus vel augue laoreet
                        rutrum faucibus dolor auctor.
                      </p>
                      <p>
                        Aenean lacinia bibendum nulla sed consectetur. Praesent
                        commodo cursus magna, vel scelerisque nisl consectetur
                        et. Donec sed odio dui. Donec ullamcorper nulla non
                        metus auctor fringilla.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-light"
                        data-dismiss="modal"
                      >
                        Close
                      </button>
                      <button type="button" class="btn btn-primary">
                        Save changes
                      </button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
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
                  <!-- <tr
                    v-for="clitem in CLItemsArray"
                    :key="clitem.id"
                    :value="clitem.id"
                    :v-if="
                      clitem &&
                      clitem.cf_1216 == $checklist.id &&
                      clitem.cf_1578 != 'Accepted'
                    "
                  >
                    <td clitem.name></td>
                    <td clitem.cf_1202></td>
                    <td clitem.cf_1212></td>
                    <td clitem.cf_1578></td>
                  </tr> -->
                </tbody>
              </table>
            </div>
            <h6 class="card-title">
              <i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i
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
                  <!--  <tr
                    v-for="clitem in CLItemsArray"
                    :key="clitem.id"
                    :value="clitem.id"
                    :v-if="
                      clitem &&
                      clitem.cf_1216 == checklist.id &&
                      clitem.cf_1578 != 'Completed'
                    "
                  >
                    <td clitem.name></td>
                    <td clitem.cf_1578></td>
                    <td clitem.cf_1970></td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div v-else class="tab-pane"></div>
      </div>
    </div>
  </div>
  <!-- end card-->
</template>


<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
const urlParams = window.location.pathname.split("/");

export default {
  data() {
    return {
      tkcase: "",
      clitem: "",
      ArrayChecklist: [],
      CLItemsArray: [],
      id: urlParams[2],
    };
  },
  methods: {
    showCase() {
      let me = this;
      axios
        .get("/details_case/" + me.id)
        .then(function (response) {
          //console.log(response.data);
          me.tkcase = response.data[0];
          me.ArrayChecklist = response.data[1];
          me.CLItemsArray = response.data[2];
          console.log(response.data);
        })
        .catch(function (error) {
          console.table(error);
        });
    },
  },

  mounted() {
    this.showCase();
  },
};
</script>
