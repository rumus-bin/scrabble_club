<template>
    <form class="w-full max-w-md mx-auto" @submit.prevent="submitForm">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">
                Name:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" v-model="name" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="surname">
                Surname:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="surname" type="text" v-model="surname" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="surname">
                Joined In:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="joined_in" type="date" v-model="joined_in" required>
        </div>
        <div v-for="(contact, index) in contacts" :key="index" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">{{ getContactTypeName(contact.type) }}:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" v-model="contact.value" :name="contact.type" required>
            <button class="inline-block align-bottom text-sm font-medium leading-none text-red-500 hover:text-red-700 mb-2" type="button" @click="removeContact(index)">Remove</button>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Contact Type:</label>
            <div class="flex">
                <select class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="newContact.type">
                    <option v-for="type in contactTypeList" :value="type">{{ getContactTypeName(type) }}</option>
                </select>
                <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-4" type="text" v-model="newContact.value" :name="newContact.type" >
                <button class="ml-2 py-2 px-3 rounded text-white font-bold bg-blue-500 hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="button" @click="addContact">Add Contact</button>
            </div>
        </div>
        <button class="w-full py-2 px-4 rounded text-white font-bold bg-green-500 hover:bg-green-700 focus:outline-none focus:shadow-outline" type="submit">Create Member</button>
    </form>
</template>

<script>
const ContactTypes = {
    EMAIL: 'email',
    PRIMARY_EMAIL: 'primary_email',
    PHONE: 'phone',
};
export default {
    name: 'NewMember',
    data() {
        return {
            name: '',
            contacts: [],
            joined_in: '',
            newContact: {
                type: 'email',
                value: '',
            },
            contactTypeList: [],
        };
    },
    methods: {
        getContactTypes() {
            axios.get('/scrabble/api/contacts/types')
                .then(response => {
                    this.ContactTypes = response.data.data;
                    this.contactTypeList = Object.keys(this.ContactTypes);
                    console.log(this.ContactTypes);
                    console.log(this.contactTypeList);
                })
                .catch(error => {
                console.error('Error retrieving contacts data:', error);
            });
        },
        submitForm() {
            axios.post('/scrabble/api/members', {
                name: this.name,
                surname: this.surname,
                joined_in: this.joined_in,
                contacts: this.contacts,
            }).then(response => {
                console.log('Member created successfully:', response.data);
                // Reset the form after submission
                this.name = '';
                this.contacts = [];
                this.newContact = {
                    type: 'email',
                    value: '',
                };
            }).catch(error => {
                console.error('Error creating member:', error);
            });
        },
        addContact() {
            if (!this.newContact.value) {
                return;
            }
            console.log(this.newContact);
            //Check if a contact of this type already exists
            if (this.contacts.some(contact => contact.type === 'primary_email' && this.newContact.type === 'primary_email')) {
                alert(`Contact of type ${this.getContactTypeName(this.newContact.type)} already exists`);
                return;
            }
            this.contacts.push({ ...this.newContact });
            this.newContact.value = '';
        },
        removeContact(index) {
            this.contacts.splice(index, 1);
        },
    },
    computed: {
        getContactTypeName() {
            return (type) => {
                const contactTypeName = this.ContactTypes[type];
                return contactTypeName ? contactTypeName : type;
            };
        },
    },
    mounted() {
        this.getContactTypes();
    },
};
</script>
