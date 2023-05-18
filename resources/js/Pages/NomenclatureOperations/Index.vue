<template>
    <PageWrapper
        :header-title="headerTitle"
    >

        <template #headerActions>
            <Link :href="route('nomenclature-operations.create', {type: queryParams('type')})" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                {{createBtnTitle}}
            </Link>
        </template>

        <card without-body>
            <div class="table-responsive">
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Кол-во</th>
                        <th>Себестоимость</th>
                        <th>Комментарий</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="nomenclatureOperation in nomenclatureOperations.data">
                        <td>{{ nomenclatureOperation.nomenclature.name }}</td>
                        <td>{{ numberFormat(nomenclatureOperation.quantity, 2) }} {{nomenclatureOperation.nomenclature.unit}}</td>
                        <td>{{ numberFormat(nomenclatureOperation.base_price, 2) }}</td>
                        <td>{{ nomenclatureOperation.comment }}</td>
                        <td class="text-muted">{{ nomenclatureOperation.created_at_formatted }}</td>
                        <td class="text-end">
                            <EditLinkBtn
                                :url="route('nomenclature-operations.edit', {id: nomenclatureOperation.id, type: queryParams('type')})"
                                class="me-2"
                            />

                            <DeleteBtn
                                :url="route('nomenclature-operations.destroy', {id: nomenclatureOperation.id, type: queryParams('type')})"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="nomenclatureOperations.links.length > 3">
                <Pagination class="float-end" :links="nomenclatureOperations.links"/>
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
import {queryParams} from "../../functions";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {IconCirclePlus} from "@tabler/icons-vue";

export default {
    components: {IconCirclePlus, EditLinkBtn, Pagination, DeleteBtn, Card, PageWrapper, Link},
    props: ['nomenclatureOperations'],
    methods: {
        numberFormat,
        queryParams
    },
    computed: {
        createBtnTitle() {
            let editTypeLabels = {
                1: 'Новое списание',
                2: 'Новый возврат'
            }

            return editTypeLabels[this.queryParams('type')] || ''
        },
        headerTitle() {
            let editTypeLabels = {
                1: 'Списание',
                2: 'Возврат'
            }

            return editTypeLabels[this.queryParams('type')] || ''
        }
    }
}
</script>
