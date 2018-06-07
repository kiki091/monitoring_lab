
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_sample() {
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
                satuan_id: '',
                nama_komoditas: '',
                tgl_pengambilan_sample: '',
                metode_pengambilan_sample: '',
                kondisi_sample: '',
                target_pengujian_id: '',
                nama_customer: '',
                alamat: '',
            },
            data: {},
            list_target: {},
            list_satuan: {},
            target_selector: '',
            satuan_selector: '',
            tgl_pengambilan_sample: '',
            form_add_title: "List Data Sample",
            edit: false,
        },

        watch: {

            list_target: _.debounce(function() {
              var elem = $(this.$el).find('#target_pengujian_id');
              elem.val(this.target_selector)
              elem.trigger("chosen:updated"); 
            },500),

            list_satuan: _.debounce(function() {
              var elem = $(this.$el).find('#satuan_id');
              elem.val(this.satuan_selector)
              elem.trigger("chosen:updated"); 
            },500),

            tgl_pengambilan_sample: _.debounce(function() {
              var elem = $('#tgl_pengambilan_sample');
              console.log(elem[0].value)
            },500),
        },

        methods: {

            fetchData: function() {
                var vm = this
                var domain  = laroute.route('cms_master_sample_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    vm.data = response.data.list_data
                    vm.list_target = response.data.list_target
                    vm.list_satuan = response.data.list_satuan
                    
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

                $("#form__master_sample").ajaxForm(optForm);
                $("#form__master_sample").submit();
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

                var domain  = laroute.route('cms_master_sample_edit', []);
                this.$http.post(domain, form).then(function(response) {
                    
                    if (response.status) {
                        vm.models = response.data
                        vm.target_selector = response.data.target_pengujian_id
                        vm.satuan_selector = response.data.satuan_id
                        vm.tgl_pengambilan_sample = response.data.tgl_pengambilan_sample

                        document.getElementById("kondisi_sample_"+response.data.kondisi_sample).checked = true;
                        $('#target_pengujian_id').val(response.data.target_pengujian_id).trigger("chosen:updated");
                        $('#satuan_id').val(response.data.satuan_id).trigger("chosen:updated");
                        $('#toggle-form-content').slideDown('swing')
                        
                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.kode_sample = ''
                this.models.nama_sample = ''
                this.models.jenis_sample = ''
                this.models.jml_vol = ''
                this.models.satuan_id = ''
                this.models.nama_komoditas = ''
                this.models.tgl_pengambilan_sample = ''
                this.models.metode_pengambilan_sample = ''
                this.models.kondisi_sample = ''
                this.models.target_pengujian_id = ''
                this.models.nama_customer = ''
                this.models.alamat = ''
                this.form_add_title = "List Data Sample"
                this.daerah_selector = ''

                $('#target_pengujian_id').val("").trigger("chosen:updated");
                $('#satuan_id').val("").trigger("chosen:updated");
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

                $("#satuan_id").chosen({    
                    width: "100%",    
                    disable_search: false,
                    theme: "dark"
                }).change(function() {
                    vm.satuan_selector = this.value

                }).trigger("chosen:updated");

                $(document).on('click',".datepick", function(param){
                    $(this).datepicker({
                        language: 'en',
                        dateFormat: 'yyyy-mm-dd',
                        navTitles: {days: 'MM <i>yyyy</i>'},
                        autoClose: false,
                        toggleSelected: false,
                        minDate: new Date()
                        
                    })

                    vm.tgl_pengambilan_sample = param.target.value
                });
            }

        },
        mounted: function () {

            this.fetchData();
            this.initChoosen();
        }

    });
}
