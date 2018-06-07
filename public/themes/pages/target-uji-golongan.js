
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_target_uji_golongan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kode_target_uji: '',
                kelompok_sample_id: '',
                nama_ilmiah: '',
                kode_hs_id: '',
                satuan_id: '',
            },
            data: {},
            list_kode_hs: {},
            list_satuan: {},
            list_sample: {},
            kode_hs_selector: '',
            satuan_selector: '',
            sample_selector: '',

            form_add_title: "List Data Target Uji Golongan",
            edit: false,
        },

        watch: {

            list_kode_hs: _.debounce(function() {
              var elem = $(this.$el).find('#kode_hs_id');
              elem.val(this.kode_hs_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_satuan: _.debounce(function() {
              var elem = $(this.$el).find('#satuan_id');
              elem.val(this.satuan_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_sample: _.debounce(function() {
              var elem = $(this.$el).find('#kelompok_sample_id');
              elem.val(this.sample_selector)
              elem.trigger("chosen:updated"); 
            },500),
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_target_uji_golongan_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.data = response.data.list_data
                    vm.list_kode_hs = response.data.list_kode_hs
                    vm.list_satuan = response.data.list_satuan
                    vm.list_sample = response.data.list_sample
                    
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

                $("#form__master_target_uji_golongan").ajaxForm(optForm);
                $("#form__master_target_uji_golongan").submit();
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

                var domain  = laroute.route('cms_master_target_uji_golongan_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        vm.kode_hs_selector = response.data.kode_hs_id
                        vm.satuan_selector = response.data.satuan_id
                        vm.sample_selector = response.data.kelompok_sample_id

                        $('#kode_hs_id').val(response.data.kode_hs_id).trigger("chosen:updated");
                        $('#satuan_id').val(response.data.satuan_id).trigger("chosen:updated");
                        $('#kelompok_sample_id').val(response.data.kelompok_sample_id).trigger("chosen:updated");
                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.kode_target_uji = ''
                this.models.kelompok_sample_id = ''
                this.models.nama_ilmiah = ''
                this.models.kode_hs_id = ''
                this.models.satuan_id = ''
                this.form_add_title = "List Data Target Uji Golongan"

                this.kode_hs_selector = ''

                $('#kode_hs_id').val("").trigger("chosen:updated");
                $('#satuan_id').val("").trigger("chosen:updated");
                $('#kelompok_sample_id').val("").trigger("chosen:updated");

                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChoosen: function() {

                var vm = this
                $("#kode_hs_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.kode_hs_selector = this.value

                }).trigger("chosen:updated");

                $("#satuan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.satuan_selector = this.value

                }).trigger("chosen:updated");

                $("#kelompok_sample_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.sample_selector = this.value

                }).trigger("chosen:updated");
            }

        },
        mounted: function () {

            this.fetchData();
            this.initChoosen();
        }

    });
}
