<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    function getListCategory()
    {
        $categories = $this->category->all();
        return view('backend.pages.category.list', compact('categories'));
    }
    function getFormCategory()
    {
        $recursive = new Recursive($this->category->all());
        $htmlSelectData = $recursive->categoryRecursive(0);
        return view('backend.pages.category.add', compact('htmlSelectData'));
    }

    function postFormCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_name_id' => 'required'
        ],
            [
                'name.required' => 'Vui lòng nhập tên category',
                'parent_name_id.required' => 'Vui lòng nhập chọn category cha',

        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_name_id;
        $category->slug = to_slug($category->name);
        $category->save();
        return redirect()->back()->with('message', 'Tạo category thành công');
    }

    function getEditCategory($id)
    {
        $category = Category::find($id);
        $recursive = new Recursive(Category::all());
        $htmlSelectData = $recursive->categoryRecursiveWithSelected(0, '', $category->parent_id);
        return view('backend.pages.category.edit', compact('category', 'htmlSelectData'));
    }
    function postEditCategory(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_name_id' => 'required'
        ],
            [
                'name.required' => 'Vui lòng nhập tên category',
                'parent_name_id.required' => 'Vui lòng nhập chọn category cha',

            ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_name_id;
        $category->slug = to_slug($category->name);
        $category->save();
        return redirect()->back()->with('message', 'Sửa category thành công');
    }

    function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message', 'Xóa category thành công');
    }


}
