<template>
    <div class="flex">
        <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="placeholder"
            v-model="item.body"
            @keydown.enter.prevent="createItem"
        />
        <button
            type="button"
            class="cursor-pointer dim btn btn-link ml-3"
            v-show="item.body.length > 0"
            @click="createItem"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="var(--sidebar-icon)"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: ['field'],

    data() {
        return {
            item: this.newItem(),
        };
    },

    methods: {
        newItem() {
            return {
                body: '',
                created_by: null,
                created_at: null,
                completed_by: null,
                completed_at: null,
            };
        },

        createItem() {
            if (this.item.body.length > 0) {
                this.item.created_by = this.field.user || null;
                this.item.created_at = Date.now();
                this.$emit('created', this.item);
                this.item = this.newItem();
            }
        },
    },

    computed: {
        placeholder() {
            return (
                (this.field.placeholder || this.__('Add item')) +
                (this.field.placeholderCounter ? ' ' + (this.$parent.items.length + 1) : '')
            );
        },
    },
};
</script>
