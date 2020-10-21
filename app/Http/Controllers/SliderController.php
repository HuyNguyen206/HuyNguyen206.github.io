<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Product;
use App\ProductImage;
use App\Setting;
use App\Slider;
use App\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Mockery\Exception;

class SliderController extends Controller

{//
    use UploadImageTrait, DeleteModelTrait;

    function getListSlider()
    {
        $sliders = Slider::latest()->get();
//        dump($products);die;
        return view('backend.pages.sliders.list', compact('sliders'));
    }

    function getFormSlider()
    {
        return view('backend.pages.sliders.add');
    }

    function postFormSlider(CreateSliderRequest $request)
    {
        try {
            $slide= new Slider();
            $slide->name = $request->name;
            $slide->description = $request->description;
            $dataImage = $this->UploadImage($request, 'feature_image', 'sliders');
            if (!empty($dataImage)) {
                $slide->image_path = $dataImage['file_path'];
                $slide->image_name = $dataImage['file_name_origin'];
            }
            $slide->save();
            return redirect()->back()->with('message', 'Tạo Slider thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }

    }

    function getEditSlider($id)
    {
        $slider = Slider::find($id);
        return view('backend/pages/sliders/edit', compact('slider'));

    }

    function postEditSlider(UpdateSliderRequest $request, $id)
    {
        try {

            $slider = Slider::find($id);
            $slider->name = $request->name;
            $slider->description = $request->description;
            if($request->hasFile('feature_image'))
            {
                $dataImage = $this->UpdateUploadImage($request, 'feature_image', 'sliders', $id);
                if (!empty($dataImage)) {
                    $slider->image_path = $dataImage['file_path'];
                    $slider->image_name = $dataImage['file_name_origin'];
                }
            }
            $slider->save();
            return redirect()->back()->with('message', 'Chỉnh sửa slider thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteSlider($id)
    {
        return $this->delete(new Slider(), $id, true,"sliders");

    }
}
