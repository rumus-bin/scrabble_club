<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="/scrabble-club" class="flex-shrink-0 flex items-center">
                        <!-- Add your logo here -->
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Workflow">
                        <span class="ml-2 font-semibold text-xl text-gray-800">Scrabble Club</span>
                    </a>
                </div>
                <div class="flex">
                    <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
<!--                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">-->
<!--                            Games-->
<!--                        </a>-->
<!--                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">-->
<!--                            Members-->
<!--                        </a>-->
                        <router-link to="/scrabble-club/games" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Games
                        </router-link>
                        <router-link to="/scrabble-club/members" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Members
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <router-view></router-view>
    </main>
</template>

<script>
import 'vuetify/dist/vuetify.css'; // Import Vuetify's CSS file
import {useRoute} from "vue-router";

const route = useRoute();

// import GamesList from "@/Components/ScrabbleClub/GamesList.vue";
export default {
    name: "App",
    components: {
        // GamesList
    },
    created() {
        this.$router.push('/scrabble-club/dashboard');
    }
}
</script>

<style scoped>

</style>
