<template>
    <BsModal
        ref="barcodeModal"
        title="Присвоение штрихкода"
        with-btn
        centered
        @hidden="form.reset().clearErrors()"
        @submit="submit"
    >
        <template #btn="{show}">
            <button type="button" @click="show" class="btn btn-icon btn-outline-primary" :class="[btnSize]">
                <IconScan :size="18" stroke-width="2" :class="{'me-1': btnText}"/>

                {{ btnText }}
            </button>
        </template>

        <div class="row">
            <div class="col-9">
                <NumericField
                    placeholder="Введите номер штрихкода"
                    v-model="form.code"
                    :invalid-text="form.errors.code"
                />
            </div>
            <div class="col-3">
                <BarcodeScannerModal
                    @detected="form.code = parseInt($event)"
                />
            </div>
        </div>

        <template #footer="{hide}">
            <button class="btn btn-primary" :disabled="form.processing">
                Сохранить
            </button>

            <button type="button" :disabled="form.processing" @click="hide" class="btn btn-link link-secondary ms-auto">
                Отменить
            </button>
        </template>
    </BsModal>
</template>

<script>
import TextInput from "../Form/TextInput.vue";
import BsModal from "../BsModal.vue";
import {IconScan} from "@tabler/icons-vue";
import {useForm} from "@inertiajs/inertia-vue3";
import NumericField from "../Form/NumericField.vue";
import BarcodeScannerModal from "./BarcodeScannerModal.vue";

export default {
    inheritAttrs: false,
    name: "NomenclatureBarcodeChangeModal",
    components: {BarcodeScannerModal, NumericField, IconScan, BsModal, TextInput},
    props: {
        btnSize: {
            type: String,
            default: 'btn-sm'
        },
        btnText: String,
        nomenclature: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                code: this.nomenclature?.barcode
            })
        }
    },
    methods: {
        submit() {
            let vm = this;

            this.form.post(route('nomenclatures-nomenclature.change-barcode', this.nomenclature.id), {
                onSuccess() {
                    vm.$refs.barcodeModal.hide();
                }
            })
        }
    }
}
</script>
