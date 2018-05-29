
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_hasil_laboratorium() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                karantina_tumbuhan_id: '',
                kesimpulan: '',
                keterangan: '',
                hasil: '',
            },
            detail: {
                tgl_permohonan: '',
                laboratorium: '',
                kode_sample: '',
                tgl_terima_sample: '',
                target_pengujian: '',
                metode_pengujian: '',
                nama_sample: '',
            },
            data: {},
            list_permohonan: {},
            permohonan_selector: '',
            form_add_title: "Hasil Pemeriksaan Laboratorium",
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

                    console.log(response.data)
                    this.detail.tgl_permohonan = response.data.tgl_permohonan
                    this.detail.laboratorium = response.data.laboratorium
                    this.detail.kode_sample = response.data.kode_sample
                    this.detail.tgl_terima_sample = response.data.tgl_terima_sample
                    this.detail.target_pengujian = response.data.target_pengujian
                    this.detail.metode_pengujian = response.data.metode_pengujian
                    this.detail.nama_sample = response.data.nama_sample
                })
            }
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_hasil_laboratorium_data', []);
                
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

                $("#form__hasil_laboratorium").ajaxForm(optForm);
                $("#form__hasil_laboratorium").submit();
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

                var domain  = laroute.route('cms_hasil_laboratorium_edit', []);
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
                this.models.karantina_tumbuhan_id = ''
                this.models.kesimpulan = ''
                this.models.keterangan = ''

                this.detail = {}
                this.detail.tgl_permohonan = ''
                this.detail.laboratorium = ''
                this.detail.kode_sample = ''
                this.detail.tgl_terima_sample = ''
                this.detail.target_pengujian = ''
                this.detail.metode_pengujian = ''
                this.detail.nama_sample = ''

                this.permohonan_selector = ''
                this.form_add_title = "Hasil Pemeriksaan Laboratorium"


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
