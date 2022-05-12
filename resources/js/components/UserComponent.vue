<template>
  <div v-if="loading" style="heigth: 100%">
    <div class="card shadow p-1 rounded">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <div class="row page-titles">
      <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Profile</h3>
      </div>
    </div>
    <!-- Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow p-1 rounded">
          <!-- Tabs -->
          <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="pills-profile-tab"
                data-toggle="pill"
                href="#last-month"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="true"
                ><i class="fas fa-child"></i> Profile</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-setting-tab"
                data-toggle="pill"
                href="#previous-month"
                role="tab"
                aria-controls="pills-setting"
                aria-selected="false"
                ><i class="fas fa-cogs"></i> Setting</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-setting-tab"
                data-toggle="pill"
                href="#password-tab"
                role="tab"
                aria-controls="pills-setting"
                aria-selected="false"
                ><i class="fas fa-key"></i> Password</a
              >
            </li>
          </ul>
          <!-- Tabs -->
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade active show"
              id="last-month"
              role="tabpanel"
              aria-labelledby="pills-profile-tab"
            >
              <div class="card">
                <div class="card-body">
                  <center class="mt-4">
                    <span
                      class="rounded-circle bg-success text-center display-1 w-100 p-3 font-weight-bold"
                      width="150"
                      v-text="
                        userObj.firstname.substring(0, 1) +
                        userObj.lastname.substring(0, 1)
                      "
                    >
                    </span>
                    <h4 class="card-title mt-2">
                      <b v-text="userObj.firstname"></b><b></b>
                      <b v-text="userObj.lastname"></b>
                    </h4>
                    <h6 class="card-subtitle" v-text="userObj.cf_1704"></h6>
                    <div class="row text-center justify-content-md-center"></div>
                  </center>
                </div>
                <div>
                  <hr />
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <small class="text-muted">Email </small>
                      <h6 v-text="userObj.email"></h6>
                      <small class="text-muted pt-4 db">Mobile phone</small>
                      <h6 v-text="userObj.mobile"></h6>
                      <small class="text-muted pt-4 db">Address</small>
                      <h6 v-text="userObj.mailingstreet"></h6>
                    </div>

                    <div class="col-md-6">
                      <small class="text-muted">Alternate Email </small>
                      <h6 v-text="userObj.secondaryemail"></h6>
                      <small class="text-muted pt-4 db">Date of birth</small>
                      <h6 v-text="userObj.birthday"></h6>
                      <small class="text-muted pt-4 db">Age</small>
                      <h6 v-text="userObj.cf_1334"></h6>
                    </div>
                  </div>

                  <small class="text-muted pt-4 db">Social Profile</small>
                  <br />
                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_2246"
                    :href="userObj.cf_2246"
                  >
                    <i class="fab fa-facebook-f"></i>
                  </a>

                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_2252"
                    :href="userObj.cf_2252"
                  >
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_2250"
                    :href="userObj.cf_2250"
                  >
                    <i class="fab fa-linkedin"></i>
                  </a>
                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_2254"
                    :href="userObj.cf_2254"
                  >
                    <i class="fab fa-skype"></i>
                  </a>
                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_2248"
                    :href="userObj.cf_2248"
                  >
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a
                    class="btn btn-circle btn-secondary"
                    type="btn"
                    data-toggle="tooltip"
                    :title="userObj.cf_1945"
                    :href="userObj.cf_1945"
                  >
                    <i class="fab fa-whatsapp"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- Edit profile -->
            <div
              class="tab-pane fade"
              id="previous-month"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <form
                  class="form-horizontal form-material"
                  enctype="multipart/form-data"
                  autocomplete="nope"
                >
                  <input
                    autocomplete="off"
                    name="hidden"
                    type="text"
                    style="display: none"
                  />
                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="secondaryemail"
                      >Alternative email</label
                    >
                    <div class="col-md-12">
                      <input
                        type="email"
                        placeholder="name@mail.com"
                        class="form-control form-control-line"
                        id="secondaryemail"
                        v-model="userObj.secondaryemail"
                        autocomplete="off"
                      />
                    </div>
                  </div>
                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="mobile">Mobile</label>
                    <div class="col-md-12">
                      <input
                        type="tel"
                        placeholder="123 456 7890"
                        class="form-control form-control-line"
                        id="mobile"
                        v-model="userObj.mobile"
                        autocomplete="off"
                      />
                    </div>
                  </div>
                  <div class="form-group" autocomplete="none">
                    <label for="whatsapp" class="col-md-12">WhatsApp</label>
                    <div class="col-md-12">
                      <input
                        type="tel"
                        placeholder="123 456 7890"
                        class="form-control form-control-line"
                        id="whatsapp"
                        v-model="userObj.cf_1945"
                        autocomplete="off"
                      />
                    </div>
                  </div>

                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="skypeLink">Skype </label>
                    <div class="col-md-12">
                      <input
                        id="skypeLink"
                        autocomplete="off"
                        type="url"
                        placeholder="skype.com/profile.01"
                        class="form-control form-control-line"
                        v-model="userObj.cf_2254"
                      />

                      <small
                        v-if="submitted && errors.skype"
                        class="text-danger font-14"
                        >{{ errors.skype }}</small
                      >
                    </div>
                  </div>
                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="inputfb">Facebook </label>
                    <div class="col-md-12">
                      <input
                        id="inputfb"
                        type="url"
                        placeholder="facebook.com/profile.01"
                        class="form-control form-control-line"
                        v-model="userObj.cf_2246"
                        autocomplete="off"
                      />
                      <small
                        v-if="submitted && errors.facebook"
                        class="text-danger font-14"
                        >{{ errors.facebook }}</small
                      >
                    </div>
                  </div>
                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="instagramLink">Instagram </label>
                    <div class="col-md-12">
                      <input
                        type="url"
                        id="instagramLink"
                        placeholder="instagram.com/profile.01"
                        class="form-control form-control-line"
                        v-model="userObj.cf_2252"
                        autocomplete="off"
                      />
                      <small
                        v-if="submitted && errors.instagram"
                        class="text-danger font-14"
                        >{{ errors.instagram }}</small
                      >
                    </div>
                  </div>
                  <div class="form-group" autocomplete="off">
                    <label class="col-md-12" for="gotolinkedin">Linkedin </label>
                    <div class="col-md-12">
                      <input
                        v-model="userObj.cf_2250"
                        name="gotolinkedin"
                        placeholder="linkedin.com/profile.01"
                        class="form-control form-control-line"
                        type="url"
                        autocomplete="off"
                      />
                      <small
                        v-if="submitted && errors.linkedin"
                        class="text-danger font-14"
                        >{{ errors.linkedin }}</small
                      >
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" autocomplete="none">
                        <label class="col-md-12">CommBoard Notifications</label>

                        <div class="switch col-md-12">
                          <label
                            >OFF
                            <input
                              id="user_donotcall"
                              v-model="user_donotcall"
                              true-value="yes"
                              false-value="no"
                              type="checkbox"
                            /><span class="lever"></span>ON</label
                          >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" autocomplete="none">
                        <label class="col-md-12">SMS</label>
                        <div class="switch col-md-12">
                          <label
                            >OFF
                            <input
                              type="checkbox"
                              v-model="user_emailoptout"
                              true-value="yes"
                              false-value="no"
                            /><span class="lever"></span>ON</label
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <a href="#" class="btn btn-success" v-on:click="updateAccount()">
                        Update Profile
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- change password -->
            <div
              class="tab-pane fade"
              id="password-tab"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <form
                  class="form-horizontal form-material"
                  method="get"
                  autocomplete="nope"
                >
                  <input
                    autocomplete="off"
                    name="hidden"
                    type="text"
                    style="display: none"
                  />
                  <section autocomplete="disabled">
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass">Old password</label>
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="old_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                        <small
                          v-if="submitted && errors.old_password"
                          class="text-danger font-14"
                          >{{ errors.old_password }}</small
                        >
                      </div>
                    </div>
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass">New Password</label>
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="new_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass"
                        >Confirm new Password</label
                      >
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="confirm_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                      </div>
                    </div>
                    <small
                      v-if="submitted && errors.password"
                      class="text-danger font-14"
                      >{{ errors.password }}</small
                    >
                  </section>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <a href="#" class="btn btn-success" v-on:click="updatePassword()">
                        Update Password
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Column -->
    </div>
  </div>
