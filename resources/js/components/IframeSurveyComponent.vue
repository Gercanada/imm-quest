<template>
  <div v-if="loading" width="100%" height="100%">
    <div class="card shadow p-1 rounded">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only" style="">Loading...</span>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="card shadow p-1 rounded" style="border: solid 2px green">
    <!--  <div class="row"> -->
    <iframe id="surveyframe" :src="clitem.cf_1212" width="100%" height="100%">
      <!--  @load="getFrame()" -->
    </iframe>
    <!-- <div class="row"> -->
    <div class="col-md-12">
      <button
        v-if="submitdate != null"
        class="btn btn-outline-danger btn-rounded"
      >
        <i class="fas fa-plane"></i>
      </button>
      <button v-else class="btn btn-outline-success btn-rounded">
        <i class="fas fa-plane"></i>
      </button>
      <!-- </div> -->
      <!-- </div> -->
    </div>
  </div>
</template>
<script>
const urlParams = window.location.pathname.split("/");
//console.log(urlParams);

export default {
  data() {
    return {
      clitem: "",
      item_id: urlParams[4],
      survey: null,
      loading: false,
      submitdate: null,
    };
  },
  mounted() {
    this.loadIframe();
  },
  methods: {
    loadIframe() {
      let me = this;
      me.loading = true;
      //setTimeout(() => {
      if (me.item_id != null) {
        axios
          .get("/survey/cl_item/" + me.item_id)
          .then(function (response) {
            console.log(response.data);
            me.clitem = response.data[0];
            me.survey = response.data[1][0];
            //console.log(response.data[1][0]);
            console.log(response.data[1][0].submitdate);
            if (
              response.data[1][0].submitdate != "" ||
              response.data[1][0].submitdate != null
            ) {
              me.submitdate = response.data[1][0].submitdate;
            }
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => (me.loading = false));
      }
      //}, 1000);
    },
    getFrame() {
      const frame = document.getElementById("surveyframe");
      frame.contentWindow.postMessage(this.clitem.cf_1212, "*");

      /* function getMeta(url, callback) {
        var img = document.getElementsByTagName(body);
        img.src = url;
        img.onload = function () {
          callback(this.width, this.height);
        };
      }

      getMeta(this.clitem.cf_1212, function (width, height) {
        alert(width + "px " + height + "px");
      });
 */
      //console.log(frame.contentWindow.document.body.scrollHeight + 'px');

      //setTimeout(() => {
      // const myFrame = document.getElementById("surveyframe");
      //alert(the_height.contentWindow.document.body.scrollHeight + "px");
      /* console.log("here"); */
      //console.log(the_height.contentWindow.document.body.scrollHeight + "px");

      /*  console.log(
        myFrame.frame.contentWindow.postMessage("*", this.clitem.cf_1212)
      ); */
      //}, 1000);
    },
  },
};
</script>
