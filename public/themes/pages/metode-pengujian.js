
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_metode_pengujian() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                nama_metode_pengujian: '',
                target_pengujian_id: '',
                laboratorium_id: '',
                kelompok_metode_pengujian_id: '',
            },
            data: {},
            list_laboratorium: {},
            list_target: {},
            list_kelompok: {},

            laboratorium_selector: '',
            target_selector: '',
            kelompok_selector: '',
            form_add_title: "List Data Metode Pengujian",
            edit: false,
        },

        watch: {

            list_target: _.debounce(function() {
              var elem = $(this.$el).find('#target_pengujian_id');
              elem.val(this.target_selector)
              elem.trigger("chosen:updated"); 
            },500),
            
            list_laboratorium: _.debounce(function() {
              var elem = $(this.$el).find('#laboratorium_id');
              elem.val(this.laboratorium_selector)
              elem.trigger("chosen:updated"); 
            },500),
            
            list_kelompok: _.debounce(function() {
              var elem = $(this.$el).find('#kelompok_metode_pengujian_id');
              elem.val(this.kelompok_selector)
              elem.trigger("chosen:updated"); 
            },500),
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_metode_pengujian_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.list_laboratorium = response.data.list_laboratorium
                    vm.list_target = response.data.list_target
                    vm.list_kelompok = response.data.list_kelompok
                    vm.data = response.data.list_data
                    
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

                $("#form__master_metode_pengujian").ajaxForm(optForm);
                $("#form__master_metode_pengujian").submit();
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

                var domain  = laroute.route('cms_master_metode_pengujian_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        vm.target_selector = response.data.target_pengujian_id
                        vm.laboratorium_selector = response.data.laboratorium_id
                        vm.kelompok_selector = response.data.kelompok_metode_pengujian_id

                        $('#target_pengujian_id').val(response.data.target_pengujian_id).trigger("chosen:updated");
                        $('#laboratorium_id').val(response.data.laboratorium_id).trigger("chosen:updated");
                        $('#kelompok_metode_pengujian_id').val(response.data.kelompok_metode_pengujian_id).trigger("chosen:updated");

                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.nama_metode_pengujian = ''
                this.models.target_pengujian_id = ''
                this.models.laboratorium_id = ''
                this.models.kelompok_metode_pengujian_id = ''

                this.target_selector = ''
                this.laboratorium_selector = ''
                this.kelompok_selector = ''
                this.form_add_title = "List Data Metode Pengujian"

                $('#target_pengujian_id').val("").trigger("chosen:updated");
                $('#laboratorium_id').val("").trigger("chosen:updated");
                $('#kelompok_metode_pengujian_id').val("").trigger("chosen:updated");

                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChoosen: function() {

                var vm = this
                $("#target_pengujian_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.target_selector = this.value

                }).trigger("chosen:updated");

                $("#laboratorium_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.laboratorium_selector = this.value
                }).trigger("chosen:updated");

                $("#kelompok_metode_pengujian_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.kelompok_selector = this.value
                }).trigger("chosen:updated");
            }

        },
        mounted: function () {

            this.fetchData();
            this.initChoosen();
        }

    });
}
