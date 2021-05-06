<template>
    <div class="bg-gray-300 rounded-sm p-2 mr-2 list">
        <div class="flex justify-between">
            <div class="text-gray-800 pl-2 pb-2 font-bold">{{ list.title }}</div>
        </div>

        <Card
            v-for="card in list.cards" :key="card.id" :card="card"
            @deleted="$emit('card-deleted', {...$event, list_id: list.id})">
        </Card>

        <CardAddEditor
            :list="list"
            v-if="editing"
            @added="$emit('card-added', {...$event, list_id: list.id})"
            @updated="$emit('card-updated', {...$event, list_id: list.id})"
            @closed="editing=false"
        >
        </CardAddEditor>

        <CardAddButton v-else @click="editing=true"></CardAddButton>
    </div>
</template>

<script>
import Card from "./Card";
import CardAddButton from "./CardAddButton";
import CardAddEditor from "./CardAddEditor";
export default {
    name: "List",
    components: {Card, CardAddButton, CardAddEditor},
    props: {
        list: Object
    },
    data() {
        return {
            editing: false,
        }
    }
}
</script>

<style scoped>
.list {
    width: 250px;
    min-width: 250px;
}
</style>
