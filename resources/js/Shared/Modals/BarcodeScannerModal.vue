<template>
    <BsModal
        ref="scannerModal"
        @show="initCodeReader = true"
        @hidden="initCodeReader = false"
        with-btn centered
        title="Сканер"
    >
        <template #btn="{show}">
            <button type="button" @click="show" class="btn btn-outline-primary btn-icon" :class="[btnClass]">
                <IconScan :size="iconSize" stroke-width="1.5"/>

                <span v-if="iconText" class="ms-1">Сканер</span>
            </button>
        </template>

        <BarcodeReader
            :visible="initCodeReader"
            @detected="onDetect"
        />
    </BsModal>
</template>

<script>
import BsModal from "../BsModal.vue";
import BarcodeReader from "../BarcodeReader.vue";
import {IconScan} from "@tabler/icons-vue";

export default {
    emits: ['detected'],
    name: "BarcodeScannerModal",
    components: {IconScan, BarcodeReader, BsModal},
    props: {
        btnClass: String,
        iconText: {
            type: Boolean,
            default: false
        },
        iconSize: {
            type: Number,
            default: 18
        }
    },
    data() {
        return {
            initCodeReader: false
        }
    },
    methods: {
        onDetect(code) {
            this.$emit('detected', code);
            this.$refs.scannerModal.hide();
            this.initCodeReader = false;
        }
    }
}
</script>

<style scoped>

</style>
