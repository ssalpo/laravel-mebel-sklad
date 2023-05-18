<template>
    <PageWrapper
        header-title="Продажи"
        header-pre-title="В списке отображается все приходы по товарам"
    >

        <template #headerActions>
            <OrderFilters/>

            <Link :href="route('orders.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7"/>
                Новый заказ
            </Link>
        </template>

        <card  card-body-class="px-3">
            <OrderItems :orders="orders.data" />

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

export default {
    components: {
        Card,
        Pagination,
        OrderItems,
        OrderFilters,
        IconCirclePlus,
        PageWrapper,
        Link
    },
    props: ['orders', 'shared']
}
</script>
