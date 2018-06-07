(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"users_login","action":"App\Http\Controllers\Auth\AuthController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"users_register","action":"App\Http\Controllers\Auth\AuthController@register"},{"host":null,"methods":["POST"],"uri":"registered","name":"users_registered","action":"App\Http\Controllers\Auth\AuthController@registered"},{"host":null,"methods":["POST"],"uri":"auth","name":"users_authenticate","action":"App\Http\Controllers\Auth\AuthController@authenticate"},{"host":null,"methods":["POST"],"uri":"change-password","name":"users_chenge_password","action":"App\Http\Controllers\Auth\AuthController@changePassword"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"users_logout","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"cms","name":"users_dashboard","action":"App\Http\Controllers\Auth\DashboardController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-daerah","name":"cms_master_daerah_index","action":"App\Http\Controllers\Pages\DaerahController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-daerah\/data","name":"cms_master_daerah_data","action":"App\Http\Controllers\Pages\DaerahController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-daerah\/store","name":"cms_master_daerah_store","action":"App\Http\Controllers\Pages\DaerahController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-daerah\/edit","name":"cms_master_daerah_edit","action":"App\Http\Controllers\Pages\DaerahController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-jabatan","name":"cms_master_jabatan_index","action":"App\Http\Controllers\Pages\JabatanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-jabatan\/data","name":"cms_master_jabatan_data","action":"App\Http\Controllers\Pages\JabatanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-jabatan\/store","name":"cms_master_jabatan_store","action":"App\Http\Controllers\Pages\JabatanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-jabatan\/edit","name":"cms_master_jabatan_edit","action":"App\Http\Controllers\Pages\JabatanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kelompok-metode-pengujian","name":"cms_master_kel_metode_pengujian_index","action":"App\Http\Controllers\Pages\KelompokMetodePengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kelompok-metode-pengujian\/data","name":"cms_master_kel_metode_pengujian_data","action":"App\Http\Controllers\Pages\KelompokMetodePengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kelompok-metode-pengujian\/store","name":"cms_master_kel_metode_pengujian_store","action":"App\Http\Controllers\Pages\KelompokMetodePengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kelompok-metode-pengujian\/edit","name":"cms_master_kel_metode_pengujian_edit","action":"App\Http\Controllers\Pages\KelompokMetodePengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-laboratorium","name":"cms_master_laboratorium_index","action":"App\Http\Controllers\Pages\LaboratoriumController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-laboratorium\/data","name":"cms_master_laboratorium_data","action":"App\Http\Controllers\Pages\LaboratoriumController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-laboratorium\/store","name":"cms_master_laboratorium_store","action":"App\Http\Controllers\Pages\LaboratoriumController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-laboratorium\/edit","name":"cms_master_laboratorium_edit","action":"App\Http\Controllers\Pages\LaboratoriumController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-pengujian","name":"cms_master_target_pengujian_index","action":"App\Http\Controllers\Pages\TargetPengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-pengujian\/data","name":"cms_master_target_pengujian_data","action":"App\Http\Controllers\Pages\TargetPengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-pengujian\/store","name":"cms_master_target_pengujian_store","action":"App\Http\Controllers\Pages\TargetPengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-pengujian\/edit","name":"cms_master_target_pengujian_edit","action":"App\Http\Controllers\Pages\TargetPengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-metode-pengujian","name":"cms_master_metode_pengujian_index","action":"App\Http\Controllers\Pages\MetodePengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-metode-pengujian\/data","name":"cms_master_metode_pengujian_data","action":"App\Http\Controllers\Pages\MetodePengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-metode-pengujian\/store","name":"cms_master_metode_pengujian_store","action":"App\Http\Controllers\Pages\MetodePengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-metode-pengujian\/edit","name":"cms_master_metode_pengujian_edit","action":"App\Http\Controllers\Pages\MetodePengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-pegawai","name":"cms_master_pegawai_index","action":"App\Http\Controllers\Pages\PegawaiController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-pegawai\/data","name":"cms_master_pegawai_data","action":"App\Http\Controllers\Pages\PegawaiController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-pegawai\/store","name":"cms_master_pegawai_store","action":"App\Http\Controllers\Pages\PegawaiController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-pegawai\/edit","name":"cms_master_pegawai_edit","action":"App\Http\Controllers\Pages\PegawaiController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kode-hs","name":"cms_master_kode_hs_index","action":"App\Http\Controllers\Pages\KodeHsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kode-hs\/data","name":"cms_master_kode_hs_data","action":"App\Http\Controllers\Pages\KodeHsController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kode-hs\/store","name":"cms_master_kode_hs_store","action":"App\Http\Controllers\Pages\KodeHsController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kode-hs\/edit","name":"cms_master_kode_hs_edit","action":"App\Http\Controllers\Pages\KodeHsController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kelompok-sample","name":"cms_master_kelompok_sample_index","action":"App\Http\Controllers\Pages\KelompokSampleController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kelompok-sample\/data","name":"cms_master_kelompok_sample_data","action":"App\Http\Controllers\Pages\KelompokSampleController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kelompok-sample\/store","name":"cms_master_kelompok_sample_store","action":"App\Http\Controllers\Pages\KelompokSampleController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kelompok-sample\/edit","name":"cms_master_kelompok_sample_edit","action":"App\Http\Controllers\Pages\KelompokSampleController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-satuan","name":"cms_master_satuan_index","action":"App\Http\Controllers\Pages\SatuanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-satuan\/data","name":"cms_master_satuan_data","action":"App\Http\Controllers\Pages\SatuanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-satuan\/store","name":"cms_master_satuan_store","action":"App\Http\Controllers\Pages\SatuanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-satuan\/edit","name":"cms_master_satuan_edit","action":"App\Http\Controllers\Pages\SatuanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-upt","name":"cms_master_upt_index","action":"App\Http\Controllers\Pages\UptController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-upt\/data","name":"cms_master_upt_data","action":"App\Http\Controllers\Pages\UptController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-upt\/store","name":"cms_master_upt_store","action":"App\Http\Controllers\Pages\UptController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-upt\/edit","name":"cms_master_upt_edit","action":"App\Http\Controllers\Pages\UptController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-uji-golongan","name":"cms_master_target_uji_golongan_index","action":"App\Http\Controllers\Pages\TargetUjiGolonganController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-uji-golongan\/data","name":"cms_master_target_uji_golongan_data","action":"App\Http\Controllers\Pages\TargetUjiGolonganController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-uji-golongan\/store","name":"cms_master_target_uji_golongan_store","action":"App\Http\Controllers\Pages\TargetUjiGolonganController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-uji-golongan\/edit","name":"cms_master_target_uji_golongan_edit","action":"App\Http\Controllers\Pages\TargetUjiGolonganController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-pest","name":"cms_master_target_pest_index","action":"App\Http\Controllers\Pages\TargetPestController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-target-pest\/data","name":"cms_master_target_pest_data","action":"App\Http\Controllers\Pages\TargetPestController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-pest\/store","name":"cms_master_target_pest_store","action":"App\Http\Controllers\Pages\TargetPestController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-target-pest\/edit","name":"cms_master_target_pest_edit","action":"App\Http\Controllers\Pages\TargetPestController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-jenis-pengujian","name":"cms_master_jenis_pengujian_index","action":"App\Http\Controllers\Pages\JenisPengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-jenis-pengujian\/data","name":"cms_master_jenis_pengujian_data","action":"App\Http\Controllers\Pages\JenisPengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-jenis-pengujian\/store","name":"cms_master_jenis_pengujian_store","action":"App\Http\Controllers\Pages\JenisPengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-jenis-pengujian\/edit","name":"cms_master_jenis_pengujian_edit","action":"App\Http\Controllers\Pages\JenisPengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-perusahaan","name":"cms_master_perusahaan_index","action":"App\Http\Controllers\Pages\PerusahaanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-perusahaan\/data","name":"cms_master_perusahaan_data","action":"App\Http\Controllers\Pages\PerusahaanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-perusahaan\/store","name":"cms_master_perusahaan_store","action":"App\Http\Controllers\Pages\PerusahaanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-perusahaan\/edit","name":"cms_master_perusahaan_edit","action":"App\Http\Controllers\Pages\PerusahaanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-negara","name":"cms_master_negara_index","action":"App\Http\Controllers\Pages\NegaraController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-negara\/data","name":"cms_master_negara_data","action":"App\Http\Controllers\Pages\NegaraController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-negara\/store","name":"cms_master_negara_store","action":"App\Http\Controllers\Pages\NegaraController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-negara\/edit","name":"cms_master_negara_edit","action":"App\Http\Controllers\Pages\NegaraController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-media-transpor","name":"cms_master_media_transpor_index","action":"App\Http\Controllers\Pages\MediaTransporController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-media-transpor\/data","name":"cms_master_media_transpor_data","action":"App\Http\Controllers\Pages\MediaTransporController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-media-transpor\/store","name":"cms_master_media_transpor_store","action":"App\Http\Controllers\Pages\MediaTransporController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-media-transpor\/edit","name":"cms_master_media_transpor_edit","action":"App\Http\Controllers\Pages\MediaTransporController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kegiatan","name":"cms_master_kegiatan_index","action":"App\Http\Controllers\Pages\KegiatanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kegiatan\/data","name":"cms_master_kegiatan_data","action":"App\Http\Controllers\Pages\KegiatanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kegiatan\/store","name":"cms_master_kegiatan_store","action":"App\Http\Controllers\Pages\KegiatanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kegiatan\/edit","name":"cms_master_kegiatan_edit","action":"App\Http\Controllers\Pages\KegiatanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-dokter-hewan","name":"cms_master_dokter_hewan_index","action":"App\Http\Controllers\Pages\DokterHewanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-dokter-hewan\/data","name":"cms_master_dokter_hewan_data","action":"App\Http\Controllers\Pages\DokterHewanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-dokter-hewan\/store","name":"cms_master_dokter_hewan_store","action":"App\Http\Controllers\Pages\DokterHewanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-dokter-hewan\/edit","name":"cms_master_dokter_hewan_edit","action":"App\Http\Controllers\Pages\DokterHewanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kategori","name":"cms_master_kategori_index","action":"App\Http\Controllers\Pages\KategoriController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-kategori\/data","name":"cms_master_kategori_data","action":"App\Http\Controllers\Pages\KategoriController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kategori\/store","name":"cms_master_kategori_store","action":"App\Http\Controllers\Pages\KategoriController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-kategori\/edit","name":"cms_master_kategori_edit","action":"App\Http\Controllers\Pages\KategoriController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-sample","name":"cms_master_sample_index","action":"App\Http\Controllers\Pages\SampleController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-sample\/data","name":"cms_master_sample_data","action":"App\Http\Controllers\Pages\SampleController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-sample\/store","name":"cms_master_sample_store","action":"App\Http\Controllers\Pages\SampleController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-sample\/edit","name":"cms_master_sample_edit","action":"App\Http\Controllers\Pages\SampleController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-permohonan","name":"cms_master_permohonan_index","action":"App\Http\Controllers\Pages\PermohonanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-permohonan\/data","name":"cms_master_permohonan_data","action":"App\Http\Controllers\Pages\PermohonanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-permohonan\/store","name":"cms_master_permohonan_store","action":"App\Http\Controllers\Pages\PermohonanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-permohonan\/edit","name":"cms_master_permohonan_edit","action":"App\Http\Controllers\Pages\PermohonanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-group","name":"CmsMenuGroupManager","action":"App\Http\Controllers\Auth\MenuGroupController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-group\/data","name":"CmsMenuGroupManagerGetData","action":"App\Http\Controllers\Auth\MenuGroupController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/menu-group\/change-status","name":"CmsMenuGroupManagerChangeStatus","action":"App\Http\Controllers\Auth\MenuGroupController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-navigation","name":"CmsMenuNavigation","action":"App\Http\Controllers\Auth\MenuNavigationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-navigation\/data","name":"CmsMenuNavigationGetData","action":"App\Http\Controllers\Auth\MenuNavigationController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/menu-navigation\/change-status","name":"CmsMenuNavigationChangeStatus","action":"App\Http\Controllers\Auth\MenuNavigationController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/sub-menu-navigation","name":"CmsSubMenuNavigation","action":"App\Http\Controllers\Auth\SubMenuNavigationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/sub-menu-navigation\/data","name":"CmsSubMenuNavigationGetData","action":"App\Http\Controllers\Auth\SubMenuNavigationController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/sub-menu-navigation\/change-status","name":"CmsSubMenuNavigationChangeStatus","action":"App\Http\Controllers\Auth\SubMenuNavigationController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/user-account","name":"CmsUserAccount","action":"App\Http\Controllers\Auth\UserAccountController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/user-account\/data","name":"CmsUserAccountGetData","action":"App\Http\Controllers\Auth\UserAccountController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/change-status","name":"CmsUserAccountChangeStatus","action":"App\Http\Controllers\Auth\UserAccountController@changeStatus"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/store","name":"CmsUserAccountStoreData","action":"App\Http\Controllers\Auth\UserAccountController@store"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/edit","name":"CmsUserAccountEditData","action":"App\Http\Controllers\Auth\UserAccountController@edit"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/change-password","name":"CmsUserAccountChangePassword","action":"App\Http\Controllers\Auth\UserAccountController@changePassword"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

