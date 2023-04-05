<template>
    <div>
        <form @submit.prevent="updateGame">
            <div class="flex flex-col">
                <label for="date">Date</label>
                <input v-model="game.date" type="date" name="date" id="date">
            </div>
            <div class="flex flex-col">
                <label for="first_player">First Player</label>
<!--                <input v-model="game.first_player.name" type="text" name="first_player" id="first_player">-->
                <v-select v-model="selectedFirstPlayer" :items="membersList" item-title="name" item-value="id"></v-select>

            </div>
            <div class="flex flex-col">
                <label for="second_player">Second Player</label>
<!--                <input v-model="game.second_player.name" type="text" name="second_player" id="second_player">-->
                <v-select v-model="selectedSecondPlayer" :items="membersList" item-title="name" item-value="id"></v-select>
            </div>
            <div class="flex flex-col">
                <label for="first_player_score">First Player Score</label>
                <input v-model="game.first_player_score" type="number" name="result" id="first_player_score">
            </div>
            <div class="flex flex-col">
                <label for="score">Second Player Score</label>
                <input v-model="game.second_player_score" type="number" name="second_player_score" id="second_player_score">
            </div>
            <div class="flex flex-col">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
import membersList from "../MembersList.vue";

export default {
    name: "GameEdit",
    data() {
        return {
            game: {
                date: '',
                first_player: {
                    name: ''
                },
                second_player: {
                    name: ''
                },
                first_player_score: '',
                second_player_score: ''
            },
            selectedFirstPlayer: {
                name: '',
                id: ''
            },
            selectedSecondPlayer: {
                name: '',
                id: ''
            },
            membersList: []
        }
    },
    created() {
        this.getGame();
        this.getMembers();
    },
    methods: {
        getMembers() {
            axios.get('/scrabble/api/members')
                .then(response => {
                    this.membersList = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateGame() {
            if (this.selectedFirstPlayer instanceof Object) {
                this.game.first_player_id = this.selectedFirstPlayer.id;
            } else {
                this.game.first_player_id = this.selectedFirstPlayer;
            }

            if (this.selectedSecondPlayer instanceof Object) {
                this.game.second_player_id = this.selectedSecondPlayer.id;
            } else {
                this.game.second_player_id = this.selectedSecondPlayer;
            }

            console.log(this.game);
            axios.put('/scrabble/api/games/' + this.$route.params.id, this.game)
                .then(response => {
                    this.$router.push('/scrabble-club/game/' + this.$route.params.id);
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getGame() {
            axios.get('/scrabble/api/games/' + this.$route.params.id)
                .then(response => {
                    this.game = response.data;
                    this.selectedFirstPlayer = this.game.first_player;
                    this.selectedSecondPlayer = this.game.second_player;
                    console.log(this.game);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>

</style>
