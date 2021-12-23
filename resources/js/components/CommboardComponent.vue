<template>
  <div class="card pt-5">
    <div class="card-body">
      <h4 class="card-title mb-3">Commboard</h4>
      <div class="row">
        <div class="col-sm-3 mb-2 mb-sm-0 user-chat-box border-right">
          <!-- list 1 -->
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-search"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Search..." />
          </div>

          <div
            class="nav flex-column nav-pills people-list shadow-lg m-1 rounded"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical"
            v-for="comm in groupArr2"
            :key="comm.id"
          >
            <a
              class="nav-link show"
              id="v-pills-home-tab"
              data-toggle="pill"
              href="#v-pills-home"
              role="tab"
              aria-controls="v-pills-home"
              aria-selected="false"
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
              <div class="mail-contnet w-75 d-inline-block v-middle pl-2 float-right">
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

        <div class="col-sm-9">
          <div class="chat-not-selected" v-if="action == 0">
            <div class="text-center">
              <span class="display-5 text-info"
                ><i class="mdi mdi-comment-outline"></i
              ></span>
              <h5>Open chat from the list</h5>
            </div>
          </div>
          <!-- comm body -->
          <div
            class="tab-content "
            id="v-pills-tabContent"
            v-if="action == 1"
          >
            <div
              class="tab-pane fade "
              id="v-pills-home"
              role="tabpanel"
              aria-labelledby="v-pills-home-tab"
            >
              <!-- <div class="chat-header clearfix">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="current-chat-user-name">
                        <span>
                          <span class="name font-weight-bold ml-2"> </span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div> -->
              <div class="chat-meta-user pb-3 border-bottom">
                <div class="current-chat-user-name">
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
                  > </span>
                    <span
                      class="name "
                      v-text="coms.name"
                    ></span>
                     <span class="d-inline-block text-right text-muted float-right m-2" v-text="coms.cf_2220"></span>

                </div>
              </div>
              <h4 class="card-title">Comm track</h4>
              <ul
                class="chat-list chat  mb-5"
                :data-user-id="'thread' + coms.cf_2218"

              >
                <li
                  class="shadow-lg p-2 m-4"
                  v-for="comm in commboards"
                :key="comm.id"
                    rounded
                >
                  <div class="col-12 p-3 d-inline-block"  v-if="comm && comm.modifiedby === contact.modifiedby">
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
                    <span class="d-inline-block text-right text-muted float-right" v-text="comm.cf_2220">

                  </span>
                    <br />
                    <div
                      class="
                        shadow-lg
                        m-3 p-2
                        box
                        d-inline-block
                        text-dark
                        rounded
                      "
                      v-text="comm.description"
                    ></div>

                    <div
                    class=" d-inline-block float-right text-muted"
                  ><p  v-text="comm.cf_2226"></p>
                  <p v-text="comm.cf_2228"> </p>
                  </div>
                  </div>

                       <div class="col-12 pl-3 d-inline-block text-right" v-else >


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
                  <div
                    class=" d-inline-block text-right text-muted"
                  >
                  <p  v-text="comm.cf_2226"></p>
                  <p v-text="comm.cf_2228"> </p>
                  </div>
                  </div>

                </li>
                <!--chat Row -->

                <li class="odd mt-4" >

                </li>
              </ul>
              <!--  -->
              <div
                class="
                  card-body
                  border-top border-bottom
                  chat-send-message-footer
                "
              >
                <form method="" enctype="multipart/form-data"
                  autocomplete="nope">
                  <div class="col-12">
                    <div class="row">
                      <input
                        v-model="threadid"
                        type="text" disabled
                        id="threadid"
                      />
                      <input
                        v-model="threadtype"
                        type="text" disabled
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
                        <a href="#"
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
      action: 1,
      submitted: false,
      errors: {},
      threadid:'',
      threadtype:'',
      subject:'',
comment:'',
    };
  },
  mounted() {
    this.getCommboard();
  },
  methods: {
    setComm(val) {
      this.coms = val;
      console.log({ val });

 /*      alert(this.coms['cf_2218'],
this.coms['cf_2220']); */

      this.threadid = this.coms['cf_2218'];
      this.threadtype =this.coms['cf_2220'];

      this.subname = this.coms["name"].substring(0, 1);
      /* console.log(this.subname); */
    },

    getCommboard() {
      let me = this;
      axios
        .get("/comments")
        .then(function (response) {
          console.log({ response });
          let commResp = response.data[0];
          let contact = response.data[1];
          me.setComm(commResp[0]);

          me.commboards = commResp;
          me.contact = contact;
          console.log(commResp.length);

          console.log(me.coms);

          for (const [i, v] of commResp.entries()) {
            console.log({ i: v });
            console.log(i, v);

            if (!me.groupArr.includes(v.cf_2218)) {
              me.groupArr.push(v.cf_2218);
              me.groupArr2.push(v);
            }
          }
          (me.fullname = contact.firstname), " ", contact.lastname;

          me.subject='';
          me.comment='';
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    sendMessage() {
        this.submitted = true;
        this.errors = {};
        let me = this;

        console.log(me)
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
          console.log(res.data);
          //window.location.reload();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
