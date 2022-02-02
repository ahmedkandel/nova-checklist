<template>
    <div class="w-full -mb-3">
        <item
            v-for="(item, index) in items"
            :key="index"
            :item="item"
            :field="field"
            :edit="edit"
            @deleted="remove(index)"
        />

        <new-item @created="add" :field="field" v-if="edit && field.canEdit" />
    </div>
</template>

<script>
import Item from './Item.vue';
import NewItem from './NewItem.vue';

export default {
    components: { Item, NewItem },

    props: ['items', 'field', 'edit'],

    methods: {
        add(item) {
            this.items.push(item);
        },

        remove(index) {
            this.items.splice(index, 1);
        },
    },
};
</script>
