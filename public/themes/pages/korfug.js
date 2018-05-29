
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_korfug() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                dokter_id: '',
                tgl_usulan: '',
                nip_korfug: '',
                kedudukan: '',
                karantina_tumbuhan_id: '',
            },
            data: {},
            detail_data: {},
            korfug_data: {},
            list_dokter: {},
            dokter_selector: '',
            form_add_title: "Koordinator Fungsional",
            edit: false,
        },

        watch: {

            dokter_selector: function() {
                var payload = []
                payload['id'] = this.dokter_selector
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_master_dokter_edit', []);
                this.$http.post(domain, form).then(function(response) {

                    if (response.status) {
                        this.models.nip_korfug = response.data.nip_dokter;
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            }
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_korfug_data', []);
                
                this.$http.get(domain+'?status=1').then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        vm.data = response.data.permohonan
                        vm.list_dokter = response.data.dokter
                    } else {
                        pushNotif(response.status, response.message)
                    }
                })
            },


            storeData: function(event) {

                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSend: function(){
                        showLoading(true)
                        vm.clearErrorMessage()
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {
                                
                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $("#form--error--message--" + key.replace(".", "_")).text(value)
                                    message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                                });
                                pushNotifValidation(response.status, 'default', message_validation, false);

                            } else {
                                pushNotif(response.status, response.message);
                            }
                        } else {
                            vm.fetchData()
                            pushNotif(response.status, response.message);
                            $('.btn__add__cancel').click();
                            vm.resetForm(true)
                        }
                    },
                    complete: function(response){
                        hideLoading()
                    }

                };

                $("#form__korfug").ajaxForm(optForm);
                $("#form__korfug").submit();
            },

            showData: function(id)
            {
                this.edit = true        
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_karantina_tumbuhan_edit', []);
                this.$http.post(domain, form).then(function(response) {

                    if (response.status) {
                        this.models.karantina_tumbuhan_id = id
                        this.detail_data = response.data;
                        this.korfug_data = response.data.korfug;
                        
                        $('#toggle-form-content').slideDown('swing')
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            deleteData: function(id)
            {       
                var payload = []
                var vm = this
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_korfug_delete', []);
                this.$http.post(domain, form).then(function(response) {

                    if (response.status) {

                        this.showData(this.models.karantina_tumbuhan_id)
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.dokter_id = ''
                this.models.tgl_usulan = ''
                this.models.nip_korfug = ''
                this.models.kedudukan = ''
                this.models.karantina_tumbuhan_id = ''

                this.dokter_selector = ''
                this.detail_data = {}

                this.form_add_title = "Koordinator Fungsional"
                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

        },
        mounted: function () {
            this.fetchData();
        }

    });
}
