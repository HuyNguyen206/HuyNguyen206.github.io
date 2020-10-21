<?php

namespace App\Components;

use App\Menu;

class ModelRecursive
{
    private $htmlSelect;
    public function __construct()
    {
        $this->htmlSelect = '';
    }
    function modelRecursive($parentId, $txt = '', $model)
    {
        $menus = $model->where('parent_id', $parentId)->get();
        foreach ($menus as $value)
        {
                $this->htmlSelect.= "<option value='".$value->id."'>".$txt. $value->name."</option>";
                $this->modelRecursive($value->id, '-'.$txt, $model);
        }
        return  $this->htmlSelect;
    }

    function modelRecursiveWithSelected($idSelected, $parentId, $txt = '', $model )
    {
        $menus = $model->where('parent_id', $parentId)->get();
        foreach ($menus as $value)
        {
            if($idSelected == $value->id)
            {
                $this->htmlSelect.= "<option selected value='".$value->id."'>".$txt. $value->name."</option>";
            }
            else
            {
                $this->htmlSelect.= "<option  value='".$value->id."'>".$txt. $value->name."</option>";
            }

            $this->modelRecursiveWithSelected($idSelected, $value->id, '-'.$txt, $model);
        }
        return  $this->htmlSelect;
    }

//    function categoryRecursiveWithSelected($id, $txt = '', $parent_id)
//    {
//        foreach ($this->dataCategory as $value)
//        {
//            if($value->parent_id == $id)
//            {
//                if($parent_id == $value->id)
//                {
//                    $this->htmlSelect.= "<option selected  value='".$value->id."'>".$txt. $value->name."</option>";
//                }
//                else
//                {
//                    $this->htmlSelect.= "<option  value='".$value->id."'>".$txt. $value->name."</option>";
//                }
//                $this->categoryRecursive($value->id, '-'.$txt, $parent_id);
//            }
//        }
//        return  $this->htmlSelect;
//    }


}
