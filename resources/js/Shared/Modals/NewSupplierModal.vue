<template>
    <BsModal
        ref="modal"
        title="Новый поставщик"
        with-btn
        centered
        @hidden="form.reset()"
        @submit="submit"
    >
        <template #btn="{show}">
            <div class="mt-2">
                <button type="button" @click="show" class="btn btn-sm btn-link">
                    <IconCirclePlus :size="18" class="me-1" stroke-width="1"/>
                    Новый поставщик
                </button>
            </div>
        </template>

        <TextInput
            label="Имя поставщика"
            label-required
            placeholder="Введите имя"
            v-model="form.name"
            :invalid-text="form.errors.get('name')"
        />

        <template #footer="{hide}">
            <button class="btn btn-primary" :disabled="form.busy">
                Добавить
            </button>

            <button type="button" @click="hide" class="btn btn-link link-secondary ms-auto">
                Отменить
            </button>
        </template>
    </BsModal>
</template>

<script>
import TextInput from "../Form/TextInput.vue";
import Form from 'vform'
import {useToast} from "vue-toastification";
import BsModal from "../BsModal.vue";
import {IconCirclePlus} from "@tabler/icons-vue";

export default {
    emits: ['success'],
    name: "NewSupplierModal",
    components: {IconCirclePlus, BsModal, TextInput},
    data() {
        return {
            form: new Form({
                name: null
            })
        }
    },
    methods: {
        async submit() {
            try {
                const {data} = await this.form.post(route('suppliers.store', {modal: 1}))

                this.$emit('success', data)

                this.form.reset()

                this.$refs.modal.hide()

                useToast().success('Поставщик успешно добавлен.')
            } catch (e) {
                useToast().error('Ошибка добавления нового поставщика.')
            }
        }
    }
}
</script>
