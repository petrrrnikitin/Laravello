<template>
    <CardEditor
        v-model="title"
        @closed="closed"
        @saved="addCard"
        label="Add new card"
    >
    </CardEditor>
</template>

<script>

import CardAdd from "../graphql/CardAdd.gql";
import {EVENT_CARD_ADDED} from "../constants";
import CardEditor from "./CardEditor";
import {mapState} from "vuex";

export default {
    name: "CardAddEditor",
    components: {CardEditor},
    props: {
        list: Object
    },
    computed: mapState({
        userId: state => state.user.id
    }),
    data() {
        return {
            title: null
        }
    },
    methods: {
        addCard() {
            const self = this;
            this.$apollo.mutate({
                mutation: CardAdd,
                variables: {
                    title: this.title,
                    list_id: this.list.id,
                    order: this.list.cards.length + 1,
                    owner_id: this.userId
                },
                update(store, {data: {cardAdd}}) {
                    self.$emit("added", {store, data: cardAdd, type: EVENT_CARD_ADDED});
                    self.closed();
                }
            });
        },
        closed() {
            this.$emit('closed');
        }
    }
}
</script>

<style scoped>

</style>
