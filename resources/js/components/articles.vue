<template>
    <div class="container-sm">
        <br><br>
        <form @submit.prevent="addPost">

            <div class="row">
                <div class="col-6">
                    <label>Article Name </label>
                    <input type="text"id="articles" class="form-control" v-model="article.name"><br>
                    <strong>Image Upload</strong><br>
                    <input  type="file" @change="onFileChange" />

                    <div>
                        <img v-if="url" :src="url" style="width: 150px;height: 150px;border-bottom-color: #0c525d" />
                    </div>

                    <br><br>
                </div>
                <div class="col-6">
                     <label>Add Posts </label>
                    <div class="form-group" v-for="(input,k) in inputs" :key="k">

                <input type="text" class="form-control" v-model="input.name">
                <span>
            <i class="btn-sm btn-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">remove</i>
            <i class="btn-sm btn-success" @click="add(k)" v-show="k == inputs.length-1">add</i>

                </span>
            </div>
                </div>

            </div>

            <button class="form-control btn btn-info">Save</button>


        </form>

    </div>

</template>

<script>
    import axios from 'axios';
    import { BarLoader } from '@saeris/vue-spinners'
    export  default {

        data() {

            return {
                components: {
                    BarLoader
                },
                styleObject: {
                    color: 'red',
                    fontSize: '13px'
                },
                url: null,
                inputs: [
                    {
                        name: ''
                    }
                ],
                article: [
                    {
                        name: 'ddd'
                    }
                ]
            }
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
                addPost(index){

                    let el = document.getElementById("articles");

                        axios.post('./api/posts/create', {

                            name:el.value,
                            posts:this.inputs

                        })
                            .then((response) => {
                                window.location.href='/';
                                alert('Success add Artist');
                                 console.log(response);

                            })

            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            }

        }


    }
</script>

