<template>
  <div class="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <!-- <h4 class="card-title">Grid With Row Label</h4> -->
            {{ user }}
            <form action="#">
              <div class="form-body">
                <div class="form-group">
                  <div class="row">
                    <label class="col-lg-1">Name</label>
                    <div class="col-lg-11">
                      <div class="row">
                        <div class="col-md-12">
                          <input
                            v-model="fullName"
                            type="text"
                            class="form-control"
                            placeholder="Your Full Name"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-lg-1">Email</label>
                    <div class="col-lg-11">
                      <div class="row">
                        <div class="col-md-12">
                          <input
                            v-model="eMail"
                            type="email"
                            class="form-control"
                            placeholder="example@mailsrv.any"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <div class="text-right">
                  <button type="submit" class="btn btn-info" @click="saveData">
                    <i class="fas fa-save"></i> Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="card">
          <div class="card-body">
            <!--    <h4 class="card-title mb-3">Tabs Bordered Justified</h4> -->
            <ul class="nav nav-tabs nav-justified nav-bordered mb-3 customtab">
              <li class="nav-item">
                <a
                  href="#Summary"
                  data-toggle="tab"
                  aria-expanded="false"
                  class="nav-link active"
                >
                  <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Summary</span>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#Situation"
                  data-toggle="tab"
                  aria-expanded="true"
                  class="nav-link"
                >
                  <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Actual situation</span>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#scenario-2"
                  data-toggle="tab"
                  aria-expanded="false"
                  class="nav-link"
                >
                  <i class="fas fa-cogs d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Scenario2</span>
                </a>
              </li>
            </ul>

            <div class="tab-content" style="width: 100%">
              <div class="tab-pane show active" id="Summary">
                <Summary />
              </div>
              <div class="tab-pane" id="Situation">
                <SituationA />
              </div>
              <div class="tab-pane" id="scenario-2">
                <Scenario2 />
              </div>
            </div>
          </div>
          <!-- end card-body-->
        </div>
      </div>
    </div>
  </div>

  <!-- end card-->
</template>

<script>
import Summary from "../content-tabs/Summary.vue";
import SituationA from "../content-tabs/SituationA.vue";
import Scenario2 from "../content-tabs/Scenario2.vue";
export default {
  components: {
    Summary,
    SituationA,
    Scenario2,
  },
  data() {
    return {
      eMail: "",
      fullName: "",
      requiredBeAuth: false,

      loading: true,
      isAuthenticated: false,
      user: {},
    };
  },
  mounted() {},
  methods: {
    saveData() {
      this.requiredBeAuth = true;
      axios
        .post("/save_situation", { email: this.eMail, name: this.fullName })
        .then(function (response) {
          console.log(response);
        });
    },
  },
};
</script>
<style scoped>
.card {
  width: 100%;
}
</style>
