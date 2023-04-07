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
                        <dd class="text-gray-500 text-sm">Joined In Date: {{member.joined_in}}</dd>
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


        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">1</span>
                        to
                        <span class="font-medium">10</span>
                        of
                        <span class="font-medium">97</span>
                        results
                    </p>
                </div>
<!--                <div>-->
<!--                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">-->
<!--                        <a v-if="prevPageUrl" href="{{prevPageUrl}}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">-->
<!--                            <span class="sr-only">Previous</span>-->
<!--                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
<!--                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                        <a v-if="nextPageUrl" href="{{nextPageUrl}}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">-->
<!--                            <span class="sr-only">Next</span>-->
<!--                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
<!--                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                    </nav>-->
<!--                </div>-->
            </div>
        </div>



    </div>
</template>

<script>
export default {
    name: "GamesList",
    data () {
        return {
            members: [],
            prevPageUrl: null,
            nextPageUrl: null,
        }
    },
    created() {
        this.getMembers();

    },

    methods: {
        getMembers() {
            axios.get('/scrabble/api/members')
                .then(response => {
                    this.prevPageUrl = response.data.prev_page_url;
                    this.nextPageUrl = response.data.next_page_url;
                    this.members = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
