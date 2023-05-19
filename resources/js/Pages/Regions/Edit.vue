<template>
    <PageWrapper
        :header-title="!region?.id ? `Новый регион` : `Редактирование ${region.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3">
                    <TextInput
                        label="Название"
                        label-required
                        placeholder="Введите название"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{region?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('regions.index')" class="btn">Отменить</Link>
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
    props: ['region'],
    data() {
        return {
            form: useForm({
                name: this.region?.name
            })
        }
    },
    methods: {
        submit() {
            if (!this.region?.id) {
                this.form.post(route('regions.store'));
                return;
            }

            this.form.put(route('regions.update', this.region.id))
        }
    }
}
</script>
