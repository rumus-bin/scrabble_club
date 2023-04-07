<template>







    <div v-if="member" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-4 bg-white shadow-lg rounded-lg">

            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Member Details</h1>
                <RouterLink
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    :to="`/scrabble-club/member/edit/${$route.params.id}`"
                > Edit </RouterLink>
                <div>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </div>
                <div>
                    <RouterLink to="/scrabble-club/members">&lt;Back to Members</RouterLink>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Name</h2>
                    <p class="text-gray-700"> {{ member.full_name}}</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Joined In</h2>
                    <p class="text-gray-700">{{ member.joined_in }}</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Games Won:</h2>
                    <p class="text-gray-700">{{ member.games_won }}</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Games Lost:</h2>
                    <p class="text-gray-700">{{ member.games_lost }}</p>
                </div>
                <div v-if="member.avg_score">
                    <h2 class="text-lg font-semibold mb-2">Avg score:</h2>
                    <p class="text-gray-700">{{member.avg_score}}</p>
                </div>
            </div>
            <hr class="my-4 border-gray-200">
            <div v-if="member.contacts.length">
                <h2 class="text-lg font-semibold mb-2">Member contacts</h2>
                <div class="bg-white shadow-md rounded-md overflow-hidden">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-100">
                        <tr class="text-left text-gray-700 font-bold">
                            <th class="w-1/4 px-4 py-2">Type</th>
                            <th class="w-3/4 px-4 py-2">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="contact in member.contacts" :key="contact.id" class="border-t border-gray-200">
                            <td class="px-4 py-2">{{ contact.type }}</td>
                            <td class="px-4 py-2">{{ contact.value }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useRoute} from "vue-router";

const route = useRoute();

export default {
    name: "MemberView",
    data () {
        return {
            member: {
                id: '',
                name: '',
                surname: '',
                joined_in: '',
                contacts: [],
                games_won: '',
                games_lost: '',
                avg_score: '',
            },
        }
    },
    async created() {
        const response = await fetch('/scrabble/api/members/' + this.$route.params.id);
        this.member = await response.json();
        console.log(this.member);
    },
}
</script>

<style scoped>

</style>
