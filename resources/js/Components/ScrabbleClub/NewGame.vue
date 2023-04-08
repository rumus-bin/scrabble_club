<template>
    <div>
        <h1>New Game</h1>
        <form @submit.prevent="addNew">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="date">
                    Game date
                </label>
                <input v-model="newGame.date" class="border border-gray-400 p-2 w-350 rounded-md" id="date" name="date" type="date" required>
            </div>
            <div class="mb-4 w-1/2">
                <label class="block text-gray-700 font-semibold mb-2" for="first_player">
                    First Player
                </label>
                <v-select
                    id="first_player"
                    label="Select first player"
                    :items="filteredFirstMembers"
                    item-title="name"
                    item-value="id"
                    v-model="newGame.first_player_id"
                    variant="solo"
                ></v-select>
            </div>
            <div class="mb-4 w-1/2">
                <label class="block text-gray-700 font-semibold mb-2" for="second_player">
                    Second Player
                </label>
                <v-select
                    id="second_player"
                    label="Select second player"
                    :items="filteredSecondMembers"
                    item-title="name"
                    item-value="id"
                    variant="solo"
                    v-model ="newGame.second_player_id"
                ></v-select>
            </div>
            <div class="mb-4">
                <label for="score_a">Score A</label>
                <input v-model="newGame.first_player_score" type="number" id="score_a" name="score_a">
            </div>
            <div class="mb-4">
                <label for="score_b">Score B</label>
                <input v-model="newGame.second_player_score" type="number" id="score_b" name="score_b">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md" type="submit">
                    Create
                </button>
                <a class="btn text-gray-500 hover:text-gray-600 font-medium" href="#">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</template>

<script setup>
import {ref, reactive, onBeforeMount, computed} from 'vue';
import {useRoute, useRouter} from "vue-router";
const route = useRoute();
const router = useRouter();

const newGame = reactive({
    date: '',
    first_player_id: '',
    second_player_id: '',
    first_player_score: '',
    second_player_score: ''
});
const members = reactive([]);

const filteredFirstMembers = computed(() => {
    return members.filter(member => {
        return member.id !== newGame?.second_player_id;
    });
});
const filteredSecondMembers = computed(() => {
    return members.filter(member => {
        return member.id !== newGame.first_player_id;
    });
});

const getMembers = () => {
    axios.get('/scrabble/api/members')
        .then(response => {
            let data = response.data.data;
            members.push(...data);
        })
        .catch(error => {
            console.log(error);
        });
}

const addNew = () => {
    axios({
        method: 'post',
        url: '/scrabble/api/games',
        data: newGame
    })
        .then(response => {
            router.push({name: 'GamesList'});
        })
        .catch(error => {
            console.log(error);
        });
}

onBeforeMount(getMembers);
</script>

<style scoped>

</style>
