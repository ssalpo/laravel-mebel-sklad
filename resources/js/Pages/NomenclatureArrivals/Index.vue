<template>
    <PageWrapper
        header-title="Приход"
        header-pre-title="В списке отображается все приходы по товарам"
    >

        <template #headerActions>
            <Link :href="route('nomenclature-arrivals.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7"/>
                Новый приход
            </Link>
        </template>

        <NomenclatureArrivalsIndexMobile
            v-if="isMobile"
            :nomenclature-arrivals="nomenclatureArrivals"
        />

        <NomenclatureArrivalsIndexDesktop
            v-if="!isMobile"
            :nomenclature-arrivals="nomenclatureArrivals"
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
import NomenclatureArrivalsIndexMobile from "./IndexMobile.vue";
import NomenclatureArrivalsIndexDesktop from "./IndexDesktop.vue";

export default {
    components: {
        NomenclatureArrivalsIndexDesktop,
        NomenclatureArrivalsIndexMobile,
        IconCirclePlus,
        EditLinkBtn,
        PageWrapper,
        Link
    },
    props: ['nomenclatureArrivals']
}
</script>
