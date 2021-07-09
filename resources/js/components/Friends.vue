<template>
    <div>
        <h3 class="text-center">friends</h3>
        <ul class="list-group scrolling"
            v-if="userFriends && userFriends.length > 0"
        >
            <li v-for="(row, index) in userFriends" :key="index" :value="row.id" class="list-group-item d-flex-between">
                <span> {{ row.name }} </span>
            </li>
        </ul>
        <div v-else class="alert alert-info text-center">
            you don't have any friends
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userFriends: [],
            }
        },
        methods: {
            getUserFriends(){
                axios.post(`user-friends`)
                    .then(res => {
                    this.userFriends = res.data.payload.userFriends ?? [];
                });
            },
        },
        mounted() {
            this.getUserFriends();
        },
        created(){
            //
        }
    }
</script>
