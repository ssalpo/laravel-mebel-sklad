<template>
    <fieldset class="form-fieldset">
        <div class="row">
            <div class="col-10">
                <SelectNomenclatures
                    v-model="orderItem.nomenclature_id"
                    :disabled-values="selectedNomenclatures"
                    without-invalid-text
                    :options="nomenclatures"
                    :prefetch="false"
                    :remote="false"
                    :invalidText="formData.errors['orderItems.' + currentIndex + '.nomenclature_id']"
                />
            </div>
            <div class="col-2">
                <BarcodeScannerModal
                    @detected="onDetectBarCode"
                />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-4">
                <NumericField
                    only-integer
                    placeholder="Кол-во"
                    :class="{'is-invalid': formData.errors['orderItems.' + currentIndex + '.quantity']}"
                    v-model="orderItem.quantity"
                />
            </div>

            <div class="col-6">
                <numeric-field
                    :precision="2"
                    placeholder="Сумма"
                    :class="{'is-invalid': formData.errors['orderItems.' + currentIndex + '.price_for_sale']}"
                    v-model="orderItem.price_for_sale"/>
            </div>

            <div class="col-2">
                <button type="button" class="btn btn-danger btn-icon"
                        @click="$emit('removeItem', currentIndex)">
                    <IconTrash :size="18" stroke-width="1.5"/>
                </button>
            </div>
        </div>

        <div v-if="formData.errors['orderItems.' + currentIndex + '.nomenclature_id'] || formData.errors['orderItems.' + currentIndex + '.quantity']">
            <div class="error invalid-feedback mt-2" style="display: block !important;">
                Заполните все поля корректно
            </div>
        </div>
    </fieldset>
</template>

<script>
import NumericField from "./NumericField.vue";
import {IconTrash, IconScan} from "@tabler/icons-vue";
import SelectNomenclatures from "./SelectNomenclatures.vue";
import find from "lodash/find";
import BarcodeScannerModal from "../Modals/BarcodeScannerModal.vue";

export default {
    name: "OrderNomenclatures",
    emits: ['removeItem'],
    components: {BarcodeScannerModal, SelectNomenclatures, IconTrash, IconScan, NumericField},
    props: {
        currentIndex: Number,
        formData: {
            type: Object,
            required: true
        },
        orderItem: {
            type: Object,
            required: true
        },
        nomenclatures: {
            type: Array,
            required: true
        },
        selectedNomenclatures: {
            type: Array,
            default: []
        }
    },
    watch: {
        ['orderItem.nomenclature_id']: function (id) {
            this.orderItem.price_for_sale = find(this.nomenclatures, {id}).price_for_sale
        }
    },
    methods: {
        onDetectBarCode(code) {
            let nomenclature = find(this.nomenclatures, {'barcode': parseInt(code)})

            if(nomenclature?.id && this.selectedNomenclatures.includes(nomenclature?.id)) return

            this.orderItem.nomenclature_id = parseInt(nomenclature?.id)
        }
    }
}
</script>
