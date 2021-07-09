<template>
    <div>
        <h3 class="text-center">messages</h3>
        <ul class="list-group scrolling"
            v-if="messages && messages.length > 0"
        >
            <li class="list-group-item mb-1"
                    v-for="(row, index) in messages"
                    :class="{'border border-info': !row.is_readed}"
                >
                <h5 class="mt-0">{{ row.sender_name }} <span class="float-right">{{ row.message_created_at }}</span></h5>
                <p class="text-center m-0">{{ row.message_body }}</p>
            </li>
        </ul>
        <div v-else class="alert alert-info text-center">
            you didn't get any message
        </div>

        <alert-errors :form="form" message="There were some problems with your input." />
        <form @submit.prevent="storeMethod">
            <div class="form-group">
                <label class="col-form-label" for="receiver_id"> select user to send message him </label>
                <select id="receiver_id" v-model="form.receiver_id"
                    :class="{ 'is-invalid': form.errors.has('receiver_id') }"
                    class="form-control"
                >
                    <option value=""> .. </option>
                    <option v-for="row in allUsers" :key="row.id" :value="row.id">
                        {{ row.name }}
                    </option>
                </select>
                <has-error :form="form" field="receiver_id"/>
            </div>
            <div class="form-group" id="bodyContainer">
                <label class="col-form-label" for="body">body</label>
                <input type="text" v-model="form.body" :disabled="form.busy" :class="{ 'is-invalid': form.errors.has('body') }" class="form-control" id="body">
                <has-error :form="form" field="body"></has-error>
            </div><!-- bodyContainer -->
            <button :disabled="form.busy" class="btn btn-success text-black" type="submit"> submit </button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                allUsers: [],
                messages: [],
                form: new Form({
                    receiver_id: "",
                    body: "",
                }),
            }
        },
        methods: {
            getAllMessages(){
                axios.post(`message-index`).then(res => {
                    this.messages = res.data.payload.messages ?? []
                });
            },
            storeMethod(){
                NProgress.start()
                this.form.post(`message-store`)
                    .then((res) => {
                        NProgress.done();
                        if(res.status == 200){
                            this.form.reset();
                            Fire.$emit(`refreshMessages`);
                            swal.fire({ title: res.data.payload , icon: 'success', timer: 1000, })
                        }
                    }).catch((res) =>{
                        swal.fire({ title: res , icon: 'warning', timer: 1000, })
                        NProgress.done();
                    });
            },
            getAllUsers(){
                axios.post(`all-users`)
                    .then(res => {
                    this.allUsers = res.data.payload.allUsers ?? [];
                });
            },
        },
        mounted() {
            this.getAllMessages();
            this.getAllUsers();
        },
        created() {
            Fire.$on(`refreshMessages`, () => {
                this.getAllMessages()
            });
        },
    }
</script>
