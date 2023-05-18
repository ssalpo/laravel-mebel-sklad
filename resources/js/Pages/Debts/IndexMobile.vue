<template>
    <card class="mb-3">
        <div class="divide-y">
            <div v-for="debt in debts.data">
                <div class="row">
                    <div class="col">
                        <div class="text-truncate fw-bolder">
                            Долг №{{ debt.id }}
                        </div>
                        <div class="fw-bold my-1" v-if="debt.client?.name">
                            Клиент: {{ debt.client?.name }}
                        </div>
                        <div class="fw-bold my-1" v-if="debt.order?.id">
                            Заказ: №{{ debt.order?.id }}
                        </div>
                        <div class="fw-bold my-1">
                            Сумма: <span class="text-danger">{{ numberFormat(debt.amount) }} сом.</span>
                        </div>
                        <div class="fw-bold my-1">
                            Остаток: <span
                            class="text-danger">{{ numberFormat(debt.amount - debt.payments_sum_amount) }} сом.</span>
                        </div>
                        <div class="fw-bold my-1">
                            Статус: <span
                            :class="{'text-success': debt.is_paid, 'text-danger': !debt.is_paid}">{{ debt.is_paid ? 'Оплачено' : 'Не оплачено' }}</span>
                        </div>

                        <div>
                            <a href="" @click.prevent="showMore(debt)">Подробнее</a>
                        </div>
                    </div>
                    <div class="col-auto fw-bold text-red d-flex flex-column justify-content-around align-items-end">
                        <div v-if="!debt.is_paid">
                            <button @click="$emit('debtSelect', debt)"
                                    class="btn btn-outline-success btn-sm text-success">Погасить долг
                            </button>
                        </div>

                        <div>
                            <EditLinkBtn
                                :url="route('debts.edit', debt.id)"
                                class="me-2"
                            />

                            <DeleteBtn
                                :url="route('debts.destroy', debt.id)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <template #cardFooter v-if="debts.links.length > 3">
            <Pagination class="float-end" :links="debts.links"/>
        </template>
    </card>

    <BsModal
        ref="debtShowMoreModal"
        centered
        :title="`Долг №${selectedDebt?.id}`"
    >
        <Link v-if="selectedDebt !== null"
              :href="route('debts.payments.index', selectedDebt.id)"
              class="btn btn-outline-primary mb-3"
        >
            История погашений
        </Link>

        <dl class="row" v-if="selectedDebt !== null">
            <dt class="col-12" v-if="selectedDebt.client?.name">Клиент:</dt>
            <dd class="col-12 mt-1" v-if="selectedDebt.client?.name">{{ selectedDebt.client?.name }}</dd>

            <dt class="col-12" v-if="selectedDebt.order?.id">Заказ:</dt>
            <dd class="col-12 mt-1" v-if="selectedDebt.order?.id">№{{ selectedDebt.order?.id }}</dd>

            <dt class="col-12">Статус:</dt>
            <dd class="col-12 mt-1"
                :class="{'text-success': selectedDebt.is_paid, 'text-danger': !selectedDebt.is_paid}">
                {{ selectedDebt.is_paid ? 'Оплачено' : 'Не оплачено' }}
            </dd>

            <dt class="col-12">Общая сумма долга:</dt>
            <dd class="col-12 text-danger mt-1">{{ numberFormat(selectedDebt.amount || 0, 2) }} сом.</dd>

            <dt class="col-12">Остаток для погашения:</dt>
            <dd class="col-12 text-danger mt-1">
                {{ numberFormat(selectedDebt.amount - selectedDebt.payments_sum_amount || 0, 2) }} сом.
            </dd>

            <dt class="col-12 mt-2">Дата создания:</dt>
            <dd class="col-12 mt-1">{{ selectedDebt.created_at_formatted }}</dd>

            <dt class="col-12 mt-2">Комментарий:</dt>
            <dd class="col-12 text-muted mt-1">{{ selectedDebt.comment || '-' }}</dd>
        </dl>
    </BsModal>
</template>

<script>
import Card from "../../Shared/Card.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from "../../Shared/Pagination.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {numberFormat} from "../../functions";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import BsModal from "../../Shared/BsModal.vue";

export default {
    name: "IndexMobile",
    emits: ['debtSelect'],
    props: ['debts'],
    components: {BsModal, EditLinkBtn, DeleteBtn, Pagination, Link, Card},
    data() {
        return {
            showMoreContent: false,
            selectedDebt: null
        }
    },
    methods: {
        numberFormat,
        showMore(debt) {
            this.$refs.debtShowMoreModal.show()
            this.selectedDebt = debt
        }
    },
}
</script>
