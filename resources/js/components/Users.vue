<template>
    <div>
        <h3 class="text-center">users</h3>
        <ul class="list-group scrolling"
            v-if="availableUsers && availableUsers.length > 0"
        >
            <li
                v-for="(row, index) in availableUsers" :key="index" :value="row.id"
                class="list-group-item d-flex-between"
            >
                <span> {{ row.name }} </span>
                <!--
                <i
                    v-if="row.status == 'accepted'"
                    class="cursor-pointer fa fa-users fa-fw"
                ></i>
                <i
                    v-else-if="row.status == 'pending'"
                    class="cursor-pointer fa fa-pause-circle fa-fw fa-2x"
                    @click="submitForm(row.id, 'canceled')"
                ></i>
                -->
                <i
                    class="cursor-pointer fa fa-plus fa-fw fa-2x"
                    @click="submitForm(row.id, 'accepted')"
                ></i>
            </li>
        </ul>
        <div v-else class="alert alert-info text-center">
            there is no users
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                availableUsers: [],
                form: new Form({
                    receiver_id: "",
                    status: "",
                }),
            }
        },
        methods: {
            getAvailableUsers(){
                axios.post(`available-users`)
                    .then(res => {
                    this.availableUsers = res.data.payload.availableUsers ?? [];
                });
            },
            submitForm(receiver_id, status){
                this.form.receiver_id = receiver_id
                this.form.status = status
                NProgress.start()
                this.form.post(`friend-store`)
                    .then((res) => {
                        NProgress.done();
                        if(res.status == 200){
                            this.form.reset();
                            Fire.$emit(`refreshAvailableUsers`);
                            swal.fire({ title: res.data.payload , icon: 'success', timer: 1000, })
                        }
                    }).catch((res) =>{
                        swal.fire({ title: res , icon: 'warning', timer: 1000, })
                        NProgress.done();
                    });
            }

        },
        mounted() {
            this.getAvailableUsers();
        },
        created(){
            //
        },
        created() {
            Fire.$on(`refreshAvailableUsers`, () => {
                this.getAvailableUsers()
            });
        },
    }
</script>
