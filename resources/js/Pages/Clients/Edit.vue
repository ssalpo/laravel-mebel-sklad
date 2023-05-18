<template>
    <PageWrapper
        :header-title="!client?.id ? `Новый клиент` : `Редактирование ${client.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Имя"
                        label-required
                        placeholder="Введите имя клиента"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Телефон"
                        placeholder="Введите номер телефона"
                        v-model="form.phone"
                        :invalid-text="form.errors.phone"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{client?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('clients.index')" class="btn">Отменить</Link>
                    </div>
                </template>
            </card>
        </form>
    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import Card from "../../Shared/Card.vue";
import TextInput from "../../Shared/Form/TextInput.vue";
import {useForm, Link} from "@inertiajs/inertia-vue3";

export default {
    components: {TextInput, Card, PageWrapper, Link},
    props: ['client'],
    data() {
        return {
            form: useForm({
                name: this.client?.name,
                phone: this.client?.phone,
            })
        }
    },
    methods: {
        submit() {
            if (!this.client?.id) {
                this.form.post(route('clients.store'));
                return;
            }

            this.form.put(route('clients.update', this.client.id))
        }
    }
}
</script>
