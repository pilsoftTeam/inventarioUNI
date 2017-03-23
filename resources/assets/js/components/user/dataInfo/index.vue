<template>
    <div>
        <h4 class="text-center">Datos del inventario</h4>
        <hr>

        <table class="table table-hover table-responsive">
            <thead>
            <tr class="text-center">
                <th class="text-center">Sede</th>
                <th class="text-center">Campus</th>
                <th class="text-center">Pabellon</th>
                <th class="text-center">Piso</th>
                <th class="text-center">Codigo ubicación</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{names.sede}}</td>
                <td class="text-center">{{names.campus}}</td>
                <td class="text-center">{{dataInventario.pabellon}}</td>
                <td class="text-center">{{dataInventario.piso}}</td>
                <td class="text-center">{{dataInventario.codigoUbicacion}}</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label class="col-sm-2 control-label">Rut del custodio:</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="Escriba aca" v-model="rutCustodio" class="form-control">
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-xs btn-default" @click="buscarCustodio" title="Buscar rut del custodio">
                        <i class="fa fa-search fa-2x"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="rutMatch">
            <h4 class="text-center">Datos del custodio</h4>
            <hr>
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th class="text-center"><b>Rut</b></th>
                    <th class="text-center"><b>Nombre</b></th>
                    <th class="text-center"><b>Unidad</b></th>
                    <th class="text-center"><b>Nombre Dependencia</b></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">{{datosCustodio.rut}}</td>
                    <td class="text-center">{{datosCustodio.nombre}}</td>
                    <td class="text-center">{{datosCustodio.unidad}}</td>
                    <td class="text-center">{{datosCustodio.nombreDependencia}}</td>
                </tr>
                </tbody>
            </table>

            <button class="btn btn-block btn-success" @click="empezar">Empezar el inventario</button>
        </div>
        <div class="col-sm-12" v-if="rutMatch === false">
            <div class="alert alert-danger fade in">
                <strong>Error : </strong> El rut <b>{{rutCustodio}}</b> no existe en la base de datos. Intente
                nuevamente
            </div>
        </div>
    </div>


    </div>
</template>

<script>
    export default {
        data () {
            return {
                items: {
                    campus: '',
                },

                rut: '17808985',
                datosCustodio: {
                    rut: '17808985',
                    nombre: 'Julio Contreras Marchant',
                    unidad: 'Unidad',
                    nombreDependencia: 'Nombre dependencia'

                },
                rutCustodio: '',
                rutMatch: ''
            }
        },
        props: {
            dataInventario: {
                required: true,
                type: Object
            },
            names: {
                required: true,
                type: Object
            }
        },
        methods: {
            buscarCustodio(){
                this.rutCustodio == this.rut ? this.rutMatch = true : this.rutMatch = false;
                if (this.rutMatch == false) {
                    setTimeout(function () {
                        this.rutMatch = ''
                    }.bind(this), 4000);
                }
            },
            empezar(){
                this.$emit('custodio', this.datosCustodio)
            }
        }
    }
</script>
