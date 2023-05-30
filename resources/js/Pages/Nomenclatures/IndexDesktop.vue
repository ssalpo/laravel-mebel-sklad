<template>
    <card without-body>
        <EmptyResult v-if="!nomenclatures.data.length"/>

        <div class="table-responsive" v-else>
            <table class="table table-vcenter text-nowrap card-table">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Название</th>
                    <th>Себестоимость</th>
                    <th>Цена продажи</th>
                    <th>Дата создания</th>
                    <th>Номер штрихкода</th>
                    <th width="120"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(nomenclature, index) in nomenclatures.data">
                    <td>{{
                            (nomenclatures.total - index) - ((nomenclatures.current_page - 1) * nomenclatures.per_page)
                        }}
                    </td>
                    <td>{{ nomenclature.name }}</td>
                    <td>{{ numberFormat(nomenclature.base_price, 2) }} с.</td>
                    <td>{{ numberFormat(nomenclature.price_for_sale, 2) }} с.</td>
                    <td class="text-muted">{{ nomenclature.created_at_formatted }}</td>
                    <td>
                        <NomenclatureBarcodeChangeModal
                            btn-size="btn-sm px-2"
                            :nomenclature="nomenclature"
                            :btn-text="nomenclature.barcode"
                        />
                    </td>
                    <td class="text-end">
                        <EditLinkBtn
                            :url="route('nomenclatures.edit', nomenclature.id)"
                            class="me-2"
                        />

                        <DeleteBtn
                            :url="route('nomenclatures.destroy', nomenclature.id)"
                        />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <template #cardFooter v-if="nomenclatures.links.length > 3">
            <Pagination class="float-end" :links="nomenclatures.links"/>
        </template>
    </card>
</template>

<script>
import Pagination from "../../Shared/Pagination.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import NomenclatureBarcodeChangeModal from "../../Shared/Modals/NomenclatureBarcodeChangeModal.vue";
import Card from "../../Shared/Card.vue";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {numberFormat} from "../../functions";
import EmptyResult from "../../Shared/EmptyResult.vue";

export default {
    name: "NomenclaturesIndexDesktop",
    methods: {numberFormat},
    components: {EmptyResult, EditLinkBtn, Card, NomenclatureBarcodeChangeModal, DeleteBtn, Pagination},
    props: ['nomenclatures']
}
</script>
