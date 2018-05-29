
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_sample_hewan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                kode_sample: '',
                nama_sample: '',
                jenis_sample: '',
                jml_vol: '',
                satuan: '',
                nama_komoditas: '',
                tgl_pengambilan_sample: '',
                nama_customer: '',
                alamat: '',
            },
            kondisi_sample: '',
            data_sample: {},
            list_sample: [
                {id: '', name: 'Choose One'},
                {id: 'Umbi', name: 'Umbi'},        
            ],
            sample_selector: '',

            list_satuan: [
                {id: '', name: 'Choose One'},
                {id: 'GRM', name: 'GRM'},
                {id: 'KG', name: 'KG'},      
                {id: 'TON', name: 'TON'},       
            ],
            satuan_selector: '',
            list_metode_sample: [
                {id: '', name: 'Choose One'},
                {id: 'Random', name: 'Random'},
            ],
            metode_sample_selector: '',
            list_target: {},
            target_selector: '',

            form_add_title: "List Data Sample Hewan",
            edit: false,
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_sample_hewan_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        vm.data_sample = response.data.sample
                        vm.list_target = response.data.list_target
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

                $("#form__sample_hewan").ajaxForm(optForm);
                $("#form__sample_hewan").submit();
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

                var domain  = laroute.route('cms_sample_hewan_edit', []);
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
                this.models.nama_sample = ''
                this.models.kode_sample = ''
                this.models.jenis_sample = ''
                this.models.jml_vol = ''
                this.kondisi_sample = ''
                this.models.nama_customer = ''
                this.models.alamat = ''
                this.sample_selector = ''
                this.satuan_selector = ''
                this.metode_sample_selector = ''
                this.target_selector = ''

                this.form_add_title = "List Data Sample Hewan"
                this.clearErrorMessage()
                this.edit = false
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

            initChosen: function() {

                var vm = this

                $(".chosen-sample").chosen({    
                    width: "100%",    
                    disable_search: false  
                }).change(function() {
                    vm.sample_selector = this.value

                }).trigger("chosen:updated");


                $(".chosen-satuan").chosen({    
                    width: "100%",    
                    disable_search: false  
                }).change(function() {
                    vm.satuan_selector = this.value

                }).trigger("chosen:updated");


                $(".chosen-metode-pengambilan").chosen({    
                    width: "100%",    
                    disable_search: false  
                }).change(function() {
                    vm.metode_sample_selector = this.value

                }).trigger("chosen:updated");
            }

        },
        mounted: function () {
            this.fetchData();
        }

    });
}
