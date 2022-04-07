<template>
    <div class="row">
        <div class="col-12">
            <div id="accordion" class="custom-accordion mb-4">
                <Factor1HumanCap />
                <Factor2HabilityTransfer />
            </div>
        </div>
    </div>
</template>
<script>
// alert(this.maritialStatus);
import Factor1HumanCap from "./accordions/Factor1HumanCap.vue";
import Factor2HabilityTransfer from "./accordions/Factor2HabilityTransfer.vue";

import SituationA from "../SituationA";
export default {
    props: { maritialStatus: String },
    components: {
        Factor1HumanCap,
        Factor2HabilityTransfer,
    },
};
</script>
