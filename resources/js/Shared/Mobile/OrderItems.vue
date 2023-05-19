<template>
    <div class="divide-y">
        <div v-for="order in orders">
            <div class="row">
                <Link :href="route('orders.show', order.id)" class="text-decoration-none">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate text-dark">
                                    <strong># {{order.id}}</strong>
                                </div>
                            </div>
                            <div class="col-auto text-muted">
                                <small>{{order.created_at_formatted}}</small>
                            </div>
                        </div>
                        <div class="text-muted my-1">
                            <small class="d-block" v-html="[order.region.name, order.address, order.client_name ? `<strong>${order.client_name}</strong>` : null].filter(Boolean).join(', ')"></small>

                            <small class="badge bg-red-lt mt-2" v-if="order.deposit_amount > 0">
                                Остаток: {{numberFormat(order.amount - order.deposit_amount, 2)}} сом.
                            </small>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted my-1">
                                <span class="badge" :class="{'bg-red-lt': order.status === 2, 'bg-green-lt': order.status === 1}">
                                    {{$page.props.shared.order.statuses[order.status]}}
                                </span>
                                </div>
                            </div>
                            <div class="col-auto text-dark-emphasis">
                                <strong>{{numberFormat(order.amount, 2)}} с.</strong>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import {numberFormat} from "../../functions";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "OrderItems",
    methods: {numberFormat},
    components: {
        Link
    },
    props: {
        shared: Object,
        orders: {
            type: Array,
            required: true
        }
    }
}
</script>
