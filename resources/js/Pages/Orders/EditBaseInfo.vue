<template>
    <PageWrapper
        :header-title="`Редактирование заказа №${order.id}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Имя клиента"
                        label-required
                        placeholder="Введите имя клиента"
                        v-model="form.client_name"
                        :invalid-text="form.errors.client_name"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Номер телефона"
                        label-required
                        placeholder="Номер телефона"
                        v-model="form.phone_number"
                        :invalid-text="form.errors.phone_number"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Адрес доставки"
                        label-required
                        placeholder="Введите адрес доставки"
                        v-model="form.address"
                        :invalid-text="form.errors.address"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <SelectRegions
                        ref="selectRegions"
                        label="Регион"
                        label-required
                        v-model="form.region_id"
                        :invalid-text="form.errors.region_id"
                    />

                    <NewRegionModal @success="refreshRegions"/>
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Сумма взноса"
                        placeholder="Введите сумму взноса"
                        v-model="form.deposit_amount"
                        :invalid-text="form.errors.deposit_amount"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            Изменить
                        </button>
                        <Link :disabled="form.processing" :href="route('orders.show', order.id)" class="btn">Отменить</Link>
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
import SelectRegions from "../../Shared/Form/SelectRegions.vue";
import NewRegionModal from "../../Shared/Modals/NewRegionModal.vue";

export default {
    components: {NewRegionModal, SelectRegions, TextInput, Card, PageWrapper, Link},
    props: ['order'],
    data() {
        return {
            form: useForm({
                client_name: this.order?.client_name,
                phone_number: this.order?.phone_number,
                address: this.order?.address,
                region_id: this.order?.region_id,
                deposit_amount: this.order?.deposit_amount,
            })
        }
    },
    methods: {
        submit() {
            this.form.put(route('orders.update_base_info', this.order.id))
        },
        refreshRegions(region) {
            this.$refs.selectRegions.refreshData()

            this.form.region_id = parseInt(region.id)

            this.form.clearErrors()
        }
    }
}
</script>
