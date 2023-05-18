<template>
    <PageWrapper
        header-title="Долги клиентов"
    >
        <template #headerActions>
            <DebtFilters />

            <Link :href="route('debts.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                Добавить
            </Link>
        </template>

        <div class="mb-3 row row-cards">
            <div class="col-sm-4">
                <MetricCard
                    :card-title="`${totalDebts} сом.`"
                    card-description="Общая сумма долга"
                >
                    <template #icon>
                        <IconCreditCard :size="24" stroke-width="2"/>
                    </template>
                </MetricCard>
            </div>
            <div class="col-sm-4">
                <MetricCard
                    icon-bg="bg-success"
                    :card-title="`${totalPayments} сом.`"
                    card-description="Общая сумма погашений"
                >
                    <template #icon>
                        <IconCreditCardOff :size="24" stroke-width="2"/>
                    </template>
                </MetricCard>
            </div>
            <div class="col-sm-4">
                <MetricCard
                    icon-bg="bg-yellow"
                    :card-title="`${totalDebts - totalPayments} сом.`"
                    card-description="Остаток для погашения"
                >
                    <template #icon>
                        <IconBusinessplan :size="24" stroke-width="2"/>
                    </template>
                </MetricCard>
            </div>
        </div>

        <IndexMobile
            @debtSelect="onDebtSelect"
            :debts="debts"
            v-if="isMobile"
        />

        <IndexTable
            @debtSelect="onDebtSelect"
            :debts="debts" v-else
        />
    </PageWrapper>

    <DebtPaymentModal
        ref="paymentModal"
        :debt="selectedDebt"
    />
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {numberFormat} from "../../functions";
import Pagination from "../../Shared/Pagination.vue";
import Modal from "../../Shared/Modal.vue";
import IndexMobile from "./IndexMobile.vue";
import IndexTable from "./IndexTable.vue";
import DebtPaymentModal from "../../Shared/Form/DebtPaymentModal.vue";
import MetricCard from "../../Shared/MetricCard.vue";
import {IconCreditCard, IconCreditCardOff, IconBusinessplan, IconCirclePlus} from "@tabler/icons-vue";
import DebtFilters from "./Filters.vue";

export default {
    components: {
        DebtFilters,
        IconCirclePlus,
        MetricCard,
        DebtPaymentModal,
        IndexTable,
        IndexMobile,
        Modal,
        Pagination,
        DeleteBtn,
        Card,
        PageWrapper,
        Link,
        IconCreditCard,
        IconCreditCardOff,
        IconBusinessplan,
    },
    props: ['debts', 'totalDebts', 'totalPayments'],
    data() {
        return {
            selectedDebt: null
        }
    },
    methods: {
        numberFormat,
        onDebtSelect(debt) {
            this.selectedDebt = debt
            this.$refs.paymentModal.show()
        }
    },
}
</script>
