<template>
    <CustomSelect
        v-bind="$attrs"
        searchable
        prefetch
        remote
        :remote-url="route('autocomplete.showcases')"
        full
        placeholder="Выберите витрину"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";
export default {
    name: "SelectShowcases",
    components: {CustomSelect}
}
</script>
