<template>
    <PageWrapper
        header-title="Товары"
        header-pre-title="В списке отображается все ваши доступные товары"
    >

        <template #headerActions>
            <Link :href="route('nomenclatures.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                Добавить товар
            </Link>
        </template>

        <NomenclaturesIndexMobile
            v-if="isMobile"
            :nomenclatures="nomenclatures"
        />

        <NomenclaturesIndexDesktop
            v-else
            :nomenclatures="nomenclatures"
        />

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
import NomenclaturesIndexDesktop from "./IndexDesktop.vue";
import NomenclaturesIndexMobile from "./IndexMobile.vue";

export default {
    components: {
        NomenclaturesIndexMobile,
        NomenclaturesIndexDesktop,
        NomenclatureBarcodeChangeModal,
        IconCirclePlus, EditLinkBtn, Pagination, DeleteBtn, Card, PageWrapper, Link},
    props: ['nomenclatures'],
    methods: {
        numberFormat
    }
}
</script>
