<template>
    <card without-body>
        <div class="table-responsive">
            <table class="table table-vcenter text-nowrap card-table">
                <thead>
                <tr>
                    <th width="40">ID</th>
                    <th>Сумма долга</th>
                    <th>Остаток долга</th>
                    <th>Статус</th>
                    <th>Клиент</th>
                    <th>Комментарий</th>
                    <th>Дата создания</th>
                    <th></th>
                    <th width="120"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="debt in debts.data">
                    <td>{{ debt.id }}</td>
                    <td>{{ numberFormat(debt.amount, 2) }} сом.</td>
                    <td class="text-danger">{{ numberFormat(debt.amount - debt.payments_sum_amount, 2) }} сом.</td>
                    <td :class="{'text-success': debt.is_paid, 'text-danger': !debt.is_paid}">{{debt.is_paid ? 'Оплачено' : 'Не оплачено'}}</td>
                    <td>{{ debt.client?.name || '-' }}</td>
                    <td>{{ debt.comment }}</td>
                    <td class="text-muted">{{ debt.created_at_formatted }}</td>
                    <td>
                        <Link :href="route('debts.payments.index', debt.id)" class="btn btn-outline-info btn-sm me-2" >История погашений</Link>
                        <button class="btn btn-outline-success btn-sm" v-if="!debt.is_paid" @click="$emit('debtSelect', debt)">Погасить долг</button>
                    </td>
                    <td class="text-end">
                        <EditLinkBtn
                            :url="route('debts.edit', debt.id)"
                            class="me-2"
                        />

                        <DeleteBtn
                            :url="route('debts.destroy', debt.id)"
                        />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <template #cardFooter v-if="debts.links.length > 3">
            <Pagination class="float-end" :links="debts.links"/>
        </template>
    </card>
</template>

<script>
import Card from "../../Shared/Card.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from "../../Shared/Pagination.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {numberFormat} from "../../functions";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";

export default {
    emits: ['debtSelect'],
    name: "IndexTable",
    props: ['debts'],
    methods: {numberFormat},
    components: {EditLinkBtn, DeleteBtn, Pagination, Link, Card}
}
</script>

<style scoped>

</style>
