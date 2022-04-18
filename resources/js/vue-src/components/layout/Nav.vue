<template>
  <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a
          class="nav-toggler waves-effect waves-light d-block d-md-none"
          href="javascript:void(0)"
          ><i class="ti-menu ti-close"></i
        ></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="index.html">
          <!-- Logo icon -->
          <b class="logo-icon">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img
              src="https://placekitten.com/50/50"
              alt="homepage"
              class="dark-logo rounded"
            />
            <!-- Light Logo icon -->
            <img
              src="https://placekitten.com/50/50"
              alt="homepage"
              class="light-logo rounded-circle"
            />
          </b>
          <!--End Logo icon -->
          <!-- Logo text -->
          <span class="logo-text">
            <!-- dark Logo text -->
            <img src="https://placekitten.com/150/50" alt="homepage" class="dark-logo" />
            <!-- Light Logo text -->
            <img
              src="https://placekitten.com/175/50"
              class="light-logo rounded"
              alt="homepage"
            />
          </span>
        </a>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a
          class="topbartoggler d-block d-md-none waves-effect waves-light"
          href="javascript:void(0)"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
          ><i class="ti-more"></i
        ></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      here
      <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav mr-auto float-left">
          <!-- This is  -->
          <li class="nav-item">
            <a
              class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
              href="javascript:void(0)"
              ><i class="ti-menu"></i
            ></a>
          </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        HERE
        <ul class="navbar-nav float-right">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
              href=""
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="flag-icon flag-icon-us"></i
            ></a>
            <div class="dropdown-menu dropdown-menu-right animated bounceInDown">
              <a class="dropdown-item" href="#"
                ><i class="flag-icon flag-icon-in"></i> India</a
              >
              <a class="dropdown-item" href="#"
                ><i class="flag-icon flag-icon-fr"></i> French</a
              >
              <a class="dropdown-item" href="#"
                ><i class="flag-icon flag-icon-cn"></i> China</a
              >
              <a class="dropdown-item" href="#"
                ><i class="flag-icon flag-icon-de"></i> Dutch</a
              >
            </div>
          </li>
          <!-- ============================================================== -->
          <!-- Profile -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle waves-effect waves-dark"
              href=""
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                src="https://placekitten.com/60/60"
                alt="user"
                width="30"
                class="profile-pic rounded-circle"
              />
            </a>
            <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown">
              <ul class="dropdown-user list-style-none">
                <li>
                  <div class="dw-user-box p-3 d-flex">
                    <div class="u-img">
                      <img
                        src="https://placekitten.com/60/60"
                        alt="user"
                        class="rounded"
                        width="80"
                      />
                    </div>
                    <div class="u-text ml-2">
                      <h4 class="mb-0">Steave Jobs</h4>
                      <p class="text-muted mb-1 font-14">varun@gmail.com</p>
                      <a
                        href="pages-profile.html"
                        class="btn btn-rounded btn-danger btn-sm text-white d-inline-block"
                        >View Profile</a
                      >
                    </div>
                  </div>
                </li>
                <li role="separator" class="dropdown-divider"></li>
                <li class="user-list">
                  <a class="px-3 py-2" href="#"><i class="ti-user"></i> My Profile</a>
                </li>
                <li role="separator" class="dropdown-divider"></li>
                <li class="user-list">
                  <a class="px-3 py-2" href="#"
                    ><i class="ti-settings"></i> Account Setting</a
                  >
                </li>
                <li role="separator" class="dropdown-divider"></li>
                <li class="user-list">
                  <a class="px-3 py-2" @click.stop.prevent="logout"
                    ><i class="fa fa-power-off"></i> Logout</a
                  >
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>

      <div class="collapse navbar-collapse bg-info">
        <!-- for logged-in user-->
        <div class="navbar-nav" v-if="isLoggedIn">
          <a class="nav-item nav-link" style="cursor: pointer" @click="logout">Logout</a>
        </div>
        <!-- for non-logged user-->
        <div class="navbar-nav" v-else><LoginModal /></div>
      </div>
    </nav>
  </header>
</template>

<script>
import LoginModal from "../auth/LoginModal";
// import { openModal, container } from "../auth/LoginModal";

// import { openModal, container } from "jenesius-vue-modal";
// import Modal from "Modal.vue";
export default {
  data() {
    return {
      headers: {
        "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
        "Content-Type": "multipart/form-data",
      },
    };
  },
  mounted() {},
  components: { LoginModal },
  methods: {
    logout() {
      axios
        .post("/logout")
        .then(function (response) {
          console.log(response);
        })
        .catch(console.error());
    },
    showLoginModal() {
      isShow.value = true;
    },
  },
};
</script>
