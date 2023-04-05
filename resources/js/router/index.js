import { createRouter, createWebHistory } from 'vue-router'
import GamesList from '../Components/ScrabbleClub/GamesList.vue'
import MembersList from "../Components/ScrabbleClub/MembersList.vue";
import GameView from "../Components/ScrabbleClub/GameView.vue";
import MemberView from "../Components/ScrabbleClub/MemberView.vue";
import NewGame from "../Components/ScrabbleClub/NewGame.vue";
import MemberEdit from "../Components/ScrabbleClub/Member/MemberEdit.vue";
import GameEdit from "../Components/ScrabbleClub/Game/GameEdit.vue";
import Dashboard from "../Components/ScrabbleClub/Dashboard/Dashboard.vue";

const routes = [
    {
        path: '/scrabble-club/dashboard',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/scrabble-club/games',
        name: 'GamesList',
        component: GamesList
    },
    {
        path: '/scrabble-club/members',
        name: 'MembersList',
        component: MembersList
    },
    {
        path: '/scrabble-club/game/:id',
        name: 'GameView',
        component: GameView
    },
    {
        path: '/scrabble-club/game/edit/:id',
        name: 'GameEdit',
        component: GameEdit
    },
    {
        path: '/scrabble-club/member/:id',
        name: 'MemberView',
        component: MemberView
    },
    {
        path: '/scrabble-club/member/edit/:id',
        name: 'MemberEdit',
        component: MemberEdit
    },
    {
        path: '/scrabble-club/games/create',
        name: 'NewGame',
        component: NewGame
    }
]

const index = createRouter({
    history: createWebHistory(),
    routes
})

export default index
