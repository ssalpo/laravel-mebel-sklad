<template>
    <CustomSelect
        v-bind="$attrs"
        searchable
        prefetch
        ref="SelectRegions"
        remote
        :remote-url="route('autocomplete.regions')"
        full
        placeholder="Выберите регион"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";
export default {
    name: "SelectRegions",
    components: {CustomSelect},
    methods: {
        refreshData() {
            this.$refs.SelectRegions.refreshData()
        }
    }
}
</script>
