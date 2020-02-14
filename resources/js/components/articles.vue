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

                    <div id="preview">
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
    export  default {

        data() {
            return {
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
                    this.article.push({ name: '' });
                    let el = document.getElementById("articles");
                    //for(var i=0;i<this.inputs.length;i++) {
                        axios.post('./api/posts/create', {

                            name:el.value,
                            posts:this.inputs

                        })
                            .then((response) => {
                                alert('Success add Artist')
                                 console.log(response)
                            })
                   // }
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            }

        }

        //     return {
        //         inputs: [
        //             {
        //                 name: ''
        //             }
        //         ],
        //         articles: [],
        //         article: {
        //             id: '',
        //             name: '',
        //             age: '',
        //         },
        //         pagination: {},
        //         edit: false,
        //
        //     };
        // },
        // created() {
        //
        //     this.FetchAPI();
        //     this.add();
        //     this.remove();
        // },
        // methods: {
        //     add(index) {
        //         this.inputs.push({ name: '' });
        //     },
        //     remove(index) {
        //         this.inputs.splice(index, 1);
        //     },
        //     FetchAPI(page_url) {
        //         let vm = this;
        //         page_url = page_url || '/api/person';
        //
        //         fetch(page_url)
        //             .then(res => res.json())
        //             .then(res => {
        //                 this.articles = res.data;
        //                 vm.makePagination(res.meta, res.links);
        //             })
        //
        //     },
        //     makePagination(meta, links) {
        //         let pagination = {
        //             current_page: meta.current_page,
        //             last_page: meta.last_page,
        //             next_page: links.next,
        //             prev_page: links.prev,
        //
        //         }
        //         this.pagination = pagination;
        //
        //     },
        //     AddArticle() {
        //
        //         axios.post('/person/create', {
        //             name:this.article.name,
        //             age: this.article.age,
        //         })
        //             .then(response => {
        //                 this.articles = response.data;
        //                 this.push(this.articles);
        //             })
        //             .catch(error => {
        //                 console.log(error.response)
        //             });
        //
        //     }
        //
        // },
        // deleteArticls(id) {
        //     let uri = `http://localhost:8000/api/person/${id}`;
        //     this.axios.delete(uri).then(response => {
        //         this.articles.splice(this.articles.indexOf(id), 1);
        //     });
        // }

    }
</script>

