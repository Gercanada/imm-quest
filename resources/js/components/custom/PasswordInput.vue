<template>
  <div class="input-group">
    <input :type="show == 1 ? 'text' : 'password'" id="password" />
    <!-- <button @click="switchVisibility"><i class="fas fa-eye-open"></i></button> -->

    <!--  <input name="sex" type="radio" value="1" :v-model="show" @change="showHide" /><br />
    <input name="sex" type="radio" value="0" :v-model="show" /> -->
    <input
      id="showHide"
      v-model="show"
      true-value="1"
      false-value="0"
      type="checkbox"
      @change="showHide($event)"
      data-toggle="tooltip"
      title="Select themme layout"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: false,
    };
  },
  methods: {
    showHide(event) {
      var data = event.target.value;
      console.log(this.show);
      if (this.show == 1) {
        this.show = 0;
      }

      if (this.show == 0) {
        this.show = 1;
      }

      /*  else {
        this.show = 1;
      } */

      //   console.log(data ===1?true:false);
      //   this.show = e === 1 ? 1 : 0;
    },
  },
};
</script>
