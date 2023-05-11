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
                const th = "<th>" + inKey + "</th>";
                if (!theadTr2.includes(inKey)) {
                  collspan = collspan + 1;
                  theadTr2 += "<th>" + inKey + "</th>";
                  order.push(inKey);
                }
              });

              const th =
                "<th rowspan='1' colspan='" + collspan + "'>" + scKey + "</th>";
              if (!theadTr1.includes(scKey)) {
                //! set string if not included in string
                theadTr1 += th;
              }
            });
          });
          me.thead = "<tr>" + theadTr1 + "</tr>" + "<tr>" + theadTr2 + "</tr>";
          //   console.log(me.thead);

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
                // alert(JSON.stringify(scenario[inKey]));
              } else if (inKey === "name") {
                tds += "<td>" + scenario[inKey] /* scenario.name */ + "</td>";
              } else if (["is_married", "is_theactual"].includes(inKey)) {
                tds += "<td>" + scenario[inKey] + "</td>";
              } /*  else if (inKey === "body") {
                alert("here");
                let val = "";
                Object.values(scenario["body"]).forEach((factor) => {
                  console.log({ entries: Object.entries(factor) });
                  Object.entries(factor).forEach(
                    ([criterion, criterionData]) => {
                      if (criterionData[criterion] === inKey) {
                        val = criterionData.value;
                      }
                    }
                  );
                });
                tds += "<td>" + val + "</td>";
              } */ else if (
                !["id", "created_at", "updated_at", "body", "user_id"].includes(
                  inKey
                )
              ) {
                let val = "";
                Object.values(scenario["body"]).forEach((factor) => {
                  console.log({ entries: Object.entries(factor) });
                  Object.entries(factor).forEach(
                    ([criterion, criterionData]) => {
                      //   alert(JSON.stringify({ criterionData }));
                      if (/* criterionData[criterion] */ criterion === inKey) {
                        val =
                          "<p><b> Criterio:  </b>" +
                          criterionData.criterion +
                          "<br><b> Puntos: </b>" +
                          criterionData.value +
                          "</p>";
                        /* val = criterionData
                          ? JSON.stringify(criterionData)
                          : "";  */

                        /* criterionData.value; */
                      }
                    }
                  );
                });
                tds += "<td>" + val + "</td>";
              }
              /*  {
                tds += "<td>" + scenario[inKey] + "</td>";
              } */
            });
            // console.log("<tr>" + tds + "</tr>");
            me.tbody += "<tr>" + tds + "</tr>";
          });

          return;

          me.list.forEach((scenario) => {
            let tds = "";
            // const claves = [];
            //   claves.push(key);
            /*   Object.entries(scenario).forEach(([key, value]) => {
              if (key === "user") {
                console.log(value["name"]);
                tds += "<td>" + value["name"] + " " + "</td>";
              } else if (key === "name") {
                tds += "<td>" + value.name + "</td>";
              } else if (["is_married", "is_theactual"].includes(key)) {
                tds += "<td> MUST BE BOOL" + value + "</td>";
              } else if (
                !["id", "created_at", "updated_at", "body", "user_id"].includes(
                  key
                )
              ) {
                tds += "<td> ANOTHER" + value + "</td>";
              }
              console.log(key, value); // "a 5", "b 7", "c 9"
            });
            me.tbody += "<tr>" + tds + "</tr>"; */
            // const order = ["user", "name", "is_married", "is_theactual"];

            let aItds = "";
            /*  order.forEach((key) => {
              if (key === "user") {
                console.log({ user: scenario[key] });
                aItds +=
                  "<td>" +
                  scenario[key]["name"] +
                  " " +
                  scenario[key]["last_name"] +
                  " " +
                  "</td>";
              } else if (key === "name") {
                console.log({ name: scenario[key] });
                aItds += "<td>" + scenario[key] + "</td>";
              } else if (["is_married", "is_theactual"].includes(key)) {
                aItds += "<td>" + scenario[key] + "</td>";
              }  else if ("key" === "body") {

              }  else if (
                !["id", "created_at", "updated_at", "body", "user_id"].includes(
                  key
                )
              ) {
                aItds += "<td> ANOTHER" + scenario[key] + "</td>";
              }
            }); */

            /* const tr = "<tr>" + aItds + "</tr>";
            me.tbody += tr; */

            // console.log({ claves });

            Object.entries(scenario).forEach(([key, value]) => {
              if (key === "user") {
                console.log(value["name"]);
                aItds += "<td>" + value["name"] + " " + "</td>";
              } else if (key === "name") {
                aItds += "<td>" + value.name + "</td>";
              } else if (["is_married", "is_theactual"].includes(key)) {
                aItds += "<td>" + value + "</td>";
              } else if (
                !["id", "created_at", "updated_at", "body", "user_id"].includes(
                  key
                )
              ) {
                aItds += "<td>" + value + "</td>";
              } else if (key === "body") {
                for (const factorKey in value) {
                  if (value.hasOwnProperty(factorKey)) {
                    const factor = value[factorKey];
                    if (factor.hasOwnProperty("Edad")) {
                      aItds += "<td>" + factor["Edad"]["value"] + "</td>";
                    }
                    if (factor.hasOwnProperty("Educación")) {
                      aItds += "<td>" + factor["Educación"]["value"] + "</td>";
                    }
                  }
                }
              }
              console.log(key, value); // "a 5", "b 7", "c 9"
            });

            const tr = "<tr>" + aItds + "</tr>";
            me.tbody += tr;
          });

          console.log({ tbody: me.tbody });
          //   alert(theadTr2);

          /*    keys.forEach((key) => {
            me.thead = me.thead + "<th>" + key + "</th>";
            me.list.forEach((element) => {
              me.tbody =
                me.tbody + "<td>" + Object.keys(element["body"][key]) + "</td>";
            });
          }); */

          //   me.list.forEach((element) => {});

          //   console.log({ keys });

          //   me.thead = "";
          console.log(me.list);
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
