<template>
    <div class="row">
        <div class="col-12">
            <div id="accordion" class="custom-accordion mb-4">
                <factor1-human-cap :maritialStatus="maritialStatus" />
                <factor2-hability-transfer :maritialStatus="maritialStatus" />
                <factor3-additional-points :maritialStatus="maritialStatus" />
                <factor4-spouse-attributes :maritialStatus="maritialStatus" />
            </div>
        </div>
    </div>
</template>
<script>
import Factor1HumanCap from "./accordions/Factor1HumanCap";
import Factor2HabilityTransfer from "./accordions/Factor2HabilityTransfer";
import Factor3AdditionalPoints from "./accordions/Factor3AdditionalPoints";
import Factor4SpouseAttributes from "./accordions/Factor4SpouseAttributes";

export default {
    props: ["maritialStatus"],
    components: {
        Factor1HumanCap,
        Factor2HabilityTransfer,
        Factor3AdditionalPoints,
        Factor4SpouseAttributes,
    },
};
</script>
