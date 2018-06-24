
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_permohonan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kategori_uji_id: '',
                dokter_hewan_id: '',
                kegiatan_id: '',
                upt_id: '',
                daerah_id: '',
                negara_id: '',
                type_permohonan: '',
                nama_pemilik: '',
                alamat_pemilik: '',
                lampiran_hasil_uji: '',
                dokument_pendukung: '',
                pengiriman_sample: '',
                nama_pengirim: '',
                tgl_terima_sample: '',
                nip_petugas_penerima: '',
            },
            sample: {
                id: [],
                nama_sample: [],
                jenis_sample: [],
                jml_vol: [],
                satuan_id: [],
                nama_komoditas: [],
                tgl_pengambilan_sample: [],
                metode_pengambilan_sample: [],
                kondisi_sample: [],
                target_pengujian_id: [],
                nama_customer: [],
                alamat: [],
            },
            pengujian: {
                id: '',
                permohonan_id: '',
                target_uji_golongan_id: '',
                target_pest_id: '',
                lama_uji: '',
            },
            list_target_uji_golongan: {},
            target_uji_golongan_selector: '',
            list_target_pest: {},
            target_pest_selector: '',
            data: {},
            list_upt: {},
            list_sample: {},
            list_dokter: {},
            list_kegiatan: {},
            list_daerah: {},
            list_negara: {},
            list_satuan: {},
            list_target: {},
            list_kategori: {},
            list_perusahaan: {},
            sample_selector: '',
            dokter_selector: '',
            kegiatan_selector: '',
            upt_selector: '',
            daerah_selector: '',
            negara_selector: '',
            satuan_selector: '',
            target_selector: '',
            kategori_selector: '',
            upt_selector: '',
            perusahaan_selector: '',
            list_type_permohonan: [
                {id:'1', name: 'Hewan'},
                {id:'2', name: 'Tumbuhan'},
            ],
            type_permohonan_selector: '',
            dokument_pendukung: '',
            form_add_title: "FORM PERMOHONAN",
            default_total_sample_data: [0],
            tab_menu_list: [
                {id:'permohonan', name: 'Permohonan'},
                {id:'sample', name: 'Sample'},
                {id:'pengujian', name: 'Pengujian'}
            ],
            last_tab_key: 'pengujian',
            show_negara: true,
            show_upt: true,
            show_daerah: true,
            show_perusahaan: true,
            show_nama_pemilik: true,
            show_alamat_pemilik: true,
            edit: false,
            default_total_sample_data: [0],
            sample_selected: [],
            search_by_kode_sample: '',
        },

        watch: {

            search_by_kode_sample: _.debounce(function() {

                var vm = this
                var domain  = laroute.route('cms_master_sample_data', []);
                
                this.$http.get(domain+'?kode_sample='+vm.search_by_kode_sample).then(function (response) {
                    response = response.data
                    vm.list_sample = response.data.list_data
                    
                })
            },500),

            kegiatan_selector: function() {
                var vm = this

                if(vm.kegiatan_selector == '3') {
                    vm.show_negara = true
                    vm.show_upt = false
                    vm.show_daerah = false
                    vm.show_perusahaan = false
                    vm.show_nama_pemilik = true
                    vm.show_alamat_pemilik = true
                }
                else {
                    setTimeout(function() {

                        $("#daerah_id").chosen({    
                            width: "100%",    
                            disable_search: false,
                            theme: "dark"
                        }).change(function() {
                            vm.daerah_selector = this.value

                        }).trigger("chosen:updated");

                        $("#upt_id").chosen({    
                            width: "100%",    
                            disable_search: false,
                            theme: "dark"
                        }).change(function() {
                            vm.upt_selector = this.value

                        }).trigger("chosen:updated");

                        $("#perusahaan_id").chosen({    
                            width: "100%",    
                            disable_search: false,
                            theme: "dark"
                        }).change(function() {
                            vm.perusahaan_selector = this.value

                        }).trigger("chosen:updated");

                    }, 200);
                    

                    vm.show_negara = false
                    vm.show_upt = true
                    vm.show_daerah = true
                    vm.show_perusahaan = true
                    vm.show_nama_pemilik = false
                    vm.show_alamat_pemilik = false
                }

            },

            // list_satuan: _.debounce(function() {
            //   var elem = $(this.$el).find('.satuan_id');
            //   elem.val(this.sample.satuan_id)
            //   elem.trigger("chosen:updated"); 
            // },500),

            // list_target: _.debounce(function() {
            //   var elem = $(this.$el).find('.target_pengujian_id');
            //   elem.val(this.target_selector)
            //   elem.trigger("chosen:updated"); 
            // },500),

            list_target_uji_golongan: _.debounce(function() {
              var elem = $(this.$el).find('#target_uji_golongan_id');
              elem.val(this.target_uji_golongan_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_target_pest: _.debounce(function() {
              var elem = $(this.$el).find('#target_pest_id');
              elem.val(this.target_pest_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_kategori: _.debounce(function() {
              var elem = $(this.$el).find('#kategori_uji_id');
              elem.val(this.kategori_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_dokter: _.debounce(function() {
              var elem = $(this.$el).find('#dokter_hewan_id');
              elem.val(this.dokter_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_upt: _.debounce(function() {
              var elem = $(this.$el).find('#upt_id');
              elem.val(this.upt_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_kegiatan: _.debounce(function() {
              var elem = $(this.$el).find('#kegiatan_id');
              elem.val(this.kegiatan_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_daerah: _.debounce(function() {
              var elem = $(this.$el).find('#daerah_id');
              elem.val(this.daerah_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_perusahaan: _.debounce(function() {
              var elem = $(this.$el).find('#perusahaan_id');
              elem.val(this.perusahaan_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_negara: _.debounce(function() {
              var elem = $(this.$el).find('#negara_id');
              elem.val(this.negara_selector)
              elem.trigger("chosen:updated"); 
            },500),
        },

        methods: {

            addMoreData: function() {
                this.default_total_sample_data.splice(this.default_total_sample_data.length + 1, 0, {});
            },

            deleteMoreData: function(index) {
                this.removeFormData(index)
                this.default_total_sample_data.splice(index, 1);
            },

            removeFormData: function(index) {
                this.sample.nama_sample[index] = ''
                this.sample.jenis_sample[index] = ''
                this.sample.jml_vol[index] = ''
                this.sample.satuan_id[index] = ''
                this.sample.nama_komoditas[index] = ''
                this.sample.tgl_pengambilan_sample[index] = ''
                this.sample.metode_pengambilan_sample[index] = ''
                this.sample.kondisi_sample[index] = ''
                this.sample.target_pengujian_id[index] = ''
                this.sample.nama_customer[index] = ''
                this.sample.alamat[index] = ''
            },

            // sample_choices: function(idx, val) {

            //     var vm = this
            //     if(vm.sample_selected[0] == true)
            //         vm.sample_selected.push({idx,val})
            //     else
            //         vm.sample_selected.splice(this.sample_selected.length + 1, 0, {idx,val})
            // },

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_permohonan_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.data = response.data.list_data
                    vm.list_upt = response.data.list_upt
                    vm.list_daerah = response.data.list_daerah
                    vm.list_negara = response.data.list_negara
                    vm.list_dokter = response.data.list_dokter
                    vm.list_kegiatan = response.data.list_kegiatan
                    vm.list_target = response.data.list_target
                    vm.list_satuan = response.data.list_satuan
                    vm.list_sample = response.data.list_sample
                    vm.list_kategori = response.data.list_kategori
                    vm.list_perusahaan = response.data.list_perusahaan
                    vm.list_target_uji_golongan = response.data.list_target_uji_golongan
                    vm.list_target_pest = response.data.list_target_pest
                    
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

                $("#form__master_permohonan").ajaxForm(optForm);
                $("#form__master_permohonan").submit();
            },

            editData: function(id) {

                this.edit = true
                this.checkFunctions = []          
                var payload = []
                var vm = this

                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_master_permohonan_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        vm.pengujian.lama_uji = response.data.lama_uji
                        vm.kategori_selector = response.data.kategori_uji_id
                        vm.dokter_selector = response.data.dokter_hewan_id
                        vm.daerah_selector = response.data.daerah_id
                        vm.kegiatan_selector = response.data.kegiatan_id
                        vm.upt_selector = response.data.upt_id
                        vm.perusahaan_selector = response.data.perusahaan_id
                        vm.negara_selector = response.data.negara_id
                        vm.type_permohonan_selector = response.data.type_permohonan
                        vm.target_uji_golongan_selector = response.data.target_uji_golongan_id
                        vm.target_pest_selector = response.data.target_pest_id
                        vm.sample_selected = response.data.sample_permohonan
                        vm.dokument_pendukung = response.data.dokument_pendukung

                        $('#daerah_id').val(response.data.daerah_id).trigger("chosen:updated")
                        $('#kategori_uji_id').val(response.data.kategori_uji_id).trigger("chosen:updated")
                        $('#dokter_hewan_id').val(response.data.dokter_hewan_id).trigger("chosen:updated")
                        $('#kegiatan_id').val(response.data.kegiatan_id).trigger("chosen:updated")
                        $('#upt_id').val(response.data.upt_id).trigger("chosen:updated")
                        $('#perusahaan_id').val(response.data.perusahaan_id).trigger("chosen:updated")
                        $('#negara_id').val(response.data.negara_id).trigger("chosen:updated")
                        $('#type_permohonan').val(response.data.type_permohonan).trigger("chosen:updated")

                        $('#target_uji_golongan_id').val(response.data.target_uji_golongan_id).trigger("chosen:updated")
                        $('#target_pest_id').val(response.data.target_pest_id).trigger("chosen:updated")
                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.daerah_selector = ''
                this.dokter_selector = ''
                this.kategori_selector = ''
                this.kegiatan_selector = ''
                this.negara_selector = ''
                this.perusahaan_selector = ''
                this.sample_selected = []
                this.satuan_selector = ''
                this.search_by_kode_sample = ''
                this.target_pest_selector = ''
                this.target_selector = ''
                this.target_uji_golongan_selector = ''
                this.type_permohonan_selector = ''
                this.upt_selector = ''
                this.dokument_pendukung = ''

                this.pengujian.id = ''
                this.pengujian.lama_uji = ''
                this.pengujian.permohonan_id = ''
                this.pengujian.target_pest_id = ''
                this.pengujian.target_uji_golongan_id = ''

                this.models.id = ''
                this.models.alamat_pemilik = ''
                this.models.daerah_id = ''
                this.models.dokter_hewan_id = ''
                this.models.dokument_pendukung = ''
                this.models.kategori_uji_id = ''
                this.models.kegiatan_id = ''
                this.models.lampiran_hasil_uji = '0'
                this.models.nama_pemilik = ''
                this.models.nama_pengirim = ''
                this.models.negara_id = ''
                this.models.nip_petugas_penerima = ''
                this.models.pengiriman_sample = ''
                this.models.tgl_terima_sample = ''
                this.models.type_permohonan = ''
                this.models.upt_id = ''
                
                this.show_negara = true,
                this.show_upt = true,
                this.show_daerah = true,
                this.show_perusahaan = true,
                this.show_nama_pemilik = true,
                this.show_alamat_pemilik = true,
                this.edit = false
                
                $('#daerah_id').val('').trigger("chosen:updated")
                $('#dokter_hewan_id').val('').trigger("chosen:updated")
                $('#kategori_uji_id').val('').trigger("chosen:updated")
                $('#kegiatan_id').val('').trigger("chosen:updated")
                $('#negara_id').val('').trigger("chosen:updated")
                $('#perusahaan_id').val('').trigger("chosen:updated")
                $('#target_pest_id').val('').trigger("chosen:updated")
                $('#target_uji_golongan_id').val('').trigger("chosen:updated")
                $('#type_permohonan').val('').trigger("chosen:updated")

                this.initChoosen()
                this.clearErrorMessage()
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChoosen: function() {

                var vm = this

                $("#kategori_uji_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.kategori_selector = this.value

                }).trigger("chosen:updated");

                $("#type_permohonan").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.type_permohonan_selector = this.value

                }).trigger("chosen:updated");

                $("#dokter_hewan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.dokter_selector = this.value

                }).trigger("chosen:updated");

                $("#upt_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.upt_selector = this.value

                }).trigger("chosen:updated");

                $("#kegiatan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.kegiatan_selector = this.value

                }).trigger("chosen:updated");

                $("#perusahaan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.perusahaan_selector = this.value

                }).trigger("chosen:updated");

                $("#daerah_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.daerah_selector = this.value

                }).trigger("chosen:updated");

                $("#negara_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.negara_selector = this.value

                }).trigger("chosen:updated");

                $("#target_uji_golongan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.target_uji_golongan_selector = this.value

                }).trigger("chosen:updated");

                $("#target_pest_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.target_pest_selector = this.value

                }).trigger("chosen:updated");

                // $(".satuan_id").chosen({    
                //     width: "100%",    
                //     disable_search: false,
                //     theme: "dark"
                // }).change(function() {
                //     vm.sample.satuan_id = this.value

                // }).trigger("chosen:updated");

                // $(".target_pengujian_id").chosen({    
                //     width: "100%",    
                //     disable_search: false,
                //     theme: "dark"
                // }).change(function() {
                //     vm.target_selector = this.value

                // }).trigger("chosen:updated");
            }

        },
        mounted: function () {
            
            this.fetchData();
            this.initChoosen();
        }

    });
}
