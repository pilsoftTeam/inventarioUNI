<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <br>


                <div class="btn-group" style="width: 100%">
                    <button type="button"
                            @click="getDetailedExcel"
                            class="btn btn-info"
                            style="width: 50%">
                        Vista detallada de inventarios a Excel &nbsp;&nbsp; <i class="fa fa-file-excel-o"></i>
                    </button>
                    <button type="button"
                            @click="getBulkExcel"
                            class="btn btn-success"
                            style="width: 50%">
                        Volcar la base de datos a excel &nbsp;&nbsp;<i class="fa fa-table" aria-hidden="true"></i>
                    </button>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>
<script>
    import downloader from './../../modules/fileDownload'
    export default {
        data () {
            return {
                msg: 'Hello world!'
            }
        },
        methods: {

            getDetailedExcel(){
                axios.get('api/get/detailed/excel', {
                    responseType: 'arraybuffer'
                }).then(r => {
                    downloader(r.data, 'inventario-detallado.xlsx')
                }).catch(e => {
                    console.log(e)
                })
            },

            getBulkExcel(){
                axios.get('api/get/bulk/excel', {
                    responseType: 'arraybuffer'
                }).then(r => {
                    downloader(r.data, 'inventario-bulk.xlsx')
                }).catch(e => {
                    console.log(e)
                })
            },
        }
    }
</script>
