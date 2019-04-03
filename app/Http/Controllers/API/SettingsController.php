<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Settings;
use Illuminate\Http\Request;

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
        } catch(\Exception $ex) {
            return ['error' => true, 'errorMsg' => $ex->getMessage(), 'settings' => []];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = $request->all();

        try {
            foreach ($settings as $key => $value) {
                $this->settings->saveSetting($key, $value);
            }
        } catch (\Exception $ex) {
            return ['error' => true, 'errorMsg' => $ex->getMessage()];
        }

        return ['success' => true];
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
