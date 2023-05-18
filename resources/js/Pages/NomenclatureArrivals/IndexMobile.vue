<template>
    <card>
        <NomenclatureItems
            :items="items"
        />

        <template #cardFooter v-if="nomenclatureArrivals.links.length > 3">
            <Pagination class="float-end" :links="nomenclatureArrivals.links"/>
        </template>
    </card>
</template>

<script>
import NomenclatureItems from "../../Shared/Mobile/NomenclatureItems.vue";
import Card from "../../Shared/Card.vue";
import Pagination from "../../Shared/Pagination.vue";

export default {
    name: "NomenclatureArrivalsIndexMobile",
    components: {Pagination, Card, NomenclatureItems},
    props: {
        nomenclatureArrivals: {
            type: Array,
            required: true
        }
    },
    computed: {
        items() {
            return this.nomenclatureArrivals.data.map(item => ({
                id: item.id,
                title: item.nomenclature.name,
                quantity: item.quantity,
                date: item.arrival_at_formatted
            }))
        }
    }
}
</script>
