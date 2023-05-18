<template>
    <PageWrapper
        header-inline
        :header-title="`Приход №${nomenclatureArrival.id}`"
        :back-url="route('nomenclature-arrivals.index')"
    >
        <template #headerActions>
            <EditLinkBtn
                :url="route('nomenclature-arrivals.edit', nomenclatureArrival.id)"
            />

            <DeleteBtn
                :url="route('nomenclature-arrivals.destroy', nomenclatureArrival.id)"
            />
        </template>

        <card class="mb-3" without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <tbody>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Товар</td>
                        <td>{{ nomenclatureArrival.nomenclature.name }}</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Кол-во</td>
                        <td>{{ nomenclatureArrival.quantity }}</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Себестоимость</td>
                        <td>{{ numberFormat(nomenclatureArrival.base_price, 2) }} сом.</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Цена продажи</td>
                        <td>{{ numberFormat(nomenclatureArrival.price_for_sale, 2) }} сом.</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Дата прихода</td>
                        <td>{{ nomenclatureArrival.arrival_at_formatted }}</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Дата создания</td>
                        <td>{{ nomenclatureArrival.created_at_formatted }}</td>
                    </tr>
                    <tr>
                        <td width="150" class="text-start text-sm-end fw-bold">Комментарий</td>
                        <td>{{ nomenclatureArrival.comment || '-' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </card>
    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import {numberFormat} from "../../functions";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";

export default {
    components: {DeleteBtn, EditLinkBtn, Card, PageWrapper, Link},
    props: ['nomenclatureArrival', 'suppliersCount'],
    methods: {
        numberFormat
    }
}
</script>
