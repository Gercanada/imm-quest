<template>
  <div class="container-fluid">
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
                <span class="d-none d-lg-block">{{ summario }}</span>
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
                <span class="d-none d-lg-block">{{ actual }}</span>
              </a>
            </li>
            <li class="nav-item" v-for="sCopy in scennariosCopies">
              <a
                :href="'#copy' + sCopy.id"
                data-toggle="tab"
                aria-expanded="false"
                class="nav-link"
              >
                <i class="mdi mdi-playlist-plus d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">{{ sCopy.name }}</span>
              </a>
            </li>
          </ul>

          <div class="tab-content" style="width: 100%">
            <div class="tab-pane show active" id="Summary">
              <!-- <h1 class="bg-danger">{{ language }}</h1> -->
              <!-- Contains SumMMaryTable component -->
              <!-- Send values from thit tho his children -->
              <Summary
                :summary="summary"
                :factors="Factors"
                :scores="scores"
                :FactorsWithScores="FactorsWithScores"
                :maritialStatusChanged="maritialStatusChanged"
                :scennariosCopies="scennariosCopies"
                :authenticated="authenticated"
                :language="language"
                :reloadAt="reloadAt"
              />
            </div>
            <div class="tab-pane" id="Situation">
              <!-- Contains scennarios accordions and change maritial status -->
              <!-- receiving values from child of this like a function -->
              <SituationA
                @maritialChanged="getMaritialChanged"
                @selectedSituation="getSituation"
                @FactorsTitles="getTitles"
                @scoresArr="getScores"
                @additionalScennarios="getAdditionalScennarios"
                @factorsWithSubfactors="getFactsWSubfacts"
                @reloader="getReloader"
                :authenticated="authenticated"
                :language="language"
              />
            </div>
            <div v-for="copy in scennariosCopies" :id="'copy' + copy.id" class="tab-pane">
              <!-- {{ copy }} -->
              <Scenario2
                :copyId="copy.id"
                :body="copy.body"
                :factors="factorsWithSubfactors"
                :maritialSituation="copy.is_married ? copy.is_married : 0"
                :scennarioName="copy.name"
                :language="language"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Summary from "./content-tabs/Summary.vue";
import SituationA from "./content-tabs/actual-scennario/SituationA.vue";
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
      user: {},
      summary: [],
      Factors: [],
      scores: null,
      FactorsWithScores: [],
      maritialStatusChanged: null,
      scennariosCopies: [],
      factorsWithSubfactors: [],
      reloadAt: null,
      authenticated: false,
      language: null,
      summario: "Summary",
      actual: "Actual scennario",
    };
  },

  created() {
    if (window.Laravel.user) {
      this.language = window.Laravel.languaje;
      this.email = window.Laravel.user.email;
      this.name = window.Laravel.user.name;
      this.last_name = window.Laravel.user.last_name;
      this.authenticated = true;
      //   this.language = window.Laravel.Languaje;
    } else {
      this.authenticated = false;
    }

    if (this.language === "es") {
      this.summary = "Sumario";
      this.actual = "Escenario actual";
    }
  },

  methods: {
    getSituation(value) {
      //   console.log("Summary");
      let me = this;
      me.summary = value;
    },
    getTitles(value) {
      this.Factors = value;
    },
    getFactsWSubfacts(value) {
      //   console.log("Facts");
      this.factorsWithSubfactors = value;
    },

    getMaritialChanged(value) {
      //   console.log("CONTENT");
      this.maritialStatusChanged = value;
    },

    getAdditionalScennarios(value) {
      //   console.log("Extra scennarios");
      this.scennariosCopies = value;
    },

    getReloader(value) {
      this.reloadAt = value;
    },

    getScores(value) {
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
