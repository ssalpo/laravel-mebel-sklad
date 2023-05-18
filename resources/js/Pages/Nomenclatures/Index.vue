<template>
    <PageWrapper
        header-title="Товар"
        header-pre-title="В списке отображается все ваши доступные товары"
    >

        <template #headerActions>
            <Link :href="route('nomenclatures.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                Добавить товар
            </Link>
        </template>


        <card without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th width="40">ID</th>
                        <th>Название</th>
                        <th>Себестоимость</th>
                        <th>Цена продажи</th>
                        <th>Дата создания</th>
                        <th>Номер штрихкода</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="nomenclature in nomenclatures.data">
                        <td>{{ nomenclature.id }}</td>
                        <td>{{ nomenclature.name }}</td>
                        <td>{{ numberFormat(nomenclature.base_price, 2) }} сом.</td>
                        <td>{{ numberFormat(nomenclature.price_for_sale, 2) }} сом.</td>
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

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import {numberFormat} from "../../functions";
import Pagination from "../../Shared/Pagination.vue";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {IconCirclePlus} from "@tabler/icons-vue";
import NomenclatureBarcodeChangeModal from "../../Shared/Modals/NomenclatureBarcodeChangeModal.vue";

export default {
    components: {
        NomenclatureBarcodeChangeModal,
        IconCirclePlus, EditLinkBtn, Pagination, DeleteBtn, Card, PageWrapper, Link},
    props: ['nomenclatures'],
    methods: {
        numberFormat
    }
}
</script>