</template>

<script>
import DisableAutocomplete from "vue-disable-autocomplete";
Vue.use(DisableAutocomplete);

export default {
  data() {
    return {
      loading: false,
      id: "",
      alternative_username: "",
      message: "",
      new_password: "",
      old_password: "",
      confirm_password: "",

      user_donotcall: false,
      user_emailoptout: false,

      userObj: {},
      submitted: false,
      errors: {},
    };
  },
  mounted() {
    this.userAccount();
  },

  methods: {
    userAccount() {
      let me = this;
      this.loading = true;
      axios
        .get("/account")
        .then(function (response) {
          me.userObj = response.data;

          if (me.userObj["donotcall"] == 0 || false) {
            me.user_donotcall === "yes";
          } else {
            me.user_donotcall = "no";
          }

          if (me.userObj["emailoptout"] == 0 || false) {
            me.user_emailoptout = "yes";
          } else {
            me.user_emailoptout = "no";
          }
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },

    updateAccount() {
      this.submitted = true;
      this.errors = {};
      this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      let me = this;
      axios
        .post("/account", {
          secondaryemail: me.userObj.secondaryemail,
          mobile: me.userObj.mobile,
          cf_1945: me.userObj.cf_1945,
          cf_2254: me.userObj.cf_2254,
          cf_2246: me.userObj.cf_2246,
          cf_2252: me.userObj.cf_2252,
          cf_2250: me.userObj.cf_2250,

          user_donotcall: me.user_donotcall,
          user_emailoptout: me.user_emailoptout,

          contact_no: me.userObj.contact_no,
        })
        .then(function (response) {
          Swal.fire({
            type: "success",
            title: "Account updated",
            timer: 2000,
            showConfirmButton: false,
          });
          //debugger;
          me.userAccount();
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title: "Account wasn't updated !",
            timer: 2000,
            showConfirmButton: false,
          });
          console.log(error);
        });
    },

    updatePassword() {
      this.submitted = true;
      this.errors = {};
      this.validePass();
      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      axios
        .post("/new_password", {
          contact_no: this.userObj.contact_no,
          old_password: this.old_password,
          new_password: this.new_password,
          confirm_password: this.confirm_password,
        })
        .then(function (response) {
          Swal.fire({
            type: "success",
            title: "Password changed",
            timer: 2000,
            showConfirmButton: false,
          });
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title: "Password not was updated !",
            timer: 2000,
            showConfirmButton: false,
          });
          console.table(error);
        });
    },

    //Validar campos requeridos
    validePass() {
      if (this.old_password !== this.userObj.cf_1780) {
        this.errors.old_password = "Incorrect old password";
      }
      if (!this.password && !this.confirm_password) {
        this.errors.password = "Password fields cant be blank";
      }
      if (this.new_password !== this.confirm_password) {
        this.errors.password = "Password and  confirm not equals";
      }
    },

    valideForm() {
      this.valideUrlField("userObj.cf_2254", "skype");
      this.valideUrlField("userObj.cf_2246", "facebook");
      this.valideUrlField("userObj.cf_2252", "instagram");
      this.valideUrlField("userObj.cf_2250", "linkedin");
    },

    valideUrlField(field, as) {
      let fail;
      if (field === "userObj.cf_2254") fail = this.userObj.cf_2254;
      if (field === "userObj.cf_2246") fail = this.userObj.cf_2246;
      if (field === "userObj.cf_2252") fail = this.userObj.cf_2252;
      if (field === "userObj.cf_2250") fail = this.userObj.cf_2250;

      console.log(field);
      console.log(fail);

      if (
        !/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i.test(
          fail
        ) &&
        fail !== ""
      ) {
        this.errors[
          as
        ] = `The ${as} field is not valid url. try some 'http://${as}.com/profile'`;
      }
    },
  },
};
</script>
