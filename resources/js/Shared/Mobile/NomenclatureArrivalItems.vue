<template>
    <div class="divide-y">
        <div v-for="item in items">
            <div class="row">
                <div class="col">
                    <div class="text-truncate text-dark">
                        <strong>{{ item.nomenclature.name }}</strong>
                    </div>
                    <div class="text-muted">
                        <small>Себестоимость: {{ numberFormat(item.nomenclature.base_price) }} с.</small>
                    </div>
                </div>
                <div class="col-auto text-end">
                    <span class="d-inline-block badge badge-outline text-green">
                        {{ numberFormat(item.quantity) }}
                    </span>

                    <span class="d-block badge badge-outline text-danger mt-1">
                        {{ numberFormat(item.nomenclature.base_price * item.quantity) }} с.
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {numberFormat} from "../../functions";

export default {
    name: "NomenclatureArrivalItems",
    methods: {numberFormat},
    props: ['items']
}
</script>
