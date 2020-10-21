<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Setting;
use App\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Mockery\Exception;

class SettingController extends Controller


{//
    use UploadImageTrait, DeleteModelTrait;

    function getListSetting()
    {
        $settings = Setting::latest()->get();
        return view('backend.pages.setting.list', compact('settings'));
    }

    function getFormSetting()
    {
        return view('backend.pages.setting.add');
    }

    function postFormSetting(CreateSettingRequest $request)
    {
        try {
            $setting= new Setting();
            $setting->config_key = $request->config_key;
            $setting->config_value = $request->config_value;
            $setting->type = $request->type;
            $setting->save();
            return redirect()->back()->with('message', 'Tạo Setting thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }

    }

    function getEditSetting($id)
    {
        $setting = Setting::find($id);
        return view('backend/pages/setting/edit', compact('setting'));

    }

    function postEditSetting(UpdateSettingRequest $request, $id)
    {
        try {

            $setting = Setting::find($id);
            $setting->config_key = $request->config_key;
            $setting->config_value = $request->config_value;
            $setting->save();
            return redirect()->back()->with('message', 'Chỉnh sửa setting thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteSetting($id)
    {
        return $this->delete(new Setting(), $id, false,"");

    }
}
