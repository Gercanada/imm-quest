<template>
  <!-- <div class="card"> -->
  <!-- <div class="card-body"> -->
  <!-- Signup modal content -->
  <div
    id="signup-modal"
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mt-2 mb-4">
            <a href="index.html" class="text-success">
              <span
                ><img
                  class="mr-2"
                  src="https://placekitten.com/18/18"
                  alt=""
                  height="18" /><img
                  src="https://placekitten.com/18/18"
                  alt=""
                  height="18"
              /></span>
            </a>
          </div>

          <form class="pl-3 pr-3" action="#">
            <div class="form-group">
              <label for="username">Name</label>
              <input
                class="form-control"
                type="email"
                id="username"
                required=""
                placeholder="Michael Zenaty"
              />
            </div>

            <div class="form-group">
              <label for="emailaddress">Email address</label>
              <input
                class="form-control"
                type="email"
                id="emailaddress"
                required=""
                placeholder="john@deo.com"
              />
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input
                class="form-control"
                type="password"
                required=""
                id="password"
                placeholder="Enter your password"
              />
            </div>

            <div class="form-group">
              <input
                type="checkbox"
                id="md_checkbox_5"
                class="chk-col-indigo material-inputs"
              />
              <label for="md_checkbox_5"
                >I accept <a href="#">Terms and Conditions</a></label
              >
            </div>

            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit" @click.stop.prevent="login">
                Sign Up Free
              </button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- SignIn modal content -->
  <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mt-2 mb-4">
            <a href="index.html" class="text-success">
              <span
                ><img
                  class="mr-2"
                  src="https://placekitten.com/18/18"
                  alt=""
                  height="18" /><img
                  src="https://placekitten.com/18/18"
                  alt=""
                  height="18"
              /></span>
            </a>
          </div>

          <form action="#" class="pl-3 pr-3">
            <div class="form-group">
              <label for="emailaddress1">Email address</label>
              <input
                class="form-control"
                type="email"
                id="emailaddress1"
                required=""
                placeholder="john@deo.com"
                autofocus
                v-model="email"
              />
            </div>

            <div class="form-group">
              <label for="password1">Password</label>
              <input
                class="form-control"
                type="password"
                v-model="password"
                required=""
                id="password1"
                placeholder="Enter your password"
              />
            </div>

            <div class="form-group">
              <input
                type="checkbox"
                id="customCheck2"
                class="chk-col-indigo material-inputs"
              />
              <label for="customCheck2">Remember me</label>
            </div>

            <div class="form-group text-center">
              <button class="btn btn-rounded btn-primary" type="submit" @click="login">
                Sign In
              </button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <ul class="navbar-nav float-right">
    <!-- Custom width modal -->
    <a class="nav-item nav-link" data-toggle="modal" data-target="#signup-modal">
      <i class="fas fa-user"></i> Sign Up
    </a>
    <!-- Full width modal -->
    <a class="nav-item nav-link" data-toggle="modal" data-target="#login-modal">
      <i class="fas fa-key"></i>
      Log in Modal
    </a>
  </ul>
  <!-- </div> -->
  <!-- end card-body-->
  <!-- </div> -->
  <!-- end card-->
</template>

<script>
export default {
  props: {
    title: {
      required: true,
      default: "Without title",
    },
  },
  data() {
    return {
      userName: "",
      Password: "",
      /*   headers: {
        "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
        "Content-Type": "multipart/form-data",
      }, */
    };
  },
  methods: {
    login(e) {
      e.preventDefault();
      if (this.password.length > 0) {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post("api/login", {
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              console.log(response.data);
              if (response.data.success) {
                this.$router.go("/dashboard");
              } else {
                this.error = response.data.message;
              }
            })
            .catch(function (error) {
              console.error(error);
            });
        });
      }
    },

    beforeRouteEnter(to, from, next) {
      if (window.Laravel.isLoggedin) {
        return next("dashboard");
      }
      next();
    },
    /* axios
        .post("/login", { email: this.userName, password: this.Password })
        .then(function (response) {
          console.log(response);
        })
        .catch(console.error()); },*/
  },
};
</script>

<style>
/* .modal-content {
  -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0);
  -moz-box-shadow: 0 5px 15px rgba(0, 0, 0, 0);
  -o-box-shadow: 0 5px 15px rgba(0, 0, 0, 0);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0);
} */

.modal-backdrop {
  z-index: 0 !important;
}
.modal {
  z-index: 600 !important;
}
</style>
