<template>
    <div class="mb-3">
        <div v-if="edit" class="flex items-center">
            <checkbox class="mr-3" :checked="isCompleted" @input="toggleCompleted" />

            <input type="text" class="w-full form-control form-input" v-model="item.body" @keydown.enter.prevent />

            <button type="button" class="cursor-pointer dim btn btn-link ml-3" @click="deleteItem">
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
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                </svg>
            </button>
        </div>

        <div v-else class="flex items-center">
            <template v-if="isCompleted">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="var(--success)"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </template>

            <template v-else>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="var(--sidebar-icon)"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </template>

            <div class="flex flex-col">
                <div :class="isCompleted ? 'line-through text-success' : ''">{{ item.body }}</div>
                <div v-if="field.showDetails && itemDetails" class="text-xs text-70">{{ itemDetails }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['item', 'field', 'edit'],

    methods: {
        toggleCompleted() {
            if (this.item.completed_at) {
                this.item.completed_by = null;
                this.item.completed_at = null;
            } else {
                this.item.completed_by = this.field.user || null;
                this.item.completed_at = Date.now();
            }
        },

        deleteItem() {
            this.$emit('deleted');
        },
    },

    computed: {
        isCompleted() {
            return this.item.completed_at !== null;
        },

        completedFromNow() {
            return this.item.completed_at
                ? moment(this.item.completed_at).locale(window.config.locale).fromNow()
                : null;
        },

        itemDetails() {
            if (this.item.completed_by && this.completedFromNow) {
                return `${this.item.completed_by}, ${this.completedFromNow}`;
            }
            return this.completedFromNow;
        },
    },
};
</script>
