<template>
    <div>
        <h1 class="text-2xl font-bold">Edit Member</h1>
        <form @submit.prevent="updateMember" >
            <div class="flex flex-col">
                <label for="name">Name</label>
                <input v-model="member.name" type="text" name="name" id="name"  >
            </div>
            <div class="flex flex-col">
                <label for="surname">Surname</label>
                <input v-model="member.surname" type="text" name="surname" id="surname">
            </div>
<!--            <div class="flex flex-col">-->
<!--                <label for="phone">Emails</label>-->
<!--                <input type="text" name="emails[]" id="emails" multiple>-->
<!--            </div>-->
<!--            <div class="flex flex-col">-->
<!--                <label for="phone">Phone</label>-->
<!--                <input type="text" name="phone" id="phone">-->
<!--            </div>-->
            <div class="flex flex-col">
                <label for="joined_in">Joined In Date</label>
                <input v-model="member.joined_in" type="date" name="joined_in" id="joined_in">
            </div>
            <div class="flex flex-col">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>


</template>

<script>
export default {
    name: "MemberEdit",
    data() {
        return {
            member: {
                name: '',
                surname: '',
                joined_in: ''
            }
        }
    },
    mounted() {
        this.getMember();
    },
    methods: {
        getMember() {
            axios.get('/scrabble/api/members/' + this.$route.params.id)
                .then(response => {
                    this.member = response.data;
                    console.log(this.member);
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateMember() {
            axios.put('/scrabble/api/members/' + this.$route.params.id, this.member)
                .then(response => {
                    this.$router.push('/scrabble-club/member/' + this.$route.params.id);
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
