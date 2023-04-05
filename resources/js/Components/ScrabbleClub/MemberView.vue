<template>
    <div v-if="member" class="px-4 py-6 sm:px-0">
        <h1 class="text-2xl font-semibold mb-4">Member View</h1>
        <p>One Member View</p>

        <p>Member ID: {{ member.id }}</p>
        <p class="mb-4">Member Name: {{ member.full_name}}</p>
        <div>
            <p class="mb-4 text-black font-weight-bold">Member Games Info</p>
            <p>Member Games Won: {{ member.games_won }}</p>
            <p>Member Games Lost: {{ member.games_lost }}</p>
            <p>Member Avg score: {{member.avg_score}}</p>
        </div>
        <div v-if="member.contacts.length">
            <p >Member Contacts:</p>
            <ul>
                <li  v-for="contact in member.contacts" :key="contact.id">
                    <p>{{ contact.type }}</p>
                    <p>{{ contact.value }}</p>
                </li>
            </ul>
        </div>

        <p>Member Joined In: {{ member.joined_in }}</p>
    </div>
    <div>
        <RouterLink
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            :to="`/scrabble-club/member/edit/${$route.params.id}`"
        > Edit </RouterLink>
    </div>
    <div>
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Delete
        </button>
    </div>
    <div>
        <RouterLink to="/scrabble-club/members">&lt;Back to Members</RouterLink>
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
    },
}
</script>

<style scoped>

</style>
