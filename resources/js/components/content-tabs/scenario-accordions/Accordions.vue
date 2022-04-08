<template>
    <div class="row">
        <div class="col-12">
            <div id="accordion" class="custom-accordion mb-4">
                <factor1-human-cap :maritialStatus="maritialStatus" />
                <!-- <factor2-hability-transfer :maritialStatus="maritialStatus" /> -->
            </div>
        </div>
    </div>
</template>
<script>
import Factor1HumanCap from "./accordions/Factor1HumanCap";
import Factor2HabilityTransfer from "./accordions/Factor2HabilityTransfer";

export default {
    props: ["maritialStatus"],
    components: {
        Factor1HumanCap,
        Factor2HabilityTransfer,
    },
};
</script>
