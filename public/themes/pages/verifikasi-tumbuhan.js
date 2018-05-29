
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_verifikasi_tumbuhan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                status: '',
                saran: '',
            },
            data: {},
            form_add_title: "Verifikasi Karantina Tumbuhan",
            edit: false,
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_karantina_tumbuhan_data', []);
                
                this.$http.get(domain+'?status=1').then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        vm.data = response.data.permohonan
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

                $("#form__verifikasi_karantina_tumbuhan").ajaxForm(optForm);
                $("#form__verifikasi_karantina_tumbuhan").submit();
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
                        this.models = response.data;
                        
                        $('#toggle-form-verifikasi-content').slideDown('swing')
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.status = ''

                this.target_selector = ''
                this.form_add_title = "Verifikasi Karantina Tumbuhan"
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
