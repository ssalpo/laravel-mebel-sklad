<template>
    <div>
        <TextInput
            @keydown.enter="submit"
            placeholder="ID, сумма, адрес или имя клиента"
            v-model="form.query"
        />

        <div class="row align-items-center mt-1">
            <div class="col">
                <OrderFilters />
            </div>
            <div class="col-auto">
                <button type="button" @click="submit" class="btn btn-outline-primary btn-sm btn-icon" :class="{'me-2': isFiltered}">
                    <IconSearch :size="14" stroke-width="3"/>
                </button>

                <Link v-if="isFiltered" :href="route('orders.index')" class="btn btn-danger btn-sm btn-icon ms-auto">
                    <IconX size="14" stroke-width="2"/>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import {Link, useForm} from "@inertiajs/inertia-vue3";
import queryString from 'query-string';
import {size} from "lodash/collection";
import TextInput from "../../Shared/Form/TextInput.vue";
import OrderFilters from "./Filters.vue";
import omit from "lodash/omit";
import {IconFilter, IconSearch, IconX} from "@tabler/icons-vue";

export default {
    name: "OrderFiltersShort",
    components: {
        IconFilter,
        IconX,
        IconSearch,
        Link,
        OrderFilters,
        TextInput
    },
    data() {
        return {
            isSend: false,
            isFiltered: false,
            form: useForm({
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
        },
        submit() {
            this.form.get(route('orders.index'))
        }
    }
}
</script>
