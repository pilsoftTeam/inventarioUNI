<template>
    <div>

        <div class="row" v-if="showInventoryList">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <datasource
                        language="es"
                        :table-data="information.data"
                        :columns="columns"
                        :pagination="information.pagination"
                        :actions="actions"
                        v-on:change="changePage"
                        v-on:searching="onSearch"></datasource>
            </div>
        </div>

        <div class="row" v-if="showFullInventory">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <inventario :dataInventario="selectedInventario"></inventario>
            </div>
        </div>

    </div>
</template>

<script>
    import Datasource from 'vue-datasource'
    import Inventario from './modulos/inventario.vue'
    export default {
        mounted(){
            this.getInventarios();
        },
        data () {
            const self = this;
            return {
                showInventoryList: true,
                showFullInventory: false,
                information: {
                    pagination: {},
                    data: []
                },
                selectedInventario: {},
                columns: [
                    {
                        name: 'Folio',
                        key: 'folio'
                    },
                    {
                        name: 'Sede',
                        key: 'get_campus.get_sede.sede'
                    },
                    {
                        name: 'Campus',
                        key: 'get_campus.campus'
                    },
                    {
                        name: 'Pabellon',
                        key: 'numeroPabellon'
                    },
                    {
                        name: 'Piso',
                        key: 'numeroPiso'
                    },
                    {
                        name: 'Codigo ubicacion',
                        key: 'codigoUbicacion'
                    },
                    {
                        name: 'Custodio',
                        key: 'get_custodio.nombre'
                    },
                    {
                        name: 'Dependencia',
                        key: 'get_custodio.nombreDependencia'
                    },
                    {
                        name: 'Unidad',
                        key: 'get_custodio.unidad'
                    },
                    {
                        name: 'Revisor',
                        key: 'get_revisor.name'
                    },
                    {
                        name: 'Fecha creacion',
                        key: 'created_at'
                    },
                    {
                        name: 'Fecha ultima modificacion',
                        key: 'updated_at'
                    },
                ],
                actions: [
                    {
                        text: 'Cargar inventario', // Button label
                        class: 'btn-primary', // Button class (background color)
                        event(e, row) {
                            if (row) self.setInventario(row.row); else return false;
                        }
                    }
                ]
            }
        },
        methods: {
            getInventarios(){
                axios.get('api/get/inventarios').then(r => {
                    this.information.pagination = r.data.pagination;
                    this.information.data = r.data.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            changePage(values) {
                axios.get(`api/get/inventarios?page=${values.page}&per_page=${values.perpage}`).then(r => {
                    this.information.pagination = r.data.pagination;
                    this.information.data = r.data.data;
                }).catch(e => {
                    console.log(e)
                });
            },
            onSearch(searchQuery) {
                console.log('Searching', searchQuery);
                axios.get(`api/get/inventarios?search=${searchQuery}`).then(r => {
                    this.information.pagination = r.data.pagination;
                    this.information.data = r.data.data;
                }).catch(e => {
                    console.log(e)
                });
            },
            setInventario(obj){
                this.showInventoryList = false;
                this.showFullInventory = true;
                this.selectedInventario = obj

            }
        },
        components: {
            Datasource, Inventario
        }
    }
</script>
