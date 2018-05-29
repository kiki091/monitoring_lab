(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"users_login","action":"App\Http\Controllers\Auth\AuthController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"users_register","action":"App\Http\Controllers\Auth\AuthController@register"},{"host":null,"methods":["POST"],"uri":"registered","name":"users_registered","action":"App\Http\Controllers\Auth\AuthController@registered"},{"host":null,"methods":["POST"],"uri":"auth","name":"users_authenticate","action":"App\Http\Controllers\Auth\AuthController@authenticate"},{"host":null,"methods":["POST"],"uri":"change-password","name":"users_chenge_password","action":"App\Http\Controllers\Auth\AuthController@changePassword"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"users_logout","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"cms","name":"users_dashboard","action":"App\Http\Controllers\Auth\DashboardController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/karantina-tumbuhan","name":"cms_karantina_tumbuhan_index","action":"App\Http\Controllers\KarantinaTumbuhanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/karantina-tumbuhan\/data","name":"cms_karantina_tumbuhan_data","action":"App\Http\Controllers\KarantinaTumbuhanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/karantina-tumbuhan\/store","name":"cms_karantina_tumbuhan_store","action":"App\Http\Controllers\KarantinaTumbuhanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/karantina-tumbuhan\/edit","name":"cms_karantina_tumbuhan_edit","action":"App\Http\Controllers\KarantinaTumbuhanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/karantina-tumbuhan\/varifikasi","name":"cms_karantina_tumbuhan_varifikasi","action":"App\Http\Controllers\KarantinaTumbuhanController@varifikasi"},{"host":null,"methods":["POST"],"uri":"cms\/karantina-tumbuhan\/confirm","name":"cms_karantina_tumbuhan_confirm","action":"App\Http\Controllers\KarantinaTumbuhanController@confirm"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/korfug","name":"cms_korfug_index","action":"App\Http\Controllers\KorfugController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/korfug\/data","name":"cms_korfug_data","action":"App\Http\Controllers\KorfugController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/korfug\/store","name":"cms_korfug_store","action":"App\Http\Controllers\KorfugController@store"},{"host":null,"methods":["POST"],"uri":"cms\/korfug\/edit","name":"cms_korfug_edit","action":"App\Http\Controllers\KorfugController@edit"},{"host":null,"methods":["POST"],"uri":"cms\/korfug\/delete","name":"cms_korfug_delete","action":"App\Http\Controllers\KorfugController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/sample-tumbuhan","name":"cms_sample_tumbuhan_index","action":"App\Http\Controllers\SampleTumbuhanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/sample-tumbuhan\/data","name":"cms_sample_tumbuhan_data","action":"App\Http\Controllers\SampleTumbuhanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/sample-tumbuhan\/store","name":"cms_sample_tumbuhan_store","action":"App\Http\Controllers\SampleTumbuhanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/sample-tumbuhan\/edit","name":"cms_sample_tumbuhan_edit","action":"App\Http\Controllers\SampleTumbuhanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/upt","name":"cms_master_upt_index","action":"App\Http\Controllers\MasterUptController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/upt\/data","name":"cms_master_upt_data","action":"App\Http\Controllers\MasterUptController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/upt\/store","name":"cms_master_upt_store","action":"App\Http\Controllers\MasterUptController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/upt\/edit","name":"cms_master_upt_edit","action":"App\Http\Controllers\MasterUptController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/laboratorium","name":"cms_master_laboratorium_index","action":"App\Http\Controllers\MasterLaboraoriumController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/laboratorium\/data","name":"cms_master_laboratorium_data","action":"App\Http\Controllers\MasterLaboraoriumController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/laboratorium\/store","name":"cms_master_laboratorium_store","action":"App\Http\Controllers\MasterLaboraoriumController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/laboratorium\/edit","name":"cms_master_laboratorium_edit","action":"App\Http\Controllers\MasterLaboraoriumController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-daerah","name":"cms_master_daftar_daerah_index","action":"App\Http\Controllers\DaftarDaerahController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/daftar-daerah\/data","name":"cms_master_daftar_daerah_data","action":"App\Http\Controllers\DaftarDaerahController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-daerah\/store","name":"cms_master_daftar_daerah_store","action":"App\Http\Controllers\DaftarDaerahController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/daftar-daerah\/edit","name":"cms_master_daftar_daerah_edit","action":"App\Http\Controllers\DaftarDaerahController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/kegiatan","name":"cms_master_kegiatan_index","action":"App\Http\Controllers\MasterKegiatanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/kegiatan\/data","name":"cms_master_kegiatan_data","action":"App\Http\Controllers\MasterKegiatanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/kegiatan\/store","name":"cms_master_kegiatan_store","action":"App\Http\Controllers\MasterKegiatanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/kegiatan\/edit","name":"cms_master_kegiatan_edit","action":"App\Http\Controllers\MasterKegiatanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/kategori","name":"cms_master_kategori_index","action":"App\Http\Controllers\MasterKategoriController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/kategori\/data","name":"cms_master_kategori_data","action":"App\Http\Controllers\MasterKategoriController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/kategori\/store","name":"cms_master_kategori_store","action":"App\Http\Controllers\MasterKategoriController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/kategori\/edit","name":"cms_master_kategori_edit","action":"App\Http\Controllers\MasterKategoriController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/perusahaan","name":"cms_master_perusahaan_index","action":"App\Http\Controllers\MasterPerusahaanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/perusahaan\/data","name":"cms_master_perusahaan_data","action":"App\Http\Controllers\MasterPerusahaanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/perusahaan\/store","name":"cms_master_perusahaan_store","action":"App\Http\Controllers\MasterPerusahaanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/perusahaan\/edit","name":"cms_master_perusahaan_edit","action":"App\Http\Controllers\MasterPerusahaanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/dokter","name":"cms_master_dokter_index","action":"App\Http\Controllers\MasterDokterController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/master-data\/dokter\/data","name":"cms_master_dokter_data","action":"App\Http\Controllers\MasterDokterController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/dokter\/store","name":"cms_master_dokter_store","action":"App\Http\Controllers\MasterDokterController@store"},{"host":null,"methods":["POST"],"uri":"cms\/master-data\/dokter\/edit","name":"cms_master_dokter_edit","action":"App\Http\Controllers\MasterDokterController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/target-pengujian","name":"cms_target_pengujian_index","action":"App\Http\Controllers\TargetPengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/target-pengujian\/data","name":"cms_target_pengujian_data","action":"App\Http\Controllers\TargetPengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/target-pengujian\/store","name":"cms_target_pengujian_store","action":"App\Http\Controllers\TargetPengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/target-pengujian\/edit","name":"cms_target_pengujian_edit","action":"App\Http\Controllers\TargetPengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/metode-pengujian","name":"cms_metode_pengujian_index","action":"App\Http\Controllers\MetodePengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/metode-pengujian\/data","name":"cms_metode_pengujian_data","action":"App\Http\Controllers\MetodePengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/metode-pengujian\/store","name":"cms_metode_pengujian_store","action":"App\Http\Controllers\MetodePengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/metode-pengujian\/edit","name":"cms_metode_pengujian_edit","action":"App\Http\Controllers\MetodePengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/daftar-pengujian","name":"cms_daftar_pengujian_index","action":"App\Http\Controllers\DaftarPengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/daftar-pengujian\/data","name":"cms_daftar_pengujian_data","action":"App\Http\Controllers\DaftarPengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/daftar-pengujian\/store","name":"cms_daftar_pengujian_store","action":"App\Http\Controllers\DaftarPengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/daftar-pengujian\/edit","name":"cms_daftar_pengujian_edit","action":"App\Http\Controllers\DaftarPengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/kelompok-pengujian","name":"cms_kelompok_pengujian_index","action":"App\Http\Controllers\KelompokPengujianController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/kelompok-pengujian\/data","name":"cms_kelompok_pengujian_data","action":"App\Http\Controllers\KelompokPengujianController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/kelompok-pengujian\/store","name":"cms_kelompok_pengujian_store","action":"App\Http\Controllers\KelompokPengujianController@store"},{"host":null,"methods":["POST"],"uri":"cms\/kelompok-pengujian\/edit","name":"cms_kelompok_pengujian_edit","action":"App\Http\Controllers\KelompokPengujianController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/penugasan","name":"cms_penugasan_index","action":"App\Http\Controllers\PenugasanController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/penugasan\/data","name":"cms_penugasan_data","action":"App\Http\Controllers\PenugasanController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/penugasan\/store","name":"cms_penugasan_store","action":"App\Http\Controllers\PenugasanController@store"},{"host":null,"methods":["POST"],"uri":"cms\/penugasan\/edit","name":"cms_penugasan_edit","action":"App\Http\Controllers\PenugasanController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/hasil-laboratorium","name":"cms_hasil_laboratorium_index","action":"App\Http\Controllers\HasilLaboratoriumController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/hasil-laboratorium\/data","name":"cms_hasil_laboratorium_data","action":"App\Http\Controllers\HasilLaboratoriumController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/hasil-laboratorium\/store","name":"cms_hasil_laboratorium_store","action":"App\Http\Controllers\HasilLaboratoriumController@store"},{"host":null,"methods":["POST"],"uri":"cms\/hasil-laboratorium\/edit","name":"cms_hasil_laboratorium_edit","action":"App\Http\Controllers\HasilLaboratoriumController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-group","name":"CmsMenuGroupManager","action":"App\Http\Controllers\Auth\MenuGroupController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-group\/data","name":"CmsMenuGroupManagerGetData","action":"App\Http\Controllers\Auth\MenuGroupController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/menu-group\/change-status","name":"CmsMenuGroupManagerChangeStatus","action":"App\Http\Controllers\Auth\MenuGroupController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-navigation","name":"CmsMenuNavigation","action":"App\Http\Controllers\Auth\MenuNavigationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/menu-navigation\/data","name":"CmsMenuNavigationGetData","action":"App\Http\Controllers\Auth\MenuNavigationController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/menu-navigation\/change-status","name":"CmsMenuNavigationChangeStatus","action":"App\Http\Controllers\Auth\MenuNavigationController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/sub-menu-navigation","name":"CmsSubMenuNavigation","action":"App\Http\Controllers\Auth\SubMenuNavigationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/sub-menu-navigation\/data","name":"CmsSubMenuNavigationGetData","action":"App\Http\Controllers\Auth\SubMenuNavigationController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/sub-menu-navigation\/change-status","name":"CmsSubMenuNavigationChangeStatus","action":"App\Http\Controllers\Auth\SubMenuNavigationController@changeStatus"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/user-account","name":"CmsUserAccount","action":"App\Http\Controllers\Auth\UserAccountController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cms\/account\/user-account\/data","name":"CmsUserAccountGetData","action":"App\Http\Controllers\Auth\UserAccountController@getData"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/change-status","name":"CmsUserAccountChangeStatus","action":"App\Http\Controllers\Auth\UserAccountController@changeStatus"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/store","name":"CmsUserAccountStoreData","action":"App\Http\Controllers\Auth\UserAccountController@store"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/edit","name":"CmsUserAccountEditData","action":"App\Http\Controllers\Auth\UserAccountController@edit"},{"host":null,"methods":["POST"],"uri":"cms\/account\/user-account\/change-password","name":"CmsUserAccountChangePassword","action":"App\Http\Controllers\Auth\UserAccountController@changePassword"}],
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

