<?php
namespace App\Traits;

use App\Slider;

trait DeleteModelTrait
{
    function delete($modelInstance, $id, $hasImage, $folder="")
    {
        try {
            $model = $modelInstance->find($id);
            if($hasImage)
            {
                unlink(storage_path('app/public/'.$folder.'/' . explode('/', $model->image_path)[3]));
            }
            $model->delete();
            return response()->json([
                'code' => 200,
                'message' => "success"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => 500,
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
