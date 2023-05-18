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

        <OrdersIndexMobile
            v-if="isMobile"
            :orders="orders"
            :showcases-count="showcasesCount"
        />

        <OrdersIndexDesktop
            v-else
            :orders="orders"
            :showcases-count="showcasesCount"
        />

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {IconCirclePlus} from "@tabler/icons-vue";
import OrderFilters from "./Filters.vue";
import OrderItems from "../../Shared/Mobile/OrderItems.vue";
import OrdersIndexDesktop from "./IndexDesktop.vue";
import OrdersIndexMobile from "./IndexMobile.vue";

export default {
    components: {
        OrdersIndexMobile,
        OrdersIndexDesktop,
        OrderItems,
        OrderFilters,
        IconCirclePlus,
        PageWrapper,
        Link
    },
    props: ['orders', 'showcasesCount', 'shared']
}
</script>
