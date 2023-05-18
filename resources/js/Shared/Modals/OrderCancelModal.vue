<template>
    <BsModal
        ref="cancelModal"
        :title="`Отмена заказа №${order.id}`"
        with-btn
        btn-text="Отменить"
        btn-class="btn btn-danger"
    >
        <TextInput
            label="Причина отмены"
            label-required
            placeholder="Введите причину отмены"
            v-model="form.cancel_reason"
            @keydown.enter="submit"
            :invalid-text="form.errors.cancel_reason"
        />

        <template #footer="{hide}">
            <button @click="submit" :disabled="form.processing" class="btn btn-primary">
                Добавить
            </button>

            <button type="button" :disabled="form.processing" @click="hide" class="btn btn-link link-secondary ms-auto">
                Отменить
            </button>
        </template>
    </BsModal>
</template>

<script>
import TextInput from "../Form/TextInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import BsModal from "../BsModal.vue";

export default {
    name: "OrderCancelModal",
    components: {BsModal, TextInput},
    props: {
        order: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                cancel_reason: null
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('orders.cancel', this.order.id), {
                preserveState: true,
                preserveScroll: true
            })
        },
        show() {
            this.$refs.cancelModal.show();
        },
        hide() {
            this.$refs.cancelModal.hide();
        },
    }
}
</script>
