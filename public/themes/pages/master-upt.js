
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_master_upt() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kode_upt: '',
                nama_upt: '',
                kelas_upt: '',
                nama_lab: '',
                jns_pelabuhan: '',
                daerah: '',
                alamat: '',
                no_tlp: '',
                no_fax: '',
                email: '',
            },
            data: {},
            list_lab: {},
            list_daerah: {},
            list_pelabuhan: [
                {id: 'Laut', name: 'Laut'},
                {id: 'Udara', name: 'Udara'},
                {id: 'Perairan', name: 'Perairan'},
                {id: 'Pos', name: 'Pos'},
            ],
            pelabuhan_selector: '',
            lab_selector: '',
            daerah_selector: '',
            form_add_title: "List Data UPT",
            edit: false,
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_upt_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.data = response.data.list_data
                    vm.list_lab = response.data.list_lab
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
                        vm.models = response.data;
                        vm.lab_selector = response.data.lab_id
                        vm.daerah_selector = response.data.daerah_id
                        vm.pelabuhan_selector = response.data.jns_pelabuhan

                        //$('#nama_lab').val(vm.lab_selector).trigger("chosen:updated")
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
                this.models.kelas_upt = ''
                this.models.nama_lab = ''
                this.models.jns_pelabuhan = ''
                this.models.daerah = ''
                this.models.alamat = ''
                this.models.no_tlp = ''
                this.models.no_fax = ''
                this.models.email = ''
                this.form_add_title = "List Data UPT"

                this.lab_selector = ''
                this.daerah_selector = ''
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
