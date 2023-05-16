<template>
  <div class="card">
    <div class="card-body">
      <div class="row pb-3 mb-2"></div>
      <div class="bootstrap-table" style="overflow-x: auto">
        <table
          data-toggle="table"
          data-mobile-responsive="true"
          class="table-striped table table-hover table-bordered"
          data-sort-order="default"
        >
          <thead v-html="thead"></thead>
          <tbody v-html="tbody"></tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      list: [],
      items: [],
      thead: "",
      tbody: "",
    };
  },
  mounted() {
    this.getList();
  },
  computed: {
    factors() {
      const factors = new Set();
      for (const item of this.items) {
        for (const factor in item.body) {
          factors.add(factor);
        }
      }
      console.log({ factors });
      return Array.from(factors);
    },
    criterions() {
      const criterions = new Set();
      for (const item of this.items) {
        for (const factor in item.body) {
          for (const criterion in item.body[factor]) {
            criterions.add(criterion);
          }
        }
      }
      console.log({ factors });
      return Array.from(criterions);
    },
  },
  methods: {
    getList() {
      let me = this;
      axios
        .get("/admin/scenarios/list")
        .then(function (res) {
          console.log(res);
          me.list = res.data;
          //   let name = me.list[0]["name"];
          //   let keys = Object.keys(me.list[0].body);

          let theadTr1 = "";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>User name</th>";
          theadTr1 =
            theadTr1 + "<th rowspan='2' colspan='1'>Scenario name</th>";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Married</th>";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Is actual</th>";

          let theadTr2 = "";
          const order = ["user", "name", "is_married", "is_theactual"];

          me.list.forEach((scenario) => {
            Object.keys(scenario["body"]).forEach((scKey) => {
              //!th1
              let collspan = 1;
              Object.keys(scenario["body"][scKey]).forEach((inKey) => {
                // !th2
                // const th = "<th>" + inKey + "</th>";
                if (!theadTr2.includes(inKey)) {
                  collspan = collspan + 1;
                  theadTr2 += "<th>" + inKey + "</th>";
                  order.push(inKey);
                }
              });

              if (!theadTr1.includes(scKey)) {
                const th =
                  "<th rowspan='1' colspan='" +
                  collspan +
                  "'>" +
                  scKey +
                  "</th>";
                //! set string if not included in string
                theadTr1 += th;
              }
            });
          });
          me.thead = "<tr>" + theadTr1 + "</tr>" + "<tr>" + theadTr2 + "</tr>";

          me.list.forEach((scenario) => {
            let tds = "";
            order.forEach((inKey) => {
              if (inKey === "user") {
                tds +=
                  "<td>" +
                  scenario[inKey].name +
                  "  " +
                  scenario[inKey].last_name +
                  "</td>";
              } else if (inKey === "name") {
                tds += "<td>" + scenario[inKey] + "</td>";
              } else if (["is_married", "is_theactual"].includes(inKey)) {
                tds += "<td>" + scenario[inKey] + "</td>";
              } else if (
                !["id", "created_at", "updated_at", "body", "user_id"].includes(
                  inKey
                )
              ) {
                let val = "";
                Object.values(scenario["body"]).forEach((factor) => {
                //   console.log({ entries: Object.entries(factor) });
                  Object.entries(factor).forEach(
                    ([criterion, criterionData]) => {
                      if (criterion === inKey) {
                        val =
                          "<p><b> Criterio:  </b>" +
                          criterionData.criterion +
                          "<br><b> Puntos: </b>" +
                          criterionData.value +
                          "</p>";
                      }
                    }
                  );
                });
                tds += "<td>" + val + "</td>";
              }
            });
            me.tbody += "<tr>" + tds + "</tr>";
          });
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
