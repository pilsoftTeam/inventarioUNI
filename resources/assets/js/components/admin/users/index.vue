<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h4 class="text-center">Usuarios</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Rut</th>
                            <th class="text-center">Fono</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Fecha creacion</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody v-for="item in users">
                        <tr v-for="name in item.get_users">
                            <td class="text-center">{{name.name}}</td>
                            <td class="text-center">{{name.email}}</td>
                            <td class="text-center" v-if="name.rut">{{name.rut}}</td>
                            <td class="text-center" v-else>No tiene</td>
                            <td class="text-center" v-if="name.fono">{{name.fono}}</td>
                            <td class="text-center" v-else>No tiene</td>
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
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <h4 class="text-center">Acciones</h4>
                    <br>
                    <button class="btn btn-success btn-block"
                            data-toggle="modal"
                            href="#addUsers">
                        Nuevo usuario
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
                                    <label class="col-sm-2 control-label">Rut</label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                               placeholder="Digite el rut sin digito verificador"
                                               class="form-control"
                                               v-model="addUser.rut"
                                               required="required">
                                    </div>
                                </div>
                                <br>
                                <br>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                               class="form-control"
                                               v-model="addUser.fono"
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
                    <form role="form" @submit.prevent="submitEdition">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar usuario</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="selectedUserForEdition">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nombre :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   v-model="selectedUserForEdition.get_users[0].name"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">RUT :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   v-model="selectedUserForEdition.get_users[0].rut"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Fono :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   v-model="selectedUserForEdition.get_users[0].fono"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   v-model="selectedUserForEdition.get_users[0].email"
                                                   class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="roles" class="col-sm-2 control-label">Rol :</label>
                                        <div class="col-sm-10">
                                            <select name="name" id="roles" class="form-control"
                                                    v-model="selectedUserForEdition.idRol">
                                                <option v-for="item in roles" :value="item.id">{{item.rol}}</option>
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
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar este usuario</h4>
                    </div>
                    <div class="modal-body">

                        <h4 class="text-center">¿ Esta seguro que desea eliminar este usuario ?</h4>
                        <br>
                        <button class="btn btn-danger btn-block" @click="submitDeletion">Eliminar</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                    rut: '',
                    fono: '',
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
                    alert("Usuario agregado correctamente. La contraseña para este usuario es  : " + r.data);
                    this.getUsers();
                }).catch(e => {
                    console.log(e)
                })
            },
            edit(item){
                this.selectedUserForEdition = item;
            },
            erase(item){
                this.selectedUserForDeletion = item
            },

            submitEdition(){
                axios.put('api/update/user', this.selectedUserForEdition).then(r => {
                    $('#editUsers').modal('hide');
                }).catch(e => {
                    console.log()
                })
            },
            submitDeletion(){
                axios.delete('api/delete/user/' + this.selectedUserForDeletion.idUsuario).then(r => {
                    $('#modalEliminar').modal('hide');
                    this.getUsers();
                }).catch(e => {
                    console.log(e)
                })
            }

        },
        computed: {},
        components: {},
    }
</script>
