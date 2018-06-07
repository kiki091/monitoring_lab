
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_upt() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kode_upt: '',
                nama_upt: '',
                daerah_id: '',
                jenis_pelabuhan: '',
            },
            data: {},
            list_daerah: {},
            daerah_selector: '',

            form_add_title: "List Data upt",
            edit: false,
        },

        watch: {

            list_daerah: _.debounce(function() {
              var elem = $(this.$el).find('#daerah_id');
              elem.val(this.daerah_selector)
              elem.trigger("chosen:updated"); 
            },500),
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_upt_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.data = response.data.list_data
                    vm.list_daerah = response.data.list_daerah
                    
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

                $("#form__master_upt").ajaxForm(optForm);
                $("#form__master_upt").submit();
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

                var domain  = laroute.route('cms_master_upt_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        vm.daerah_selector = response.data.daerah_id

                        $('#daerah_id').val(response.data.daerah_id).trigger("chosen:updated");
                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.kode_upt = ''
                this.models.nama_upt = ''
                this.models.daerah_id = ''
                this.models.jenis_pelabuhan = ''
                this.form_add_title = "List Data upt"
                this.daerah_selector = ''

                $('#daerah_id').val("").trigger("chosen:updated");
                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChoosen: function() {

                var vm = this
                $("#daerah_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.daerah_selector = this.value

                }).trigger("chosen:updated");
            }

        },
        mounted: function () {

            this.fetchData();
            this.initChoosen();
        }

    });
}
