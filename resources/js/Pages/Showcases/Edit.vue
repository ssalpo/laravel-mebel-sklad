<template>
    <PageWrapper
        :header-title="!showcase?.id ? `Новая витрина` : `Редактирование ${showcase.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3">
                    <TextInput
                        label="Название витрины"
                        label-required
                        placeholder="Введите название витрины"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{showcase?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('showcases.index')" class="btn">Отменить</Link>
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
    props: ['showcase'],
    data() {
        return {
            form: useForm({
                name: this.showcase?.name
            })
        }
    },
    methods: {
        submit() {
            if (!this.showcase?.id) {
                this.form.post(route('showcases.store'));
                return;
            }

            this.form.put(route('showcases.update', this.showcase.id))
        }
    }
}
</script>
