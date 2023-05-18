<template>
    <PageWrapper
        :header-title="!nomenclature?.id ? `Новый товар` : `Редактирование ${nomenclature.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Название"
                        label-required
                        placeholder="Введите название товара"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Себестоимость"
                        label-required
                        placeholder="Введите сумму себестоимости"
                        v-model="form.base_price"
                        :invalid-text="form.errors.base_price"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Цена продажи"
                        label-required
                        placeholder="Введите цену продажи"
                        v-model="form.price_for_sale"
                        :invalid-text="form.errors.price_for_sale"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{nomenclature?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('nomenclatures.index')" class="btn">Отменить</Link>
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
import SelectNomenclatures from "../../Shared/Form/SelectNomenclatures.vue";

export default {
    components: {SelectNomenclatures, TextInput, Card, PageWrapper, Link},
    props: ['nomenclature'],
    data() {
        return {
            form: useForm({
                name: this.nomenclature?.name,
                base_price: this.nomenclature?.base_price,
                price_for_sale: this.nomenclature?.price_for_sale,
            })
        }
    },
    methods: {
        submit() {
            if (!this.nomenclature?.id) {
                this.form.post(route('nomenclatures.store'));
                return;
            }

            this.form.put(route('nomenclatures.update', this.nomenclature.id))
        }
    }
}
</script>
