<template>
    <card>
        <EmptyResult v-if="!balances.length"/>

        <NomenclatureArrivalItems
            v-else
            :items="balances"
        />
    </card>
</template>

<script>
import NomenclatureArrivalItems from "../../Shared/Mobile/NomenclatureArrivalItems.vue";
import Card from "../../Shared/Card.vue";
import EmptyResult from "../../Shared/EmptyResult.vue";
import StorehouseBalanceFilters from "./Filters.vue";

export default {
    name: "StorehouseBalanceIndexMobile",
    components: {StorehouseBalanceFilters, EmptyResult, Card, NomenclatureArrivalItems},
    props: ['balances']
}
</script>
