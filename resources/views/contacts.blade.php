<header>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</header>
    <div id="app">

        <div class="col-md-12">
            <div class="clearfix">
                <span>Laravel - Vue Js CRUD</span>
                <a class="btn btn-success btn-sm pull-right" @click="create()">Add New</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact List</h3>
                </div>
                <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>PHONE</td>
                        <td>ACTION</td>
                    </tr>

                    <tr v-for="row in data">
                        <td>@{{row.id}}</td>
                        <td>@{{row.name}}</td>
                        <td>@{{row.phone}}</td>
                        <td>
                            <button @click="edit(row)"
                                    type="button"
                                    class="btn btn-xs btn-warning"
                                    title="Edit Record"><i class="fa fa-edit"></i></button>
                            <button @click="deleteRecord(row)"
                                    type="button"
                                    class="btn btn-xs btn-danger"
                                    title="Delete Record"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>

                </table>
            </div>

        </div>


        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal" aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title">@{{isInsert?'Create':'Edit'}} Contact</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" v-model="Contact.id">

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control input-sm" type="text" v-model="Contact.name">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control input-sm" type="number" v-model="Contact.phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button v-if="isInsert" type="button" class="btn btn-primary"
                                @click="store(Contact)">Save
                        </button>
                        <button v-if="!isInsert" type="button" class="btn btn-primary"
                                @click="update(Contact)">Update
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <!--app instance end-->



    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>


    <script>
        var csrtToken = '{{csrf_token()}}';
        var adminUrl = '{{url('admin')}}';

        var app = new Vue({
            el: '#app',
            data: {
                data: [],
                isInsert: true,
                Contact: {id:null,name: null,phone: null}
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    this.$http.get('http://localhost:8000' + '/contacts/data')
                        .then(function (res) {
                            this.data = res.data
                        })
                },
                create: function () {
                    this.isInsert = true,
                        this.Contact = {}
                    $('#modal').modal()
                },
                store: function (data) {
                    if (!confirm('Are you sure?')) return;
                    data._token = csrtToken;
                    this.$http.post('http://localhost:8000' + '/contacts/store', data)
                        .then(function (res) {
                            this.init();
                            $('#modal').modal('hide');
                            this.Contact = {}
                        })
                },

                edit: function (row) {
                    this.isInsert = false,
                        this.Contact = row;
                    $('#modal').modal();
                },
                update: function (data) {
                    if (!confirm('Are you sure?')) return;
                    data._token = csrtToken;
                    this.$http.post('http://localhost:8000' + '/contacts/update', data)
                        .then(function (res) {
                            this.init()
                            $('#modal').modal('hide');
                            this.Contact = {}

                        })
                },
                deleteRecord: function (row) {
                    if (!confirm('Are you sure?')) return;
                    row._token = csrtToken;
                    this.$http.post('http://localhost:8000' + '/contacts/delete', row)
                        .then(function (res) {
                            this.init()
                        })
                }
            }
        })
    </script>
