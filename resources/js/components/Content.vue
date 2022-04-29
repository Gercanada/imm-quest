<template>
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Grid With Row Label</h4> -->
          <form action="#">
            <div class="form-body">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-1">Name</label>
                  <div class="col-lg-11">
                    <div class="row">
                      <div class="col-md-12">
                        <input
                          :value="name + ' ' + last_name"
                          type="text"
                          class="form-control"
                          placeholder="Your Full Name"
                          disabled
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
                          v-model="email"
                          type="email"
                          class="form-control"
                          placeholder="example@mailsrv.any"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                </div>
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
                <span class="d-none d-lg-block">Sumario</span>
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
                <span class="d-none d-lg-block">Situacion actual</span>
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
                <span class="d-none d-lg-block">Escenario x</span>
              </a>
            </li>
          </ul>

          <div class="tab-content" style="width: 100%">
            <div class="tab-pane show active" id="Summary">
              <!-- Contains SumMMaryTable component -->
              <Summary
                :summary="summary"
                :factors="Factors"
                :scores="scores"
                :FactorsWithScores="FactorsWithScores"
                :maritialStatusChanged="maritialStatusChanged"
              />
            </div>
            <div class="tab-pane" id="Situation">
              <!-- Contains scennarios accordions and change maritial status -->
              <SituationA
                @maritialChanged="getMaritialChanged"
                @selectedSituation="getSituation"
                @FactorsTitles="getTitles"
                @scoresArr="getScores"
              />
            </div>
            <div class="tab-pane" id="scenario-2">
              <!-- Temp example -->
              <Scenario2 />
            </div>
          </div>
        </div>
        <!-- end card-body-->
      </div>
    </div>
  </div>
</template>

<script>
import Summary from "./content-tabs/Summary.vue";
import SituationA from "./content-tabs/SituationA.vue";
import Scenario2 from "./content-tabs/Scenario2.vue";

export default {
  components: {
    Summary,
    SituationA,
    Scenario2,
  },
  data() {
    return {
      email: "",
      name: "",
      last_name: "",
      requiredBeAuth: false,
      loading: true,
      isAuthenticated: false,
      user: {},
      summary: [],
      Factors: [],
      scores: null,
      FactorsWithScores: [],
      maritialStatusChanged: null,
    };
  },

  created() {
    if (window.Laravel.user) {
      this.email = window.Laravel.user.email;
      this.name = window.Laravel.user.name;
      this.last_name = window.Laravel.user.last_name;
    }
  },

  methods: {
    getSituation(value) {
      //   console.log("situation");
      let me = this;
      me.summary = value;
    },
    getTitles(value) {
      this.Factors = value;
    },

    getMaritialChanged(value) {
      console.log("CONTENT");
      this.maritialStatusChanged = value;
      //   console.log(value);
    },

    getScores(value) {
      console.log(value);
      //   console.log("some getted");
      //   return;
      this.scores = value[0];
      let factArr = [];

      this.Factors.forEach((factor) => {
        this.scores.forEach((score) => {
          if (
            score["singleSum"] != undefined &&
            "factor" in score["singleSum"] &&
            score["singleSum"].factor === factor.id
          ) {
            factArr.push({ factor: factor.id, singleSum: score["singleSum"].sum });
          }
          if (
            score["marriedSum"] != undefined &&
            "factor" in score["marriedSum"] &&
            score["marriedSum"].factor === factor.id
          ) {
            factArr.push({ factor: factor.id, marriedSum: score["marriedSum"].sum });
          }
        });
      });
      let Grouped = [];
      Grouped = _.mapValues(_.groupBy(factArr, "factor"), (list) =>
        list.map((val) => _.omit(val, "factor"))
      );
      this.FactorsWithScores = Grouped;
    },
  },
};
</script>
<style scoped>
.card {
  width: 100%;
}
</style>
