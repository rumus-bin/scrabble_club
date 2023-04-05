<template>
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-2xl font-semibold mb-4">Game View</h1>
        <div>
            <p class="text-bold text-base font-bold">Players:</p>
            <div>
                <p class="text-bold font-medium">First Player: </p>{{ game.first_player.name }}
               <p class="font-medium">Have score: </p>{{ game.first_player_score }}
            </div>
            VS
            <div>
                Second Player: {{ game.second_player.name }}
                <p>Have score: {{ game.second_player_score }}</p>
            </div>
        </div>
        <p>Game Winner: {{ getWinner }}</p>
        <p>Game Date: {{ game.date }}</p>

    </div >
    <div class="flex justify-between">
        <div class="">
            <button @click="gotToEditGame" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </button>
        </div>
        <div class="gap-1">
            <button @click="deleteGame" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Delete
            </button>
        </div>
    </div>

    <div class="button btn-block">
        <RouterLink to="/scrabble-club/games">&lt; Back to Games</RouterLink>
    </div>
</template>

<script>
import {useRoute} from "vue-router";
import {ref, reactive, onMounted, computed} from "vue";

const route = useRoute();
export default {
    name: "GameView",
    data () {
        return {
            game: {
                name: '',
                first_player: {
                    name: ''
                },
                second_player: {
                    name: ''
                },
                first_player_score: 0,
                second_player_score: 0,
                date: ''
            },
        }
    },
    methods: {
        gotToEditGame() {
            this.$router.push('/scrabble-club/game/edit/' + this.$route.params.id);
        },
        async deleteGame() {
            const response = await fetch('/scrabble/api/games/' + this.$route.params.id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            });
            this.$router.push('/scrabble-club/games');
        }
    },
    computed: {
        getWinner() {
            if (this.game.first_player_score > this.game.second_player_score) {
                return this.game.first_player.name;
            } else if (this.game.first_player_score < this.game.second_player_score) {
                return this.game.second_player.name;
            } else {
                return 'Draw';
            }
        }
    },
    async created() {
        const response = await fetch('/scrabble/api/games/' + this.$route.params.id);
        this.game = await response.json();
    }

}
</script>

<style scoped>

</style>
