<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\CreateMetaSEOTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    use CreateMetaSEOTrait;
    function showProductBelongToCategory($categoryParent, $categoryType = null)
    {
        $parent = Category::where('slug', $categoryParent)->first();
        if($categoryType == null)
        {

            $products = $parent->products()->paginate(6);
        }
        else
        {
            $parentChild = $parent->childCategory()->where('slug',$categoryType )->first();
            $products = $parentChild->products()->paginate(6);
        }
        return view('frontend.product.show-product', compact('products'));
    }

    function showProductDetail(Request $request,$categoryType, $productId)
    {
        $product = Product::findOrFail($productId);
        $recommendProducts= Product::latest('views_count')->get();
        $metaSEOTag = $this->createMetaTag($product->name, $product->meta_desc, $product->meta_keywords);
        $urlCanocical = $request->url();
        return view('frontend.product.show-product-detail', compact('product', 'recommendProducts', 'metaSEOTag', 'urlCanocical'));
    }

    function searchProduct(Request $request)
    {
        $key_search = $request->key_search;
        $products = Product::where('name', 'like',  '%'.$key_search.'%')->paginate(5);
        return view('frontend.search.search-product', compact('products', 'key_search'));
    }
}
