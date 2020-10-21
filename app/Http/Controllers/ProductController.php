<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Exception;

class ProductController extends Controller
{
    //
    use UploadImageTrait;

    function getListProduct()
    {
        $products = Product::latest()->get();
//        dump($products);die;
        return view('backend.pages.products.list', compact('products'));
    }

    function getFormProduct()
    {
        $recursive = new Recursive(Category::all());
        $htmlSelectData = $recursive->categoryRecursive(0);
        return view('backend.pages.products.add', compact('htmlSelectData'));
    }

    function postFormProduct(CreateProductRequest $request)
    {


        try {
            DB::beginTransaction();
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->content = $request->contents;
            $product->user_id = Auth::id();
            $product->category_id = $request->category_id;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_desc = $request->meta_desc;
            $dataImage = $this->UploadImage($request, 'feature_image', 'products');
            if (!empty($dataImage)) {
                $product->feature_image_path = $dataImage['file_path'];
                $product->feature_image_name = $dataImage['file_name_origin'];
            }
            $product->save();
            //Insert product image
            if ($request->hasFile('image_detail')) {
                foreach ($request->file('image_detail') as $key => $file) {
                    $dataImageDetail = $this->UploadMultipleImage($file, 'productDetail');
                    $product->productImages()->create([
                        'image_name' => $dataImageDetail['file_name_origin'],
                        'image_path' => $dataImageDetail['file_path'],

                    ]);
                }
            }
            //Insert Tags and Product Tag relationship
            if ($request->has('tags')) {

                foreach ($request->tags as $key => $name) {
                    $tag = Tag::firstOrCreate(
                        ['name' => $name]
                    );
                    $tagsList[] = $tag->id;

//                    $productTag = ProductTag::firstOrCreate(
//                        ['product_id' => $product->id, 'tag_id' => $tag->id]
//                    );
                }
                $product->tags()->attach($tagsList);

            }
            DB::commit();
            event(new \App\Events\NewPostAdded($product));
            return redirect()->back()->with('message', 'Tạo sản phẩm thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            DB::rollback();
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }


    }

    function getEditProduct($id)
    {
        $product = Product::find($id);
        $recursive = new Recursive(Category::all());
        $htmlSelectData = $recursive->categoryRecursiveWithSelected(0, '', $product->category_id);
        return view('backend/pages/products/edit', compact('product', 'htmlSelectData'));

    }

    function postEditProduct(UpdateProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->content = $request->contents;
            $product->user_id = Auth::id();
            $product->category_id = $request->category_id;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_desc = $request->meta_desc;
            $dataImage = $this->UpdateUploadImage($request, 'feature_image', 'products', $id);
            if (!empty($dataImage)) {
                $product->feature_image_path = $dataImage['file_path'];
                $product->feature_image_name = $dataImage['file_name_origin'];
            }
            $product->save();

            //Remove all old image
            if (!$request->has('preloaded')) {

                foreach ($product->productImages as $pi) {
                    unlink(storage_path('app/public/productDetail/' . explode('/', $pi->image_path)[3]));
                }
                $product->productImages()->delete();
            } else {
                $listIdImageRemove = [];
                foreach ($product->productImages as $pi) {
                    if (!in_array((string)$pi->id, $request->preloaded)) {
                        $listIdImageRemove[] = $pi->id;
                    }
                }
                foreach ($listIdImageRemove as $idImageRemove) {
                    unlink(storage_path('app/public/productDetail/' . explode('/', ProductImage::find($idImageRemove)->image_path)[3]));
                }
                ProductImage::destroy($listIdImageRemove);
            }

            //Insert product image
            if ($request->hasFile('image_detail')) {
                foreach ($request->file('image_detail') as $key => $file) {
                    $dataImageDetail = $this->UploadMultipleImage($file, 'productDetail');
                    $product->productImages()->create([
                        'image_name' => $dataImageDetail['file_name_origin'],
                        'image_path' => $dataImageDetail['file_path'],

                    ]);
                }
            }

            //Insert Tags and Product Tag relationship
            if ($request->has('tags')) {
                //Remove all tags belong to that product
//                $product->tags()->detach();
                foreach ($request->tags as $key => $name) {
                    $tag = Tag::firstOrCreate(
                        ['name' => $name]
                    );
                    $tagsList[] = $tag->id;

//                    $productTag = ProductTag::firstOrCreate(
//                        ['product_id' => $product->id, 'tag_id' => $tag->id]
//                    );
                }
                $product->tags()->sync($tagsList);

            }
            DB::commit();
            return redirect()->back()->with('message', 'Chỉnh sửa sản phẩm thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            DB::rollback();
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            foreach ($product->productImages as $pi) {
                unlink(storage_path('app/public/productDetail/' . explode('/', $pi->image_path)[3]));
            }
            $product->productImages()->delete();
            $product->tags()->detach();
            if(!empty($product->feature_image_path))
            {
                unlink(storage_path('app/public/products/' . explode('/', $product->feature_image_path)[3]));
            }
            $product->delete();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => "success"
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'message' => $ex->getMessage()
            ], 500);
        }

    }
}
