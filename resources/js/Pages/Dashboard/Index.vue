<template>
    <PageWrapper
        header-title="Аналитика"
    >

        <template #headerRewrite>
                <div class="col-6">
                    <h2 class="page-title">Аналитика</h2>
                </div>

                <div class="col-6 text-end">
                    <DashboardFilters />
                </div>
        </template>

        <div class="col-12">
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{numberFormat(totalProfitAmount, 2)}} сом.
                                    </div>
                                    <div class="text-muted">
                                        Прибыль
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{numberFormat(totalSalesAmount, 2)}} сом.
                                    </div>
                                    <div class="text-muted">
                                        Продажи
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <card
            class="mt-3"
            without-body
            card-title="Продажи по товарам"
        >
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Сумма</th>
                        <th>Прибыль</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="nomenclature in nomenclatureProfits">
                            <td>{{nomenclature.name}}</td>
                            <td>{{numberFormat(nomenclature.amount, 2)}} сом.</td>
                            <td>{{numberFormat(nomenclature.profit, 2)}} сом.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </card>
    </PageWrapper>
</template>
<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import PageWrapper from "../../Shared/PageWrapper.vue";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {
    IconFilter
} from "@tabler/icons-vue"
import {numberFormat} from "../../functions";
import DashboardFilters from "./Filters.vue";

export default {
    methods: {numberFormat},
    props: ['totalProfitAmount', 'totalSalesAmount', 'nomenclatureProfits', 'filterParams'],
    components: {DashboardFilters, IconFilter, DeleteBtn, Card, PageWrapper, Head, Link}
}
</script>
