<template>
    <PageWrapper
        :header-title="headerTitle"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <SelectNomenclatures
                        label="Товар"
                        label-required
                        v-model="form.nomenclature_id"
                        :invalidText="form.errors.nomenclature_id"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <NumericField
                        v-model="form.quantity"
                        label="Кол-во"
                        label-required
                        :invalid-text="form.errors.quantity"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Комментарий"
                        placeholder="Введите комментарий"
                        v-model="form.comment"
                        :invalid-text="form.errors.comment"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{ nomenclatureOperation?.id ? 'Изменить' : 'Добавить' }}
                        </button>
                        <Link :disabled="form.processing" :href="route('nomenclature-operations.index')" class="btn">
                            Отменить
                        </Link>
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
import NumericField from "../../Shared/Form/NumericField.vue";
import SelectNomenclatures from "../../Shared/Form/SelectNomenclatures.vue";
import {queryParams} from "../../functions";

export default {
    components: {
        PageWrapper,
        SelectNomenclatures,
        NumericField,
        TextInput,
        Card,
        Link
    },
    props: ['nomenclatureOperation'],
    data() {
        return {
            form: useForm({
                type: this.nomenclatureOperation?.type,
                nomenclature_id: this.nomenclatureOperation?.nomenclature_id,
                quantity: this.nomenclatureOperation?.quantity,
                comment: this.nomenclatureOperation?.comment,
            })
        }
    },
    created() {
        if(!this.nomenclatureOperation?.id) {
            this.form.type = parseInt(queryParams('type')) || undefined;
        }
    },
    methods: {
        submit() {
            if (!this.nomenclatureOperation?.id) {
                this.form.post(route('nomenclature-operations.store'));
                return;
            }

            this.form.put(route('nomenclature-operations.update', this.nomenclatureOperation.id))
        }
    },
    computed: {
        headerTitle() {
            let editTypeLabels = {
                1: 'Списание товаров',
                2: 'Возврат товаров'
            }

            return !this.nomenclatureOperation?.id
                ? editTypeLabels[this.form.type] || ''
                : 'Редактирование'
        }
    }
}
</script>
