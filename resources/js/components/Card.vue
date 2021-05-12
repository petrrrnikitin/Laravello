<template>
    <div>
        <div v-if="!editing"
             class="group shadow-card flex justify-between bg-white rounded-sm p-2 cursor-pointer text-sm hover:bg-gray-100 mb-2">
            <div>{{ card.title }}</div>
            <div v-if="card.owner.id === userId"
                 class="flex font-bold group-hover:opacity-75 opacity-0 transition-opacity ease-out duration-500">
                <div @click="editing=true" class="text-gray-400 pr-2 hover:text-yellow-700">E</div>
                <div
                    @click="cardDelete"
                    class="text-gray-400 hover:text-red-700">
                    D
                </div>
            </div>
        </div>
        <CardEditor
            v-else
            class="mb-2"
            label="Save card"
            @closed="editing=false"
            @saved="cardUpdate"
            v-model="title"
        ></CardEditor>
    </div>
</template>

<script>
import CardDelete from "./../graphql/CardRemove.gql"
import CardUpdate from "./../graphql/CardUpdate.gql"
import {EVENT_CARD_DELETED, EVENT_CARD_UPDATED} from "../constants";
import CardEditor from "./CardEditor";
import {mapState} from "vuex";

export default {
    name: "Card",
    components: {CardEditor},
    computed: mapState({
        userId: state => state.user.id
    }),
    props: {
        card: Object
    },
    data() {
        return {
            editing: false,
            title: this.card.title
        }
    },
    methods: {
        async cardDelete() {
            const self = this;
            try {
                await this.$apollo.mutate({
                    mutation: CardDelete,
                    variables: {
                        id: this.card.id
                    },
                    update(store, {data: {CardDelete}}) {
                        self.$emit("deleted", {store, data: CardDelete, type: EVENT_CARD_DELETED});
                    }
                })
            } catch (e) {}
        },
        async cardUpdate() {
            const self = this;
            try {
                await this.$apollo.mutate({
                    mutation: CardUpdate,
                    variables: {
                        id: this.card.id,
                        title: this.title
                    },
                    update(store, {data: {CardUpdate}}) {
                        self.$emit('updated', {
                            store,
                            data: CardUpdate,
                            type: EVENT_CARD_UPDATED,
                        });
                        self.editing = false;
                    }
                })
            } catch (e) {}
        }
    }
}
</script>

<style scoped>

</style>
