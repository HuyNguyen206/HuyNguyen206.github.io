<?php
 namespace App\Traits;

 trait CreateMetaSEOTrait
 {
     function createMetaTag($title, $description, $keywords)
     {
         $title = ($title == null ? 'Chi tiết sản phẩm' : $title);
         $description = ($description == null ? 'Mô tả chi tiết sản phẩm' : $description);
         $keywords = ($keywords  == null ? 'tivi, dt, smartphone' : $keywords);
         return
                '<meta name ="description" content="'.$description.'"/>'
                .'<meta name ="keywords" content="'.$keywords.'"/>'
                .'<title>'.$title.'</title>';
     }
 }
