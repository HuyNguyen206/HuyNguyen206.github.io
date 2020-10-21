<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Components\ModelRecursive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    //
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    function getListMenu()
    {
        $menus = $this->menu->all();
        return view('backend.pages.menu.list', compact('menus'));
    }
    function getFormMenu()
    {
        $recursive = new ModelRecursive();
        $htmlSelectData = $recursive->modelRecursive(0, '', new Menu());
        return view('backend.pages.menu.add', compact('htmlSelectData'));
    }

    function postFormMenu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_name_id' => 'required'
        ],
            [
                'name.required' => 'Vui lòng nhập tên menu',
                'parent_name_id.required' => 'Vui lòng nhập chọn menu cha',

            ]);
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_name_id;
        $menu->slug = to_slug($menu->name);
        $menu->save();
        return redirect()->back()->with('message', 'Tạo menu thành công');
    }

    function getEditMenu($id)
    {
        $menu = Menu::find($id);
        $recursive = new ModelRecursive();
        $htmlSelectData = $recursive->modelRecursiveWithSelected($menu->parent_id,0, '', new Menu());
        return view('backend.pages.menu.edit', compact('menu', 'htmlSelectData'));
    }
    function postEditMenu(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_name_id' => 'required'
        ],
            [
                'name.required' => 'Vui lòng nhập tên menu',
                'parent_name_id.required' => 'Vui lòng nhập chọn menu cha',

            ]);
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_name_id;
        $menu->slug = to_slug($menu->name);
        $menu->save();
        return redirect()->back()->with('message', 'Sửa menu thành công');
    }

    function deleteMenu($id)
    {
        $category = Menu::find($id);
        $category->delete();
        return redirect()->back()->with('message', 'Xóa menu thành công');
    }


}
