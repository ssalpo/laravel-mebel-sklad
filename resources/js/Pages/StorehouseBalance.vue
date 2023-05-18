<template>
    <PageWrapper
        header-title="Остаток на складе"
        header-pre-title="В списке отображается все ваши остатки по товарам"
    >
        <card without-body>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Кол-во</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="balance in balances">
                            <td>{{ balance.nomenclature_name }}</td>
                            <td>{{ balance.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../Shared/PageWrapper.vue";
import DeleteBtn from "../Shared/DeleteBtn.vue";
import Card from "../Shared/Card.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "StorehouseBalance",
    components: {Link, Card, DeleteBtn, PageWrapper},
    props: ['balances']
}
</script>
