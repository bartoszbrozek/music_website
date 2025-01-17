<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Model\Settings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingsController extends Controller
{
    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return ['success' => true, 'settings' => $this->settings->getAllToArray()];
        } catch (\Exception $ex) {
            return ['error' => true, 'errorMsg' => $ex->getMessage(), 'settings' => []];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        $request->validate([
            'pageTitle' => 'required|max:255',
        ]);

        $response = new ResponseHelper($response);
        $settings = $request->all();

        try {
            foreach ($settings as $key => $value) {
                $this->settings->saveSetting($key, $value);
            }
        } catch (\Exception $ex) {
            return $response
                ->setMsg($ex->getMessage())
                ->error()
                ->get();
        }

        return $response
            ->setMsg('Settings saved succesfully')
            ->success()
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
