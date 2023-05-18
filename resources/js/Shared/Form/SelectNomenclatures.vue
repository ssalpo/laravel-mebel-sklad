<template>
    <CustomSelect
        v-bind="$attrs"
        searchable
        prefetch
        remote
        :remote-url="route('autocomplete.nomenclatures')"
        full
        placeholder="Выберите товар"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";

export default {
    name: "SelectNomenclatures",
    components: {CustomSelect}
}
</script>
