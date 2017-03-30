<template>
    <div>
        <div class="container">
            <div class="row">
                <h3 class="text-center">Usuarios</h3>
                <hr>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Fecha creacion</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody v-for="item in users">
                                <tr v-for="name in item.get_users">
                                    <td>{{name.name}}</td>
                                    <td>{{name.email}}</td>
                                    <td>Rol</td>
                                    <td>{{name.created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm">Accion</button>
                                            <button type="button" class="btn btn-warning btn-sm">Editar</button>
                                            <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                                        </div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <button class="btn btn-success pull-right"
                        data-toggle="modal"
                        href="#addUsers">
                    Agregar un nuevo usuario
                </button>
            </div>
        </div>


        <div class="modal fade" id="addUsers">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Agregar usuarios</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre completo</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="name"
                                               class="form-control"
                                               v-model="addUser.nombre"
                                               required="required">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                               name="name"
                                               class="form-control"
                                               v-model="addUser.email"
                                               required="required">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <label for="inputID" class="col-sm-2 control-label">Rol</label>
                                    <div class="col-sm-10">
                                        <select v-model="addUser.idRol" name="name" id="inputID"
                                                class="form-control">
                                            <option v-for="item in roles" :value="item.id">{{item.rol}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">Cerrar
                        </button>
                        <button type="button"
                                class="btn btn-primary"
                                @click="addUsers">Guardar
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>

    export default {
        mounted() {
            this.getUsers();
            this.getRoles();
        },

        data(){
            return {
                users: '',
                roles: '',
                addUser: {
                    nombre: '',
                    email: '',
                    idRol: ''
                }
            }
        },

        methods: {
            getUsers(){
                axios.get('api/get/usuarios').then(r => {
                    this.users = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            getRoles(){
                axios.get('api/get/roles').then(r => {
                    this.roles = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            addUsers(){
                let user = this.addUser;
                axios.post('api/add/user', user).then(r => {
                    console.log(r.data)
                }).then(e => {
                    console.log(e)
                })
            }
        },
        computed: {},
        components: {},
    }
</script>
