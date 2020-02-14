<style>

</style>
<template>
    <div class="container-sm">
        <br><br>
        <form @submit.prevent="addPost">

            <div class="row">
                <div class="col-sm-6">
                    <label>Image Upload :</label><br>

                    <div style="border-style: solid;border-width: thin;width: 360px;height: 150px;">

                        <img v-if="url" :src="url" style="border:1px;width: 360px;height: 150px;border-bottom-color: #0c525d"alt="..." class="rounded" />

                    </div>
                    <br>
                    <input class="btn-sm btn-light" style="overflow: hidden" type="file" size="10" @change="onFileChange" />
                    <br>
                </div>
                <div class="col-6">
                    <label>Article Name </label>
                    <input type="text"id="articles" class="form-control" v-model="article.name"><br>
                     <label>Add Posts </label>
                    <div class="form-group" v-for="(input,k) in inputs" :key="k">

                <input type="text" class="form-control" v-model="input.name">
                <span>
            <i class="btn-sm btn-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">remove</i>
            <i class="btn-sm btn-success" @click="add(k)" v-show="k == inputs.length-1">add</i>

                </span>
            </div>
                    <div class="vld-parent">
                        <loading :active.sync="isLoading"
                                 :can-cancel="true"
                                 :on-cancel="onCancel"
                                 :is-full-page="fullPage"></loading>
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
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export  default {

        data() {

            return {
                isLoading: false,
                fullPage: true,
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
        components: {
            Loading
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
                    this.isLoading = true;
                    // simulate AJAX
                    setTimeout(() => {
                        this.isLoading = false
                    },1000);
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

