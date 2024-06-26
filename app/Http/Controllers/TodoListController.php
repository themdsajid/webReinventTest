<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoLists = TodoList::all();
        return view('TodoList', ['todoLists' => $todoLists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoStoreRequest $request)
    {
        // dd($request);

        $todo = TodoList::create([
            'task_name' => $request->task_name,
        ]);

        // return redirect()->back();
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // dd($id);

        $todo = TodoList::find($id);

        $todo->status = $request->status;
        $todo->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // dd($id);
        $todo = TodoList::find($id);
        $todo->delete();

        // return response()->json(['success' => true]);
        return redirect()->back();
    }
}
