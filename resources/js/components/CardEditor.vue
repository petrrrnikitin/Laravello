<template>
    <div>
        <textarea
            class="shadow-card rounded-md py-1 px-2 outline-none w-full text-gray-900 text-sm bg-white h-16 resize-none"
            placeholder="Enter a title for this card..."
            :value="value"
            ref="card"
            @keyup.esc="closed"
            @keyup.enter="saved"
            @input="$emit('input', $event.target.value)"
        ></textarea>

        <div class="flex">
            <button
                @click="saved"
                class="rounded-sm py-1 px-3 bg-indigo-700 text-white cursor-pointer hover:bg-indigo-600 focus:outline-none outline-none">
                {{ label }}
            </button>
            <button
                @click="closed"
                class="py-1 px-3 ml-1 rounded-md hover:bg-gray-400 cursor-pointer text-gray-500 focus:outline-none outline-none">
                Cancel
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CardEditor",
    props: ['value', 'label'],
    mounted() {
        this.$refs.card.focus();
    },
    methods: {
        saved() {
            this.$emit('saved');
        },
        closed() {
            this.$emit('closed');
        }
    }
}
</script>

<style scoped>

</style>
