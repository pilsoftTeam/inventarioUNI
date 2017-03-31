<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <h4 class="text-center">Usuarios</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Fecha creacion</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody v-for="item in users">
                        <tr v-for="name in item.get_users">
                            <td class="text-center">{{name.name}}</td>
                            <td class="text-center">{{name.email}}</td>
                            <td class="text-center">{{item.get_roles.rol}}</td>
                            <td class="text-center">{{name.created_at}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-warning btn-sm"
                                            data-toggle="modal"
                                            href="#editUsers"
                                            @click="edit(item)">
                                        Editar
                                    </button>
                                    <button type="button"
                                            data-toggle="modal"
                                            href="#deleteUser"
                                            class="btn btn-danger btn-sm"
                                            @click="erase(item)">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h4 class="text-center">Acciones</h4>
                    <br>
                    <button class="btn btn-success btn-block"
                            data-toggle="modal"
                            href="#addUsers">
                        Agregar un nuevo usuario
                    </button>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addUsers">
            <div class="modal-dialog">
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
        </div>

        <div class="modal fade" id="editUsers">
            <div class="modal-dialog">

                <div class="modal-content">


                    <form action="" method="post" role="form" @submit.prevent="submitEdition">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Editar usuario</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombre :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   name="nombre"
                                                   id="nombre"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email :</label>
                                        <div class="col-sm-10">
                                            <input type="email"
                                                   name="email"
                                                   id="email"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="roles" class="col-sm-2 control-label">Rol :</label>
                                        <div class="col-sm-10">
                                            <select name="name" id="roles" class="form-control">
                                                <option value=""> -- Select One --</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Terminar</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>


        <div class="modal fade" id="deleteUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Modal body ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

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
                },
                selectedUserForEdition: '',
                selectedUserForDeletion: '',
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
                    $('#addUsers').modal('hide');
                    this.getUsers();
                }).catch(e => {
                    console.log(e)
                })
            },
            edit(item){
                this.selectedUserForEdition = item;
            },
            erase(item){
                console.log(item)
            },

            submitEdition(){

            },
            submitDeletion(){

            }

        },
        computed: {},
        components: {},
    }
</script>
