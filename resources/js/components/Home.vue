<template>
   <div class=" card card-body">

       <table class="table table-bordered">
           <tr>
               <th>ID</th>
               <th>Article</th>
               <th>Action</th>
           </tr>
            <tr v-for="(art, index) in users" :key="art.id">

                <td>{{ art.id }}</td>
                <td>{{ art.name }}</td>
                <td>
                    <router-link :to="{ name: 'edit',params: { id: art.id } }"><button class="btn btn-info">edit</button></router-link>
                    <button v-on:click="deleteArticls(art.id,index)" class="btn btn-danger">delete</button>
                </td>
            </tr>

       </table>
       <div class="vld-parent">
           <loading :active.sync="isLoading"
                    :can-cancel="true"
                    :on-cancel="onCancel"
                    :is-full-page="fullPage"></loading>
       </div>
       <nav aria-label="Page navigation example">
           <ul class="pagination">
               <li v-bind:class="[{disabled: !pagination.prev_page}]" v-on:click="fetchData(pagination.prev_page)" class="page-item"><a class="page-link" href="#">Previous</a></li>
               <li class="page-item"><a class="page-link" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
               <li class="page-item"><a class="page-link" href="#" v-on:click="fetchData(pagination.next_page)" v-bind:class="[{disabled: !pagination.next_page}]">Next</a></li>
           </ul>
       </nav>
   </div>
</template>
<script>
    import axios from 'axios';
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        data() {
            return {
                isLoading: false,
                fullPage: true,
                users: [],
                error: null,
                pagination:{},

            }

        },
        created() {
            this.fetchData();
        },
        components: {
            Loading
        },
        methods: {
            fetchData(pageUrl) {
                let vm =this;
                pageUrl=pageUrl ||'/api/posts'
                this.error = this.users = null;
                this.isLoading = true;
                // simulate AJAX
                setTimeout(() => {
                    this.isLoading = false
                },1000);
                axios
                    .get(pageUrl)
                    .then(res => {
                        this.users = res.data.data;
                        vm.makePagination(res.data.meta,res.data.links);
                    });
            },
            deleteArticls(id,index) {
                let uri = `http://localhost:8000/api/posts/${id}`;
                if (confirm('are you sure?'))
                {
                    this.isLoading = true;
                    // simulate AJAX
                    setTimeout(() => {
                        this.isLoading = false
                    },1000);
                    axios.delete(uri).then(response => {
                        this.users.splice(index, 1);
                    });
                }
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page: links.next,
                    prev_page: links.prev,

                }
                this.pagination = pagination;
                console.log(this.pagination);

            },

        }
    }
</script>
