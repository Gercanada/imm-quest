<template>
  <div class="card">
    <div class="card-body">
      <div class="row pb-3 mb-2"></div>
      <div class="bootstrap-table">
        <table
          data-toggle="table"
          data-mobile-responsive="true"
          class="table-striped table table-hover table-bordered"
          data-sort-order="default"
        >
          <thead>
            <tr>
              <th>Name</th>
              <th>User name</th>
              <th>Factors</th>
            <!--   <th
                v-for="scKey in Object.keys(scenario['body'])"
                :key="scKey"
                colspan="2"
              >
                {{ scKey }}
              </th> -->

              <th v-for="scKey in Object.keys(scenario['body'])" :key="scKey">
                <p
                  v-for="aKey in Object.keys(scenario['body'][scKey])"
                  :key="aKey"
                >
                  <th>{{ aKey }}</th>
                  <th>
                    {{ scenario["body"][scKey][aKey]["criterion"] }} |
                    {{ scenario["body"][scKey][aKey]["value"] }}
                  </th>

              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(scenario, key) in list" :key="key">
              <td>{{ scenario["name"] }}</td>
              <td>
                {{
                  scenario["user"]["name"] + " " + scenario["user"]["last_name"]
                }}
              </td>
              <td v-for="scKey in Object.keys(scenario['body'])" :key="scKey">
                <tr
                  v-for="aKey in Object.keys(scenario['body'][scKey])"
                  :key="aKey"
                >
                  <td>{{ scKey }} | {{ aKey }}</td>
                  <td>
                    {{ scenario["body"][scKey][aKey]["criterion"] }} |
                    {{ scenario["body"][scKey][aKey]["value"] }}
                  </td>
                </tr>
              </td>
            </tr>

            <!--  <tr v-for="key in Object.keys(scenario['body'])">
              <td>
                {{ key }}
              </td>
            </tr> -->
            <!-- <th>{{ Object.keys(scenario["body"][key]) }}</th> -->

            <!--    <td v-for="key in Object.keys(scenario['body'])">{{ key }}</td>
            </tr> -->
          </tbody>
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

          me.thead = me.thead + "<th>Name</th>";
          me.thead = me.thead + "<th>Username</th>";
          me.thead = me.thead + "<th>Married</th>";
          me.thead = me.thead + "<th>Is actual</th>";

          keys.forEach((key) => {
            me.thead = me.thead + "<th>" + key + "</th>";
            // alert(me.list);
            me.list.forEach((element) => {
              me.tbody =
                me.tbody + "<td>" + Object.keys(element["body"][key]) + "</td>";
            });
          });

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
