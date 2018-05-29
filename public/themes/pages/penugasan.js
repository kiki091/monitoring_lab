
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_penugasan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                target_uji_id: '',
                kedudukan: '',
                karantina_tumbuhan_id: '',
            },
            data: {},
            list_permohonan: {},
            permohonan_selector: '',
            detail: {
                target_uji_id: '',
                target_pengujian: '',
                target_hph: '',
                nama_dokter: '',
                nip_dokter: '',
                metode_pengujian: '',
                laboratorium: '',
                kode_sample: '',
                nama_sample: '',
            },
            form_add_title: "List Daftar Penugasan",
            edit: false,
        },

        watch: {

            permohonan_selector: function() {

                var payload = []
                payload['id'] = this.permohonan_selector
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_karantina_tumbuhan_edit', []);
                this.$http.post(domain, form).then(function(response) {

                    this.detail.target_uji_id = response.data.target_uji_id
                    this.detail.target_pengujian = response.data.target_pengujian
                    this.detail.target_hph = response.data.target_hph
                    this.detail.nama_dokter = response.data.nama_dokter
                    this.detail.nip_dokter = response.data.nip_dokter
                    this.detail.metode_pengujian = response.data.metode_pengujian
                    this.detail.laboratorium = response.data.laboratorium
                    this.detail.kode_sample = response.data.kode_sample
                    this.detail.nama_sample = response.data.nama_sample
                })
            }
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_penugasan_data', []);
                
                this.$http.get(domain+'?status=1').then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        vm.data = response.data.list_data
                        vm.list_permohonan = response.data.list_permohonan
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

                $("#form__penugasan").ajaxForm(optForm);
                $("#form__penugasan").submit();
            },

            editData: function(id) {

                this.edit = true
                this.checkFunctions = []          
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_penugasan_edit', []);
                this.$http.post(domain, form).then(function(response) {

                    if (response.status) {
                        this.models = response.data;
                        this.permohonan_selector = response.data.karantina_tumbuhan_id;

                        $('#toggle-form-content').slideDown('swing')
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.target_uji_id = ''
                this.models.kedudukan = ''
                this.models.karantina_tumbuhan_id = ''

                this.target_selector = ''
                this.permohonan_selector = ''

                this.detail = {}
                this.detail.target_uji_id = ''
                this.detail.target_pengujian = ''
                this.detail.target_hph = ''
                this.detail.nama_dokter = ''
                this.detail.nip_dokter = ''
                this.detail.metode_pengujian = ''
                this.detail.laboratorium = ''
                this.detail.kode_sample = ''
                this.detail.nama_sample = ''

                this.form_add_title = "List Daftar Penugasan"
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
