
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_jabatan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kode_jabatan: '',
                nama_jabatan: '',
            },
            data: {},
            form_add_title: "List Data Jabatan",
            edit: false,
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_jabatan_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
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

                $("#form__master_jabatan").ajaxForm(optForm);
                $("#form__master_jabatan").submit();
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

                var domain  = laroute.route('cms_master_jabatan_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.kode_jabatan = ''
                this.models.nama_jabatan = ''
                this.form_add_title = "List Data Jabatan"
                //$('#nama_lab').val().trigger("chosen:updated")

                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChoosen: function() {

                var vm = this
                $("#nama_lab").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.lab_selector = this.value

                }).trigger("chosen:updated");
            }

        },
        mounted: function () {

            this.fetchData();
            //this.initChoosen();
        }

    });
}
