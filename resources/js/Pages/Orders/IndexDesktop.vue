<template>
    <card without-body>
        <div class="table-responsive">
            <table class="table table-vcenter table-hover text-nowrap card-table">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th width="40" v-if="showcasesCount > 0">Витрина</th>
                    <th>Сумма</th>
                    <th>Прибыль</th>
                    <th>Клиент</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    class="cursor-pointer"
                    v-for="order in orders.data"
                    @click="$inertia.visit(route('orders.show', order.id))"
                >
                    <td>{{order.id}}</td>
                    <td v-if="showcasesCount > 0">{{order.showcase?.name || '-'}}</td>
                    <td>{{numberFormat(order.amount, 2)}} сом.</td>
                    <td>{{numberFormat(order.profit, 2)}} сом.</td>
                    <td>{{order.client?.name || '-'}}</td>
                    <td :class="{'text-danger': order.status === 2, 'text-success': order.status === 1}">{{$page.props.shared.order.statuses[order.status]}}</td>
                    <td width="160">{{order.created_at_formatted}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <template #cardFooter v-if="orders.links.length > 3">
            <Pagination class="float-end" :links="orders.links"/>
        </template>
    </card>
</template>

<script>
import Card from "../../Shared/Card.vue";
import Pagination from "../../Shared/Pagination.vue";
import {numberFormat} from "../../functions";

export default {
    name: "OrdersIndexDesktop",
    methods: {numberFormat},
    props: ['orders', 'showcasesCount'],
    components: {Pagination, Card}
}
</script>
