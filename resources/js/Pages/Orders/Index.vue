<template>
    <PageWrapper
        header-inline
        header-title="Продажи"
    >

        <template #headerActions>
            <Link :href="route('orders.create')" class="btn btn-primary btn-icon">
                <IconCirclePlus :size="18" stroke-width="1.7"/>
            </Link>
        </template>

        <OrderFiltersShort class="mb-3" />

        <card  card-body-class="px-3">
            <OrderItems :orders="orders.data" />

            <EmptyResult v-if="!orders.data.length" />

            <template #cardFooter v-if="orders.links.length > 3">
                <Pagination class="float-end" :links="orders.links"/>
            </template>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {IconCirclePlus} from "@tabler/icons-vue";
import OrderFilters from "./Filters.vue";
import OrderItems from "../../Shared/Mobile/OrderItems.vue";
import Pagination from "../../Shared/Pagination.vue";
import Card from "../../Shared/Card.vue";
import OrderFiltersShort from "./FiltersShort.vue";
import queryString from 'query-string';
import {size} from "lodash/collection";
import omit from "lodash/omit";
import EmptyResult from "../../Shared/EmptyResult.vue";

export default {
    components: {
        EmptyResult,
        OrderFiltersShort,
        Card,
        Pagination,
        OrderItems,
        OrderFilters,
        IconCirclePlus,
        PageWrapper,
        Link
    },
    props: ['orders', 'shared'],
    computed:{
        isFiltered() {
            return size(omit(queryString.parse(location.search))) > 0
        }
    }
}
</script>
