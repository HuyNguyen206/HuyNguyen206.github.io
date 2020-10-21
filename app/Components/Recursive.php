<?php

namespace App\Components;

class Recursive
{
    private  $dataCategory;
    private $htmlSelect;
    public function __construct($data)
    {
        $this->dataCategory = $data;
        $this->htmlSelect = '';
    }
    function categoryRecursive($id, $txt = '')
    {
        foreach ($this->dataCategory as $value)
        {
            if($value->parent_id == $id)
            {
                $this->htmlSelect.= "<option value='".$value->id."'>".$txt. $value->name."</option>";
                $this->categoryRecursive($value->id, '-'.$txt);
            }
        }
        return  $this->htmlSelect;
    }

    function categoryRecursiveWithSelected($id, $txt = '', $parent_id)
    {
        foreach ($this->dataCategory as $value)
        {
            if($value->parent_id == $id)
            {
                if($parent_id == $value->id)
                {
                    $this->htmlSelect.= "<option selected  value='".$value->id."'>".$txt. $value->name."</option>";
                }
                else
                {
                    $this->htmlSelect.= "<option  value='".$value->id."'>".$txt. $value->name."</option>";
                }
                $this->categoryRecursiveWithSelected($value->id, '-'.$txt, $parent_id);
            }
        }
        return  $this->htmlSelect;
    }


}
