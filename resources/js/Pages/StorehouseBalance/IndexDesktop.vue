<template>
    <card without-body>
        <EmptyResult v-if="!balances.length"/>

        <div class="table-responsive" v-else>
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Товар</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="balance in balances">
                    <td>{{ balance.nomenclature.name }}</td>
                    <td>{{ numberFormat(balance.quantity) }}</td>
                    <td>{{ numberFormat(balance.quantity * balance.nomenclature.base_price) }} c.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </card>
</template>

<script>
import Card from "../../Shared/Card.vue";
import {numberFormat} from "../../functions";
import EmptyResult from "../../Shared/EmptyResult.vue";
import StorehouseBalanceFilters from "./Filters.vue";

export default {
    name: "StorehouseBalanceIndexDesktop",
    methods: {numberFormat},
    components: {StorehouseBalanceFilters, EmptyResult, Card},
    props: ['balances']
}
</script>
