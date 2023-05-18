<template>
    <BsModal ref="paymentModal"
             @hidden="() => form.reset().clearErrors()"
             :title="`Погашение по долгу №${debt?.id}`"
             @submit="submit"
             v-bind="$attrs">

        <TextInput
            label="Сумма погашения"
            label-required
            placeholder="Введите сумму"
            v-model="form.amount"
            :invalid-text="form.errors.amount"
        />

        <template #footer="{hide}">
            <button :disabled="form.processing" class="btn btn-primary">
                Добавить
            </button>

            <button type="button" :disabled="form.processing" @click="hide" class="btn btn-link link-secondary ms-auto">
                Отменить
            </button>
        </template>
    </BsModal>
</template>

<script>
import TextInput from "./TextInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import BsModal from "../BsModal.vue";

export default {
    name: "DebtPaymentModal",
    props: ['debt'],
    components: {BsModal, TextInput},
    data() {
        return {
            form: useForm({
                amount: null
            })
        }
    },
    methods: {
        submit() {
            let vm = this;

            this.form
                .post(route('debts.payments.store', this.debt.id), {
                    onSuccess() {
                        vm.$emit('close')
                        vm.form.reset().clearErrors();

                        vm.$refs.paymentModal.hide()
                    },
                    preserveScroll: true,
                    preserveState: true
                })
        },
        show() {
            this.$refs.paymentModal.show()
        }
    }
}
</script>
