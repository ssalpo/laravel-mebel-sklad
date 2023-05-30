<template>
    <PageWrapper
        header-title="Остаток на складе"
        header-pre-title="В списке отображается все ваши остатки по товарам"
    >
        <div class="mb-3 row row-cards">
            <div class="col-sm-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="text-white avatar bg-yellow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" strokeWidth="2" size="24"
                                         class="tabler-icon tabler-icon-businessplan">
                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0"></path>
                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                        <path d="M5 15v1m0 -8v1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ numberFormat(totalBalanceSum) }} с.
                                </div>
                                <div class="text-muted">Общая сумма остатка</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <StorehouseBalanceFilters class="mb-3"/>

        <StorehouseBalanceIndexDesktop
            :balances="balances"
            v-if="!isMobile"
        />

        <StorehouseBalanceIndexMobile
            :balances="balances"
            v-else
        />

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {numberFormat} from "../../functions";
import StorehouseBalanceFilters from "./Filters.vue";
import StorehouseBalanceIndexDesktop from "./IndexDesktop.vue";
import StorehouseBalanceIndexMobile from "./IndexMobile.vue";

export default {
    name: "StorehouseBalance",
    methods: {numberFormat},
    components: {
        StorehouseBalanceIndexMobile,
        StorehouseBalanceIndexDesktop,
        StorehouseBalanceFilters,
        Link,
        PageWrapper
    },
    props: ['balances'],
    computed: {
        totalBalanceSum() {
            return this.balances.reduce((c, v) => {
                c += (v.quantity * v.nomenclature.base_price)

                return c
            }, 0)
        }
    }
}
</script>
