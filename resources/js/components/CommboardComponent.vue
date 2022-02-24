<template>
  <div class="card shadow p-1 rounded">
    <div class="card-body">
      <h2 class="card-title">
        <span class="lstick d-inline-block align-middle"></span>Commboard
      </h2>
      <!--  <h4 class="card-title mb-3">Commboard</h4> -->
      <div class="row">
        <div class="col-sm-4 mb-2 mb-sm-0 user-chat-box border-right pt-2">
          <!-- list 1 -->
          <div
            class="
              nav
              flex-column
              nav-pills
              people-list
              shadow
              p-1
              rounded rounded
              pt-2
            "
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical"
          >
            <!-- id="v-pills-home-tab" -->
            <a
              :v-if="groupArr2.lenght > 0"
              v-for="comm in groupArr2"
              :key="comm.id"
              :id="'tab_' + coms.cf_2218 + '-tab'"
              class="nav-link pt-1 pb-1 mr-0"
              data-toggle="pill"
              :href="'#tab_' + comm.cf_2218"
              role="tab"
              :aria-controls="'tab_' + comm.cf_2218"
              aria-selected="false"
              v-on:click="changeAction(), setComm(comm)"
              ><!-- :id="'thread' + comm.cf_2218" -->
              <span class="user-img position-relative d-inline-block">
                <span
                  class="
                    round
                    text-white
                    d-inline-block
                    text-center
                    rounded-circle
                    bg-warning
                  "
                  v-text="comm.name.substring(0, 1)"
                >
                </span>
                <!--  -->
                <span
                  class="profile-status online rounded-circle pull-right"
                ></span>
              </span>
              <div
                class="mail-contnet w-75 d-inline-block v-middle float-right"
              >
                <h5 class="message-title mb-0 mt-1" v-text="comm.name"></h5>
                <span
                  class="font-12 text-nowrap d-block text-muted text-truncate"
                  v-text="comm.cf_2226"
                ></span>
                <span
                  class="font-12 text-nowrap d-block text-muted"
                  v-text="comm.cf_2218"
                ></span>
              </div>
            </a>
          </div>
        </div>

        <div class="col-sm-8">
          <div class="chat-not-selected" v-if="action == 0">
            <div class="text-center">
              <span class="display-5 text-info"
                ><i class="mdi mdi-comment-outline"></i
              ></span>
              <h5>Open chat from the list</h5>
            </div>
          </div>
          <!-- comm body -->
          <div class="tab-content" id="v-pills-tabContent" v-if="action == 1">
            <!-- id="v-pills-home" -->
            <div
              class="tab-pane fade"
              :id="'tab_' + coms.cf_2218"
              role="tabpanel"
              :aria-labelledby="'tab_' + coms.cf_2218 + '-tab'"
            >
              <div class="chat-meta-user border-bottom">
                <div class="current-chat-user-name pb-3">
                  <span
                    class="
                      round
                      text-white
                      d-inline-block
                      text-center
                      rounded-circle
                      bg-warning
                    "
                    v-text="subname"
                  >
                  </span>
                  <span class="name" v-text="coms.name"></span>
                  <span
                    class="
                      d-inline-block
                      text-right text-muted
                      float-right
                      m-2
                      pb-2
                    "
                    v-text="coms.cf_2220"
                  ></span>
                </div>
              </div>
              <h4 class="card-title">Comm track</h4>
              <ul
                class="chat-list chat mb-5"
                :data-user-id="'thread' + coms.cf_2218"
              >
                <div v-for="comm in commboards" :key="comm.id">
                  <li
                    class="shadow p-1 rounded pb-1 mb-2"
                    rounded
                    v-if="
                      coms.cf_2218 === comm.cf_2218 && commboards.length > 0
                    "
                  >
                    <div
                      class="col-12 p-3 d-inline-block"
                      v-if="comm && comm.modifiedby === contact.modifiedby"
                    >
                      <span
                        class="
                          round
                          text-white
                          d-inline-block
                          text-center
                          rounded-circle
                          bg-warning
                        "
                        v-text="comm.cf_2220.substring(0, 1)"
                      >
                      </span>
                      <span
                        class="name font-weight-bold ml-2 float-right"
                        v-text="comm.name"
                      ></span>
                      <span
                        class="d-inline-block text-right text-muted float-right"
                        v-text="comm.cf_2220"
                      >
                      </span>
                      <br />
                      <div
                        class="
                          shadow
                          p-1
                          rounded
                          m-3
                          p-2
                          box
                          d-inline-block
                          text-dark
                          rounded
                        "
                        v-text="comm.description"
                      ></div>

                      <div class="d-inline-block float-right text-muted">
                        <p v-text="comm.cf_2226"></p>
                        <p v-text="comm.cf_2228"></p>
                      </div>
                    </div>

                    <div class="col-12 pl-3 d-inline-block text-right" v-else>
                      <div
                        class="
                          box
                          mb-2
                          d-inline-block
                          text-dark
                          rounded
                          p-2
                          bg-light-inverse
                        "
                        v-text="comm.description"
                      ></div>
                      <div class="d-inline-block text-right text-muted">
                        <p v-text="comm.cf_2226"></p>
                        <p v-text="comm.cf_2228"></p>
                      </div>
                    </div>
                  </li>
                </div>
                <!--chat Row -->
              </ul>
              <!--  -->
              <div
                class="
                  card-body
                  border-top border-bottom
                  chat-send-message-footer
                "
              >
                <form
                  method=""
                  enctype="multipart/form-data"
                  autocomplete="nope"
                >
                  <div class="col-12 shadow p-1 rounded p-2">
                    <div class="row">
                      <input
                        v-model="threadid"
                        type="hidden"
                        disabled
                        id="threadid"
                      />
                      <input
                        v-model="threadtype"
                        type="hidden"
                        disabled
                        name="threadtype"
                      />
                      <div class="form-group col-10">
                        <input
                          v-model="subject"
                          type="text"
                          id="subject"
                          placeholder="Subject"
                          class="form-control pr-0"
                          required
                          data-toggle="tooltip"
                          title="Send"
                        />
                      </div>
                      <div class="form-group col-2 text-center pl-0">
                        <a
                          href="#"
                          class="btn btn-info btn-circle btn-md"
                          v-on:click="sendMessage()"
                        >
                          <i class="far fa-paper-plane"></i>
                        </a>
                      </div>
                      <div class="form-group col-12">
                        <textarea
                          placeholder="Body"
                          class="form-control border-0"
                          id="comment"
                          v-model="comment"
                          style="margin-top: 0px; margin-bottom: 0px"
                          rows="2"
                          required
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      themme_layout: false,
      commboards: [],
      groupArr: [],
      groupArr2: [],
      fullname: "",
      contact: {},
      coms: {},
      subname: "",
      action: 0,
      submitted: false,
      errors: {},
      threadid: "",
      threadtype: "",
      subject: "",
      comment: "",
    };
  },
  mounted() {
    this.getCommboard();
  },
  methods: {
    setComm(val) {
      if (val != undefined) {
        this.coms = val;
        console.log("this.coms");
        console.log(val);
        this.threadid = this.coms["cf_2218"];
        this.threadtype = this.coms["cf_2220"];
        this.subname = this.coms["name"].substring(0, 1);
      }
    },
    changeAction() {
      this.action = 1;
    },
    getCommboard() {
      let me = this;
      axios
        .get("/comments")
        .then(function (response) {
          let commResp = response.data[0];
          let contact = response.data[1];
          me.setComm(commResp[0]);

          if (commResp != null) {
            me.commboards = commResp;
            me.contact = contact;
            for (const [i, v] of commResp.entries()) {
              if (!me.groupArr.includes(v.cf_2218)) {
                me.groupArr.push(v.cf_2218);
                me.groupArr2.push(v);
              }
            }
            (me.fullname = contact.firstname), " ", contact.lastname;

            me.subject = "";
            me.comment = "";
          }
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    sendMessage() {
      this.submitted = true;
      this.errors = {};
      let me = this;
      axios
        .post("/comments", {
          threadid: me.threadid,
          threadtype: me.threadid,
          subject: me.subject,
          comment: me.comment,
        })
        .then(function (res) {
          Swal.fire({
            type: "success",
            title: "Comment sent",
            timer: 2000,
            showConfirmButton: false,
          });
          me.getCommboard();
          window.location.reload();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
