<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new Category;

        $log = new Log();
        $log->method = $request->method();
        $log->table = $model->getTable();
        $log->user_id = 1;
        $log->save();

        if(! $model->count() > 0){
            return response()->json(['Mensagem' => 'Nenhuma categoria cadastrada']);
        }
        return $model->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Category;
        $table = $model->getTable();
        $dataForm = $request->all();

        $log = new Log;
        $method = $request->method();
        $log->method = $method;
        $log->item_name = $dataForm['name'];
        $log->table = $table;
        $log->user_id = 1;

        $log->save();
        
        if (! $model->create($dataForm)){
            return response()->json(['Error' => 'Erro ao inserir']);
        }
        return response()->json([
            'Message' => 'Inserido com sucesso',
            'Method' => $method,
            'Table' => $table,
            'Item' => $dataForm['name'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model = Category::find($id);

        $log = new Log();
        $log->method = $request->method();
        $log->item_name = $model->name;
        $log->item_id = $id;
        $log->table = $model->getTable();
        $log->user_id = 1;
        $log->save();

        if(! $model->count() > 0){
            return response()->json(['Mensagem' => 'Nenhuma categoria cadastrada']);
        }
        return $model->paginate();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
