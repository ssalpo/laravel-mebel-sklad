<template>
    <PageWrapper
        :back-url="route('debts.index')"
        :header-title="`Погашения по долгу №${debtId}`"
    >

        <card without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Сумма</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in payments.data">
                        <td>{{ numberFormat(payment.amount, 2) }}</td>
                        <td class="text-muted">
                            {{ payment.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <delete-btn
                                :url="route('debts.payments.destroy', {debt: debtId, payment: payment.id})"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="payments.links.length > 3">
                <Pagination class="float-end" :links="payments.links"/>
            </template>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {numberFormat} from "../../functions";
import Pagination from "../../Shared/Pagination.vue";

export default {
    methods: {numberFormat},
    components: {Pagination, DeleteBtn, Card, PageWrapper, Link},
    props: ['debtId', 'payments']
}
</script>
