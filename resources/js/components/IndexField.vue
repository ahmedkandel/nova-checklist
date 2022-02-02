<template>
    <div :class="`text-${field.textAlign}`">
        <tooltip v-if="items.length" trigger="click">
            <div class="text-primary inline-flex items-center dim cursor-pointer">
                <span class="text-primary font-bold">{{ value }}</span>
            </div>

            <tooltip-content slot="content">
                <items :items="items" :field="field" :edit="false" />
            </tooltip-content>
        </tooltip>
        <p v-else>&mdash;</p>
    </div>
</template>

<script>
import Items from './Items.vue';

export default {
    components: { Items },

    props: ['resourceName', 'field'],

    computed: {
        items() {
            try {
                return JSON.parse(this.field.value);
            } catch (e) {
                return [];
            }
        },

        completed() {
            return this.items.filter(item => item.completed_at !== null);
        },

        itemStatus() {
            return this.completed.length + ' / ' + this.items.length;
        },

        completion() {
            return Math.round((this.completed.length / this.items.length) * 100) + ' %';
        },

        value() {
            if (this.field.showItemStatus && this.field.showCompletion) {
                return this.itemStatus + ' = ' + this.completion;
            }
            if (this.field.showItemStatus) {
                return this.itemStatus;
            }
            if (this.field.showCompletion) {
                return this.completion;
            }
            return this.items.length;
        },
    },
};
</script>
