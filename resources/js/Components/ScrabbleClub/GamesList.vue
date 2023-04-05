<template>
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-2xl font-semibold mb-4">Games List</h1>
        <div class="mb-4">
            <router-link to="/scrabble-club/games/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add Game
            </router-link>
        </div>
        <ul v-if="games.length" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <li v-for="game in games" class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="flex-1 flex flex-col p-8">
                    <div>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{game.first_player.name}} VS {{game.second_player.name}}
                        </span>
                    </div>

                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dd class="text-gray-500 text-sm">Games Date: {{game.date}}</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="-ml-px w-0 flex-1 flex">
                            <router-link :to="`/scrabble-club/game/${game.id}`" class="-ml-px relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-gray-200">
                                View Details
                            </router-link>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>

import moment from 'moment'

export default {
    name: "GamesList",
    data () {
        return {
            games: [],
        }
    },
    created() {
        this.getGames();

    },

    methods: {
        getGames() {
            axios.get('/scrabble/api/games')
                .then(response => {
                    this.games = response.data.data;
                    this.games.forEach(game => {
                        game.date = moment(game.date).format('MMM Do YY');
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
}
</script>

<style scoped>

</style>
