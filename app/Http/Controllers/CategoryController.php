<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(Category $category)
    {

        $data=$category->findAll();
        return view('backend.category.index', [
            'data'=>$data,
             'title'=>'Listagem Categorias',
             'meta_desc'=>'Esta é uma pequena descrição para categorias'
        ]);
    }


    public function create()
    {
        return view('backend.category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
        ]);

        if ($request->hasFile('cat_image')) {
            $image=$request->file('cat_image');
            $relImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$relImage);
        }else{
            $reImage='na';
        }
        $category=new Category();
        $category->title=$request->title;
        $category->detail=$request->detail;
        $category->image=$relImage;
        $category->save();

        return redirect('admin/category/create')->with('success', 'Dados Criados com Sucesso!');
    }


    public function edit($id)
    {
        $data=Category::find($id);
        return view('backend.category.update', ['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
        ]);

        if ($request->hasFile('cat_image')) {
            $image=$request->file('cat_image');
            $relImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$relImage);
        }else {
            $relImage=$request->cat_image;
        }
        $category=Category::find($id);
        $category->title=$request->title;
        $category->detail=$request->detail;
        $category->image=$relImage;
        $category->save();

        return redirect('admin/category/'.$id.'/edit')->with('success', 'Dados Actualizado com Sucesso!');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect('admin/category');
    }
}
