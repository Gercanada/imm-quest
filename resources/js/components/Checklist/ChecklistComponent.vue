<template>
  <div class="card-body">
    <div class="table-responsive mt-0">
      <table class="table">
        <tbody>
          <tr>
            <th>Checklist No</th>
            <td>{{ checklist.checklistno }}</td>
          </tr>
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
              <th scope="col">Status</th>
              <th scope="col">Category</th>
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
              <td>{{ clitem_a.cf_1578 }}</td>
              <td>{{ clitem_a.cf_1200 }}</td>
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
                          type="button"
                          class="btn btn-outline-success btn-rounded"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Send document"
                          :disabled="sending"
                          @click="sendToImmcase(file, clitem_a.clitemsno)"
                        >
                          <i :class="SendStatus"></i>
                          Send
                        </button>
                        <button
                          type="button"
                          class="btn btn-outline-danger btn-rounded"
                          @click="deleteFile(file)"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="Remove document"
                          :disabled="deleting"
                        >
                          <i :class="DeletingStatus"></i>
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
                    <label for="attachment" class="leading-7 text-sm text-gray-600"
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

<script src="./Checklist.js"></script>
