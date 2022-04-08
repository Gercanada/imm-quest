<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div
                            class="form-check form-check-inline"
                            id="maritial-status"
                        >
                            <input
                                class="form-check-input material-inputs"
                                type="radio"
                                name="matrialStatus"
                                id="isSingle"
                                value="Single"
                                checked
                                @change="changeStatus('Single')"
                            />
                            <label class="form-check-label" for="isSingle"
                                >Soltero</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input material-inputs"
                                type="radio"
                                name="matrialStatus"
                                id="isMarried"
                                value="Married"
                                @change="changeStatus('Married')"
                            />
                            <label class="form-check-label" for="isMarried"
                                >Casado</label
                            >
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                </div>
                <accordions :maritialStatus="maritialStatus" />
            </div>
        </div>
    </div>
</template>

<script>
import Accordions from "./scenario-accordions/Accordions.vue";
// import Factor1HumanCap from "./scenario-accordions/accordions/Factor1HumanCap.vue";

export default {
    components: {
        // Factor1HumanCap,
        Accordions,
    },
    data() {
        return {
            maritialStatus: "single",
        };
    },
    mounted() {
        // console.log(this.maritialStatus);
    },
    methods: {
        changeStatus(value) {
            // console.log(value);
            this.maritialStatus = value;
        },
    },
};
</script>
