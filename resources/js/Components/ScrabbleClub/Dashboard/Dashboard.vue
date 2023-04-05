<template>
    <!-- component -->
    <section class="w-11/12 pa-2 bg-gray-300">
        <div class="flex justify-center">
            <h2 class="text-2xl font-bold text-gray-600">Leaders table</h2>
        </div>

        <div v-if="leadersList.length" class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Games</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Avg score</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr v-for="leader in leadersList" class="hover:bg-gray-50">
                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                        <div class="relative h-10 w-10">
                            <img
                                class="h-full w-full rounded-full object-cover object-center"
                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt=""
                            />
                            <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                        </div>
                        <div class="text-sm">
                            <div class="font-medium text-gray-700">{{leader.name}} {{leader.surname}}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                    >
                      <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        <span class="text-gray-500">{{leader.games_count}}</span>
                      </span>
                    </td>
                    <td class="px-6 py-4">{{leader.avg_score}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else class="flex justify-center">
            <p class="text-xl font-bold text-gray-600">There are no leaders in your club. Please add at least 10 games for any of the members!</p>
        </div>
    </section>

    <section class="w-11/12 pa-2 bg-gray-300">
        <div class="flex justify-center">
            <h2 class="text-2xl font-bold text-gray-600">Best games statistic</h2>
        </div>

        <div v-if="bestGames.length" class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Match up</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Highest score</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Winner</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Game date</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr v-for="game in bestGames" class="hover:bg-gray-50">
                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                        <div class="text-sm">
                            <div class="font-medium text-gray-700">{{game.match_up}}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                    >
                      <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        <span class="text-gray-500">{{game.highest_score}}</span>
                      </span>
                    </td>
                    <td class="px-6 py-4">{{game.highest_scorer}}</td>
                    <td class="px-6 py-4">{{ gameDate }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else class="flex justify-center">
            <p class="text-xl font-bold text-gray-600">There are no games in your club. Please add at least 10 games!</p>
        </div>
    </section>

</template>

<script>
import moment  from "moment";
export default {
    name: "Dashboard",
    data() {
        return {
            leadersList: [],
            bestGames: []
        }
    },
    methods: {
        getLeadersList() {
            axios.get('/scrabble/api/dashboard/leaders-table')
                .then(response => {
                    this.leadersList.push(...response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getBestGames() {
            axios.get('/scrabble/api/dashboard/games-statistic')
                .then(response => {
                    this.bestGames.push(...response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    computed: {
        gameDate() {
            return moment(this.bestGames.date).format('MMMM d, YYYY');
        }
    },
    created() {
        this.getLeadersList();
        this.getBestGames();
    }
}
</script>

<style scoped>

</style>
