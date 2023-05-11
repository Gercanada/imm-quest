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
          <tbody></tbody>
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
          let name = me.list[0]["name"];
          let keys = Object.keys(me.list[0].body);

          let theadTr1 = "";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Name</th>";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Username</th>";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Married</th>";
          theadTr1 = theadTr1 + "<th rowspan='2' colspan='1'>Is actual</th>";

          let theadTr2 = "";

          /*           let str1 = "hello";
                let str2 = "world";

                if (!str2.includes(str1)) {
                str2 += " " + str1;
                } */

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
          console.log(me.thead);

          //   alert(theadTr2);

          /*    keys.forEach((key) => {
            me.thead = me.thead + "<th>" + key + "</th>";
            me.list.forEach((element) => {
              me.tbody =
                me.tbody + "<td>" + Object.keys(element["body"][key]) + "</td>";
            });
          }); */

          //   me.list.forEach((element) => {});

          console.log({ keys });

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
