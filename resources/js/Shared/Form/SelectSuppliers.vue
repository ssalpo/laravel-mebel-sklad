<template>
    <CustomSelect
        v-bind="$attrs"
        searchable
        prefetch
        remote
        :remote-url="route('autocomplete.suppliers')"
        full
        placeholder="Выберите поставщика"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";
export default {
    name: "SelectSuppliers",
    components: {CustomSelect}
}
</script>
