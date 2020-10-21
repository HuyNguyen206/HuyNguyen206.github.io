<?php

namespace App\Traits;

use App\Product;
use App\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadImageTrait
{
    function UploadImage($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileNameOrigin = $file->getClientOriginalName();
            $imageUpload = $file->storeAs('public/' . $folderName, Str::random(20) . '.' . $file->getClientOriginalExtension());
            $dataImageUpload = [
                'file_name_origin' => $fileNameOrigin,
                'file_path' => Storage::url($imageUpload)
            ];
            return $dataImageUpload;
        } else {
            return null;
        }

    }


    function UpdateUploadImage($request, $fieldName, $folderName, $idType)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            switch ($folderName)
            {
                case "products":
                {
//                    dump(2);
                    $product = Product::find($idType);
                    if(!empty($product->feature_image_name))
                    {
//                        dump(explode('/', $product->feature_image_path));
//                        dump("app/public/".$folderName."/".explode('/', $product->feature_image_path)[2]);die;
//                        Storage::delete("app/public/".$folderName."/".explode('/', $product->feature_image_path)[3]);
                        unlink(storage_path('app/public/'.$folderName."/".explode('/', $product->feature_image_path)[3]));
                    }
                    break;
                }
                case "sliders":
                {
                    $slider = Slider::find($idType);
                    if(!empty($slider->image_name))
                    {
                        unlink(storage_path('app/public/'.$folderName."/".explode('/', $slider->image_path)[3]));
                    }
                    break;
                }
            }
            $fileNameOrigin = $file->getClientOriginalName();
            $imageUpload = $file->storeAs('public/' . $folderName, Str::random(20) . '.' . $file->getClientOriginalExtension());
            $dataImageUpload = [
                'file_name_origin' => $fileNameOrigin,
                'file_path' => Storage::url($imageUpload)
            ];
            return $dataImageUpload;
        } else {
            return null;
        }

    }

    function UploadMultipleImage($file, $folderName)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $imageUpload = $file->storeAs('public/'.$folderName, Str::random(20) . '.' . $file->getClientOriginalExtension());
            $dataImageUpload = [
                'file_name_origin' => $fileNameOrigin,
                'file_path' => Storage::url($imageUpload)
            ];
            return $dataImageUpload;

    }
}
