<template>
    <div class="h-full flex flex-col items-stretch bg-purple-500">
        <div class="text-white h-10 flex justify-between items-center mb-2 bg-purple-600">
            <div class="ml-2 w-1/3">X</div>
            <div class="text-lg opacity-50 cursor-pointer hover:opacity-75">Laravello</div>
            <div class="mr-2 w-1/3 flex justify-end">X</div>
        </div>

        <div class="h-full flex flex-1 flex-col items-stretch">
            <div class="mx-4 mb-2 text-white font-bold text-lg">
                <span v-if="$apollo.queries.board.loading">Loading...</span>
                <span v-else>{{ board.title }}</span>
            </div>
            <div class="flex flex-1 items-start overflow-x-auto mx-2" v-if="board">
                <List
                    :list="list" v-for="list in board.lists" :key="list.id"
                    @card-added="updateQueryCache($event)"
                    @card-deleted="updateQueryCache($event)"
                    @card-updated="updateQueryCache($event)"
                ></List>
            </div>
        </div>
    </div>
</template>

<script>
import List from "./components/List";
import BoardQuery from './graphql/BoardWithListsAndCards.gql'
import {EVENT_CARD_ADDED, EVENT_CARD_DELETED, EVENT_CARD_UPDATED} from "./constants";


export default {
    components: {List},
    apollo: {
        board: {
            query: BoardQuery,
            variables: {
                id: 1
            }
        }
    },
    methods: {
        updateQueryCache(event) {
            const data = event.store.readQuery({
                query: BoardQuery,
                variables: {id: Number(this.board.id)},
            });

            const listById = () => data.board.lists.find(list => list.id === event.list_id);

            switch (event.type) {
                case EVENT_CARD_ADDED:
                    listById().cards.push(event.data);
                    break;
                case EVENT_CARD_DELETED:
                    listById().cards = listById().cards.filter(
                        card => card.id !== event.list_id
                    );
                    break;
                case EVENT_CARD_UPDATED:
                    listById().cards = listById().cards.filter(
                        card => card.id === event.list_id
                    ).title = event.data.title;
                    break;
            }
            event.store.writeQuery({query: BoardQuery, data});
        }
    },
}
</script>

