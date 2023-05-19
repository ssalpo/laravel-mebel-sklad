<template>
    <PageWrapper
        :header-title="`Заказ №${order.id}`"
        :back-url="route('orders.index')"
    >
        <card class="mb-3" without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <tbody>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Клиент</td>
                            <td>
                                <div>{{order.client_name || '-'}}</div>
                                <div v-if="order.phone_number" class="mt-2">
                                    <a :href="`tel:${order.phone_number}`">{{order.phone_number}}</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Сумма взноса</td>
                            <td>{{numberFormat(order.deposit_amount)}} сом.</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Остаток для оплаты</td>
                            <td>
                                <div v-if="order.deposit_amount > 0">
                                    <div class="mb-2">
                                        {{numberFormat(order.amount - order.deposit_amount)}} сом.
                                    </div>
                                    <Link class="btn btn-sm btn-success" :href="route('orders.paid', order.id)" method="post" as="button">оплатил</Link>
                                </div>
                                <div v-else class="text-success">
                                    Оплатил
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Адрес</td>
                            <td>{{order.address}}</td>
                        </tr>
                        <tr>
                            <td class="text-start text-sm-end fw-bold">Регион</td>
                            <td>{{order.region.name}}</td>
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
                        <td>{{numberFormat(item.price_for_sale)}} сом.</td>
                        <td>{{item.quantity}}</td>
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
    props: ['order', 'shared'],
    methods: {
        numberFormat
    }
}
</script>
