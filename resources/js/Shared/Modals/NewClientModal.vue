<template>
    <BsModal
        ref="modal"
        title="Новый клиент"
        with-btn
        centered
        @hidden="form.reset()"
        @submit="submit"
    >
        <template #btn="{show}">
            <div class="mt-2">
                <button type="button" @click="show" class="btn btn-sm btn-link">
                    <IconCirclePlus :size="18" class="me-1" stroke-width="1" />
                    Новый клиент
                </button>
            </div>
        </template>

        <div class="mb-3">
            <TextInput
                label="Имя"
                label-required
                placeholder="Введите имя"
                v-model="form.name"
                :invalid-text="form.errors.get('name')"
            />
        </div>

        <TextInput
            label="Телефон"
            placeholder="Введите номер телефона"
            v-model="form.phone"
            :invalid-text="form.errors.get('phone')"
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
    name: "NewClientModal",
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
                const {data} = await this.form.post(route('clients.store', {modal: 1}))

                this.$emit('success', data)

                this.form.reset()

                this.$refs.modal.hide()

                useToast().success('Клиент успешно добавлен.')
            } catch (e) {
                useToast().error('Ошибка добавления нового клиента.')
            }
        }
    }
}
</script>
