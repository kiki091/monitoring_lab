
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
            },
            nip_petugas_penerima: '',
            nama_pengantar: '',
            tgl_terima_sample: '',
            dokument_pendukung: '',
            lampiran_hsl_uji: '',
            pengiriman_sample: '',
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
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_karantina_tumbuhan_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    this.models = response.data
                    this.perusahaan_selector = response.data.perusahaan_id
                    this.kegiatan_selector = response.data.kegiatan_id
                    this.dokter_selector = response.data.dokter_id
                    this.upt_selector = response.data.upt_id
                    this.sample_selector = response.data.kodefikasi_sample
                    this.kategori_selector = response.data.kategori_id
                    this.dokument_pendukung = response.data.dokument_pendukung_url
                    this.lampiran_hsl_uji = response.data.lampiran_hsl_uji_url
                    this.pengiriman_sample = response.data.pengiriman_sample_url
                    this.nama_pengantar= response.data.nama_pengantar
                    this.tgl_terima_sample= response.data.tgl_terima_sample
                    this.nip_petugas_penerima= response.data.nip_petugas_penerima
                    

                    document.getElementById("lampiran_hsl_uji_"+response.data.lampiran_hsl_uji).checked = true;
                    document.getElementById("pengiriman_sample_"+response.data.pengiriman_sample).checked = true;
    
                    $('#toggle-form-content').slideDown('swing')
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
