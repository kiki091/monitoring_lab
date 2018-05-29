
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_karantina_tumbuhan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                no_permohonan: '',
                tgl_permohonan: '',
                kodefikasi_sample: '',
                kode_area: '',
                dokument_pendukung: '',
                lampiran_hsl_uji: '',
                pengiriman_sample: '',
                nama_pengantar: '',
                tgl_terima_sample: '',
                nip_petugas_penerima: '',
            },

            list_perusahaan: {},
            perusahaan_selector: '',

            list_kegiatan: {},
            kegiatan_selector: '',

            list_kategori: {},
            kategori_selector: '',

            list_dokter: {},
            dokter_selector: '',

            list_upt: {},
            upt_selector: '',

            list_permohonan: {},
            permohonan_selector: '',

            list_sample: {},
            sample_selector: '',

            form_add_title: "List Data Karantina Tumbuhan",
            edit: false,
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_karantina_tumbuhan_data', []);
                
                this.$http.get(domain+'?status=1').then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        vm.list_permohonan = response.data.permohonan
                        vm.list_perusahaan = response.data.perusahaan
                        vm.list_kegiatan = response.data.kegiatan
                        vm.list_kategori = response.data.kategori
                        vm.list_dokter = response.data.dokter
                        vm.list_upt = response.data.upt
                        vm.list_sample = response.data.sample
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

                $("#form__karantina__tumbuhan").ajaxForm(optForm);
                $("#form__karantina__tumbuhan").submit();
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

                var domain  = laroute.route('cms_karantina_tumbuhan_edit', []);
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        

                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.name = ''
                this.form_add_title = "List Data Karantina Tumbuhan"
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
