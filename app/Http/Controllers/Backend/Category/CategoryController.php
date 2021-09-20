<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:categories-read'])->only(['index']);
        $this->middleware(['permission:categories-create'])->only(['create','store']);
        $this->middleware(['permission:categories-update'])->only(['update','edit']);
        $this->middleware(['permission:categories-delete'])->only(['destroy']);

    }

    public function index(Request $request)
    {
        $search = $request->search?? null;
        $sorted_by = isset($request-> sorted_by )&& ( $request-> sorted_by=='created_at' ||$request-> sorted_by=='title' )?$request->sorted_by :'created_at';
        $order_by = isset($request->order_by )&& ( $request->order_by=='desc' ||$request->order_by=='asc' )?$request->order_by :'desc';
        $limit = isset($request->limit ) && filter_var($request->limit , FILTER_VALIDATE_INT)? $request->limit:5;
        if($limit> 500){
            $limit= 500;
        }


        $categories = Category::withCount('posts')
                 ->where( function($q) use( $search){
                    return $q->when(  $search , function($q)use( $search){
                        return  $q->where('title' ,'like', '%'.$search .'%');
                    });
                 })
                 ->orderBy($sorted_by , $order_by)->paginate($limit);

        return view('backend.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');

    }


    public function store(Request $request)
    {

        $valdator = Validator::make($request->all(),[
            'title'=>['required', 'min:2','unique:categories'],
            'status'=>['required'],
        ]);

        if($valdator->fails()){
         return    $this->sendErrors($valdator->errors()->toArray(), 'Please inter valid inputs');
        }

        $date = [
            'title'=>$request->title,
            'status'=>$request->status
        ];

        Category::create($date);
        Cache::forget('global_categories');

         return    $this->sendResponse([],'Category Added SuccessFully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('backend.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $valdator = Validator::make($request->all(),[
            'title'=>['required', 'min:2',Rule::unique('categories')->ignore($category->id)],
            'status'=>['required'],
        ]);

        if($valdator->fails()){
         return    $this->sendErrors($valdator->errors()->toArray(), 'Please inter valid inputs');
        }

        $date = [
            'title'=>$request->title,
            'status'=>$request->status
        ];

        $category->update($date);

        Cache::forget('global_categories');
         return    $this->sendResponse([],'Category Updaed SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Cache::forget('global_categories');
        return    $this->sendResponse([],'Category Deleted SuccessFully');

    }
}
