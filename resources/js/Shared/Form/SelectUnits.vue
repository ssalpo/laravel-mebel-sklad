<template>
    <CustomSelect
        v-bind="$attrs"
        prefetch
        remote
        :remote-url="route('autocomplete.units')"
        full
        placeholder="Выберите ед. измерения"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";
export default {
    name: "SelectUnits",
    components: {CustomSelect}
}
</script>
