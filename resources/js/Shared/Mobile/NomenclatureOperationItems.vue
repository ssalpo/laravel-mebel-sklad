<template>
    <div class="divide-y">
        <div v-for="item in items">
            <Link :href="route('nomenclature-arrivals.show', item.id)" class="text-decoration-none">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-truncate text-dark">
                            <strong>{{item.title}}</strong>
                        </div>
                        <div class="text-muted">
                            <small>{{item.date}}</small>
                        </div>
                    </div>
                    <div class="col-auto text-muted">
                        <span class="badge badge-outline text-green">
                            {{item.quantity}}
                        </span>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "NomenclatureOperationItems",
    components: {Link},
    props: ['items']
}
</script>
