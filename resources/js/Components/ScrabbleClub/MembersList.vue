<template>
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-2xl font-semibold mb-4">Members List</h1>
        <div class="mb-4">
            <router-link to="/scrabble-club/member/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create New Member
            </router-link>
        </div>


        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200" v-for="member in members" :key="member.id">
                <div class="flex-1 flex flex-col p-8">
                    <img class="w-32 h-32 flex-shrink-0 mx-auto bg-black rounded-full" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="">
                    <h3 class="mt-6 text-gray-900 text-sm font-medium">{{member.name}} {{member.surname}}</h3>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dd class="text-gray-500 text-sm mb-2">Member 1 details</dd>
                        <dd class="text-gray-500 text-sm">Joined In Date: {{dateFormatted(member.joined_in)}}</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="-ml-px w-0 flex-1 flex">
                            <router-link :to="`/scrabble-club/member/${member.id}`" class="-ml-px relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-gray-200">
                                View Details
                            </router-link>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <pagination :links="links" @switchPage="getMembers"></pagination>

    </div>
</template>

<script>
import moment from "moment";
import Pagination from "../partials/Pagination.vue";

const defaultUrl = '/scrabble/api/members';
const paginationUrl = '/scrabble/api/members?page=';
export default {
    name: "GamesList",
    components: {
        Pagination
    },
    data () {
        return {
            members: [],
            prevPageUrl: null,
            nextPageUrl: null,
            links: {},
            defaultUrl,
            paginationUrl
        }
    },
    created() {
        this.getMembers();

    },

    methods: {
        getMembers(forPage = null) {
            axios.get( forPage ? this.paginationUrl + forPage : this.defaultUrl)
                .then(response => {
                    this.links.current_page = response.data.current_page;
                    this.links.last_page = response.data.last_page;
                    this.links.from = response.data.from;
                    this.links.to = response.data.to;
                    this.links.total = response.data.total;


                    this.links.prev_page_url = response.data.prev_page_url;
                    this.links.next_page_url = response.data.next_page_url;
                    this.members = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        dateFormatted(date) {
            return moment(date).format('MMMM Do YYYY');
        }
    }
}
</script>

<style scoped>

</style>
