<template>
    <PageWrapper
        :header-title="!unit?.id ? `Новая единицы измерения` : `Редактирование единицы измерения`"
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
                            {{unit?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('units.index')" class="btn">Отменить</Link>
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
    props: ['unit'],
    data() {
        return {
            form: useForm({
                name: this.unit?.name
            })
        }
    },
    methods: {
        submit() {
            if (!this.unit?.id) {
                this.form.post(route('units.store'));
                return;
            }

            this.form.put(route('units.update', this.unit.id))
        }
    }
}
</script>
