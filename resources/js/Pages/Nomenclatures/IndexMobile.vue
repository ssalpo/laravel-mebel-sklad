<template>
    <card>
        <EmptyResult v-if="!nomenclatures.data.length" />

        <NomenclatureItems
            v-else
            :items="nomenclatures.data"
        />

        <template #cardFooter v-if="nomenclatures.links.length > 3">
            <Pagination class="float-end" :links="nomenclatures.links"/>
        </template>
    </card>
</template>

<script>
import NomenclatureItems from "../../Shared/Mobile/NomenclatureItems.vue";
import Card from "../../Shared/Card.vue";
import Pagination from "../../Shared/Pagination.vue";
import EmptyResult from "../../Shared/EmptyResult.vue";

export default {
    name: "NomenclaturesIndexMobile",
    components: {EmptyResult, Pagination, Card, NomenclatureItems},
    props: ['nomenclatures']
}
</script>
