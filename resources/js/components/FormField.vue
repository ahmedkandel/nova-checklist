<template>
    <default-field :field="field" :errors="errors" :show-errors="false" :full-width-content="true">
        <template slot="field">
            <items :items="value" :field="field" :edit="true" />

            <p v-if="hasError" class="text-xs mt-2 text-danger">{{ firstError }}</p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import Items from './Items.vue';

export default {
    mixins: [FormField, HandlesValidationErrors],

    components: { Items },

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        setInitialValue() {
            try {
                this.value = JSON.parse(this.field.value);
            } catch (e) {
                this.value = [];
            }
        },

        fill(formData) {
            formData.append(this.field.attribute, JSON.stringify(this.value) || []);
        },
    },
};
</script>
