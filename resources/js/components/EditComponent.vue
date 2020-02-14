<template>
    <div class="container-sm">
        <br><br>
        <form @submit.prevent="addPost">

            <div class="row">
                <div class="col-6">
                    <label>Article Name </label>
                    <input type="text"id="articles" class="form-control" v-model="users.name">
                </div>
                <div class="col-6">
                    <label>Add Posts </label>
                    <div class="form-group" v-for="(input,k) in inputs" :key="k">

                        <input type="text" class="form-control" v-model="input.description">
                        <span>
            <i class="btn-sm btn-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">remove</i>
            <i class="btn-sm btn-success" @click="add(k)" v-show="k == inputs.length-1">add</i>
                </span>
                    </div>
                </div>

            </div>

            <button class="form-control btn btn-info">Update</button>


        </form>

    </div>

</template>

<script>
    import axios from 'axios';
    export default {

        data() {
            return {
                inputs: [
                    {
                        name: '',
                        description:'',
                    }
                ],
                users: [],
                article:{
                    name:''
                }
            }
        },
        created() {
            axios
                .get(`http://localhost:8000/api/edit/${this.$route.params.id}`)
                .then(res => {
                    //console.log(response);
                    this.users = res.data[0];
                    this.inputs =res.data;
                    console.log(this.users);
            });

        },
        methods: {
            add(index) {
                this.inputs.push({ name: '' });
                for(var i=0;i<this.inputs.length;i++){
                    console.log(this.inputs[i].name);
                }
            },
            remove(index) {
                this.inputs.splice(index, 1);
            },
            // updatePost() {
            //     let uri = `http://vuelaravelcrud.test/api/post/update/${this.$route.params.id}`;
            //     this.axios.post(uri, this.post).then((response) => {
            //         this.$router.push({name: 'posts'});
            //     });
            // }
        }
    }
</script>

