<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item :item="item" v-on:reloadList="reloadList()"/>
        </div>
    </div>
</template>

<script>
import listItem from "./listItem"
export default {
    props: ['items'],
    components: {
        listItem
    },
    methods: {
        reloadList() {
            this.$emit('reloadList');
        }
    }


}
</script>
