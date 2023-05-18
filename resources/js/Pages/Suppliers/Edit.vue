<template>
    <PageWrapper
        :header-title="!supplier?.id ? `Новый поставщик` : `Редактирование ${supplier.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3">
                    <TextInput
                        label="Название поставщика"
                        label-required
                        placeholder="Введите название поставщика"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{supplier?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('suppliers.index')" class="btn">Отменить</Link>
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
    props: ['supplier'],
    data() {
        return {
            form: useForm({
                name: this.supplier?.name
            })
        }
    },
    methods: {
        submit() {
            if (!this.supplier?.id) {
                this.form.post(route('suppliers.store'));
                return;
            }

            this.form.put(route('suppliers.update', this.supplier.id))
        }
    }
}
</script>
