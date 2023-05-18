<template>
    <PageWrapper
        :header-title="`Заказ №${order.id}`"
        :back-url="route('orders.index')"
    >
        <card class="mb-3" without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <tbody>
                        <tr v-if="suppliersCount">
                            <td width="150" class="text-start text-sm-end fw-bold">Поставщик</td>
                            <td>{{order.supplier?.name || '-'}}</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Клиент</td>
                            <td>{{order.client?.name || '-'}}</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">
                                Общая сумма
                            </td>
                            <td>{{numberFormat(order.amount)}} сом.</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">
                                Прибыль
                            </td>
                            <td>{{numberFormat(order.profit)}} сом.</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">
                                Статус
                            </td>
                            <td :class="{'text-danger': order.status === 2, 'text-success': order.status === 1}">
                                {{shared.order.statuses[order.status]}}
                                <span v-if="order.status === 2 && order.cancel_reason">({{order.cancel_reason}})</span>
                            </td>
                        </tr>
                        <tr v-if="order.status !== 2">
                            <td></td>
                            <td>
                                <OrderCancelModal
                                    :order="order"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </card>

        <card card-title="Список товаров" without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th width="40">Товар</th>
                        <th>Цена за ед.</th>
                        <th>Кол-во</th>
                        <th>Сумма продажи</th>
                        <th>Сумма прибыли</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in order.order_items">
                        <td>{{item.nomenclature.name}}</td>
                        <td>{{item.price_for_sale}} сом.</td>
                        <td>{{numberFormat(item.total_amount, 2)}} сом.</td>
                        <td>{{numberFormat(item.total_profit, 2)}} сом.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import {numberFormat} from "../../functions";
import OrderCancelModal from "../../Shared/Modals/OrderCancelModal.vue";

export default {
    components: {OrderCancelModal, Card, PageWrapper, Link},
    props: ['order', 'suppliersCount', 'shared'],
    methods: {
        numberFormat
    }
}
</script>
