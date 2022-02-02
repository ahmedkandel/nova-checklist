<template>
    <panel-item :field="field">
        <slot>
            <h4 class="font-normal text-80">{{ field.name }}</h4>
        </slot>

        <p slot="value" class="text-90">
            <items :items="value" :field="field" :edit="false" />
        </p>
    </panel-item>
</template>

<script>
import Items from './Items.vue';

export default {
    components: { Items },

    props: ['resource', 'resourceName', 'resourceId', 'field'],

    computed: {
        value() {
            try {
                return JSON.parse(this.field.value);
            } catch (e) {
                return [];
            }
        },
    },
};
</script>
