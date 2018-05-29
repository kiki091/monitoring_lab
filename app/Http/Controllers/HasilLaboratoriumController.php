<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\HasilLaboratorium as HasilLaboratoriumServices;
use App\Services\Bridge\KarantinaTumbuhan as KarantinaTumbuhanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class HasilLaboratoriumController extends BaseController
{
    protected $response;
    protected $karantinaTumbuhan;
    protected $hasilLaboratorium;

    public function __construct(ResponseService $response, KarantinaTumbuhanServices $karantinaTumbuhan, HasilLaboratoriumServices $hasilLaboratorium)
    {
        $this->response = $response;
        $this->karantinaTumbuhan = $karantinaTumbuhan;
        $this->hasilLaboratorium = $hasilLaboratorium;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.hasil-laboratorium.main';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }

    /**
     * Get Data 
     * @return string
     */

    public function getData(Request $request)
    {
        $data['list_data'] = $this->hasilLaboratorium->getData();
        $data['list_permohonan'] = $this->karantinaTumbuhan->getData($request->all());

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data
     * @return string
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validation($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->hasilLaboratorium->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->hasilLaboratorium->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [

            'keterangan'             => 'required',
            'kesimpulan'             => 'required',
            'karantina_tumbuhan_id'  => 'required',
            'hasil'                  => 'required',
        ];

        return $rules;
    }
}