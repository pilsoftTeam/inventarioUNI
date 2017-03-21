<template>
    <div>
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- TAB NAVIGATION -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#tab1" role="tab" data-toggle="tab">
                            Utilidades
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" role="tab" data-toggle="tab">
                            Mantenedor Custodios
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" role="tab" data-toggle="tab">
                            Tab3
                        </a>
                    </li>
                </ul>
                <!-- TAB CONTENT -->
                <div class="tab-content">
                    <div class="active tab-pane fade in" id="tab1">
                        <br>
                        <utils></utils>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <br>
                        <custodios></custodios>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <h2>Tab3</h2>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Custodios from './custodios/index.vue'
    import Utils from './utils/index.vue'
    export default {
        data () {
            return {
                msg: 'Hello world!'
            }
        },
        components: {
            Custodios, Utils
        }
    }
</script>
