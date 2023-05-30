<template>
    <PageWrapper
        header-title="Приход"
        header-pre-title="В списке отображается все приходы по товарам"
    >

        <template #headerActions>
            <Link :href="route('nomenclature-arrivals.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7"/>
                Новый приход
            </Link>
        </template>

        <NomenclatureArrivalFilters class="mb-3"/>

        <card>
            <EmptyResult v-if="!nomenclatureArrivals.data.length"/>

            <NomenclatureOperationItems
                :items="items"
            />

            <template #cardFooter v-if="nomenclatureArrivals.links.length > 3">
                <Pagination class="float-end" :links="nomenclatureArrivals.links"/>
            </template>
        </card>
    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from "../../Shared/Pagination.vue";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {IconCirclePlus} from "@tabler/icons-vue";
import NomenclatureItems from "../../Shared/Mobile/NomenclatureItems.vue";
import Card from "../../Shared/Card.vue";
import EmptyResult from "../../Shared/EmptyResult.vue";
import NomenclatureOperationItems from "../../Shared/Mobile/NomenclatureOperationItems.vue";
import NomenclatureArrivalFilters from "./Filters.vue";

export default {
    components: {
        NomenclatureArrivalFilters,
        NomenclatureOperationItems,
        EmptyResult,
        Card,
        Pagination,
        NomenclatureItems,
        IconCirclePlus,
        EditLinkBtn,
        PageWrapper,
        Link
    },
    props: ['nomenclatureArrivals'],
    computed: {
        items() {
            return this.nomenclatureArrivals.data.map(item => ({
                id: item.id,
                title: item.nomenclature.name,
                quantity: item.quantity,
                unit: item.nomenclature.unit,
                date: item.created_at_formatted
            }))
        }
    }
}
</script>
