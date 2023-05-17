<template>
  <div class="card">
    <div class="card-body">
      <div class="row pb-3 mb-2">
        <div class="col-md-8">
          <h4 class="card-title">{{ scoreSummary }}</h4>
        </div>
        <div class="col-md-4">
          <button
            class="btn btn-outline-danger waves-effect waves-light"
            type="button"
            @click="printSummary"
          >
            <span class="btn-label"><i class="far fa-file-pdf"></i></span>
            {{ makePdf }}
          </button>
        </div>
      </div>

      <div class="bootstrap-table">
        <table
          data-toggle="table"
          data-mobile-responsive="true"
          class="table-striped table table-hover table-bordered"
          data-sort-order="default"
        >
          <thead>
            <tr>
              <th></th>
              <th data-sortable="" data-width="auto">{{ actual }}</th>
              <th
                class="text-center"
                data-width="auto"
                v-for="sCopy in scennariosCopies"
              >
                {{ sCopy.name }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>
                <b>{{ mStatus }}</b>
              </th>
              <th class="detail">
                {{
                  maritialStatusChanged != null
                    ? maritialStatusChanged == "Married"
                      ? married
                      : single
                    : single
                }}
              </th>
              <th v-for="sCopy1 in scennariosCopies">
                {{ sCopy1.is_married == true ? married : single }}
              </th>
            </tr>
            <tr>
              <th>{{ totalScore }}</th>
              <th class="text-right">{{ totalForFactor }}</th>
              <th class="text-right" v-for="sumS in sumScoreCopies.copies">
                {{ sumS.total }}
              </th>
            </tr>
            <tr v-for="fact in factors">
              <td>{{ fact.name }}</td>
              <td class="text-right">
                {{
                  maritialStatusChanged === "Married" &&
                  fact.id in FactorsWithScores &&
                  FactorsWithScores[fact.id]
                    ? FactorsWithScores[fact.id][1].marriedSum
                    : fact.id in FactorsWithScores && FactorsWithScores[fact.id]
                    ? FactorsWithScores[fact.id][0].singleSum
                    : 0
                }}
              </td>
              <td v-for="sumEach in sumScoreCopies.copies" class="text-right">
                <p
                  v-for="(value, name, index) in sumEach.sums"
                  v-if="Object.keys(value)[0] == fact.id"
                >
                  {{ Object.values(value)[0] }}
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "summary",
    "factors",
    "scores",
    "FactorsWithScores",
    "maritialStatusChanged",
    "scennariosCopies",
    "reloadAt",
    "language",
  ],
  watch: {
    FactorsWithScores: function () {
      let toSumArr = [];
      this.factors.forEach((fact) => {
        toSumArr.push(
          this.maritialStatusChanged === "Married" &&
            [fact.id] in this.FactorsWithScores &&
            this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][1].marriedSum
            : [fact.id] in this.FactorsWithScores &&
              this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][0].singleSum
            : 0
        );
      });
      let sum = 0;
      for (let i = 0; i < toSumArr.length; i++) {
        sum += toSumArr[i];
      }
      this.totalForFactor = sum;
    },

    maritialStatusChanged: function () {
      let toSumArr = [];
      this.factors.forEach((fact) => {
        toSumArr.push(
          this.maritialStatusChanged === "Married" &&
            [fact.id] in this.FactorsWithScores &&
            this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][1].marriedSum
            : [fact.id] in this.FactorsWithScores &&
              this.FactorsWithScores[fact.id]
            ? this.FactorsWithScores[fact.id][0].singleSum
            : 0
        );
      });
      let sum = 0;
      for (let i = 0; i < toSumArr.length; i++) {
        sum += toSumArr[i];
      }
      this.totalForFactor = sum;
    },

    scennariosCopies: function () {
      let scennarios = { copies: [] };
      let scNames = [];
      this.scennariosCopies.forEach((copy) => {
        let groupByFacto = JSON.parse(copy.body).reduce((group, product) => {
          const { factor } = product;
          group[factor] = group[factor] ? group[factor] : [];
          group[factor].push(product.value);
          return group;
        }, {});
        scNames.push(copy.name);
        scennarios["copies"].push({ [copy.name]: groupByFacto });
      });

      for (let i = 0; i < scennarios.copies.length; i++) {
        let scennary = scennarios.copies[i];
        for (const [key, value] of Object.entries(scennary)) {
          let totals = [];

          for (const [key, value] of Object.entries(value)) {
            let sum = 0;
            for (let b = 0; b < value.length; b++) {
              sum += value[b];
            }
            totals.push({ [key]: sum });
          }
          scennary["sums"] = totals;

          let total = 0;
          for (let b = 0; b < totals.length; b++) {
            total += Number(Object.values(totals[b]));
          }
          scennary["total"] = total;
        }
      }
      this.sumScoreCopies = scennarios;
      return;
    },

    reloadAt: function () {
      //   alert("here");
      this.$forceUpdate();
    },
  },

  data() {
    return {
      f1ScoreMarried: 0,
      f1ScoreSingle: 0,
      totalForFactor: 0,
      sumScoreCopies: [],
      scoreSummary:
        this.language == "es" ? "Sumario de puntos" : "Score summary",
      makePdf:
        this.language == "es"
          ? "Generar documento pdf"
          : "Generate pdf document",
      actual: this.language == "es" ? "Escenario actual" : "Actual scennary",
      mStatus: this.language == "es" ? "Estado civil" : "Maritial status",
      single: this.language == "es" ? "Soltero" : "Single",
      married: this.language == "es" ? "Casado" : "Married",
      totalScore: this.language == "es" ? "Total de puntos" : "Total score",
    };
  },
  methods: {
    sumEachs(val, pos) {
      let newVal = 0;
      val.forEach((element) => {
        for (const [key, value] of Object.entries(element)) {
          newVal = { [pos]: value };
        }
      });
      return newVal;
    },

    printSummary() {
      let me = this;
      let fileName = "";
      let response1 = null;
      function delay(time) {
        return new Promise((resolve) => setTimeout(resolve, time));
      }
      axios
        .post("print-summary", { data })
        .then(function (response) {
          response1 = response.data;
          Swal.fire({
            type: "info",
            title:
              me.language == "es"
                ? " Se abrirá el documento en una nueva ventana. Desde ahi lo puede descargar. Para volver a generarlo hay que volver a esta vista"
                : "The document will open in a new window. From there you can download it. To regenerate it you have to return to this view",
          });
        })
        .catch((error) => {
          console.table(error);
        })
        .then(() => {
        //   console.log(response1.data);
          //   fileName = response1.data;
          window.open("scenarios-preview");
          //   window.open("/open_pdf/" + fileName);
          //   console.table(response1);
        });
      delay(10000) //!Delete then of download
        .then(() => {
          axios
            .get("delete_temp_file/" + fileName)
            .then(function (response) {});
        })
        .catch((error) => {
          console.table(error);
        });
    },
  },
};
</script>

<style scoped>
table {
  height: auto;
  overflow: auto;
  position: relative;
}

tbody tr td p .right {
  text-align: right;
}

tbody tr td p .left {
  text-align: left;
}

tbody tr .rowName {
  text-align: left;
  width: 40%;
  min-width: 20%;
}
.card {
  height: 100%;
}
</style>
