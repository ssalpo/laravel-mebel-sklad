<template>
    <card class="mb-5" card-body-class="px-3">
        <!--            <div class="divide-y">
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong># 1234</strong>
                                            </div>
                                        </div>
                                        <div class="col-auto text-muted">
                                            <small>08.09.2023 09:12</small>
                                        </div>
                                    </div>
                                    <div class="text-muted my-1">
                                        <small>
                                            Магазин Ашроф, <strong>Санжар</strong>
                                        </small>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted my-1">
                                                <span class="badge bg-red-lt">Отменен</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <strong>2 200 с.</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong># 1234</strong>
                                            </div>
                                        </div>
                                        <div class="col-auto text-muted">
                                            <small>08.09.2023 09:12</small>
                                        </div>
                                    </div>
                                    <div class="text-muted my-1">
                                        <small>
                                            Магазин Ашроф, <strong>Санжар</strong>
                                        </small>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted my-1">
                                                <span class="badge bg-green-lt">Продано</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <strong>2 200 с.</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

        <OrderItems :orders="orders.data" />

        <template #cardFooter v-if="orders.links.length > 3">
            <Pagination class="float-end" :links="orders.links"/>
        </template>
    </card>
</template>

<script>
import Card from "../../Shared/Card.vue";
import OrderItems from "../../Shared/Mobile/OrderItems.vue";
import Pagination from "../../Shared/Pagination.vue";

export default {
    name: "OrdersIndexMobile",
    props: ['orders', 'suppliersCount'],
    components: {Pagination, OrderItems, Card}
}
</script>
