<template>
    <BsModal
        with-btn
        title="Фильтрация"
        @submit="submit"
    >
        <template #btn="{show}">
            <button class="btn btn-outline-info btn-sm px-2" @click="show">
                <IconFilter :size="14" class="me-1" stroke-width="1.5"/>
                расширенный
            </button>
        </template>

        <div class="mb-3">
            <TextInput
                placeholder="ID, сумму, адрес или имя клиента"
                v-model="form.query"
            />
        </div>

        <div class="input-group">
            <AirDatePicker
                :as-modal="isMobile"
                v-model="form.created_start"
                placeholder="Дата начала"
            />
            <span class="input-group-text">-</span>
            <AirDatePicker
                :as-modal="isMobile"
                v-model="form.created_end"
                placeholder="Дата конечная"
            />
        </div>

        <template #footer="{hide}">
            <button :disabled="form.processing" class="btn btn-primary">
                Найти
            </button>

            <Link v-if="isFiltered" :href="route('orders.index')" class="btn btn-danger px-2 ms-auto">
                <IconX size="20" stroke-width="2"/>
            </Link>

            <button v-else :disabled="form.processing" type="button" @click="hide" class="btn btn-link link-secondary ms-auto">
                Отменить
            </button>
        </template>
    </BsModal>
</template>

<script>
import Card from "../../Shared/Card.vue";
import AirDatePicker from "../../Shared/Form/AirDatePicker.vue";
import {useForm, Link} from "@inertiajs/inertia-vue3";
import queryString from 'query-string';
import {IconFilter, IconX} from "@tabler/icons-vue"
import {size} from "lodash/collection";
import TextInput from "../../Shared/Form/TextInput.vue";
import BsModal from "../../Shared/BsModal.vue";
import omit from "lodash/omit";

export default {
    name: "OrderFilters",
    components: {
        BsModal,
        TextInput, IconFilter, AirDatePicker, Card, IconX, Link},
    data() {
        return {
            isFiltered: false,
            form: useForm({
                created_start: null,
                created_end: null,
                query: null,
            })
        }
    },
    created() {
        this.loadDefaultParams()
    },
    methods: {
        loadDefaultParams() {
            let params = queryString.parse(location.search);

            this.isFiltered = size(omit(params)) > 0

            this.form.query = params['query']
            this.form.created_start = params['created_start']
            this.form.created_end = params['created_end']
        },
        submit() {
            this.form.get(route('orders.index'))
        }
    }
}
</script>
