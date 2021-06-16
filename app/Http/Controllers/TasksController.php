<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    //basic index function
    public function index()
    {
        $tasks = auth()->user()->task();
        return view('dashboard', compact('tasks'));
    }
    
    //return view 'add'
    public function add()
    {
        return view('add');
    }
    
    //create task function
    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $task = new Task();
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }
    
    //edit task function
    public function edit(Task $task)
    {
        if (auth()->user()->id == $task->user_id)
        {
            return view('edit', compact('task'));
        }
        else
        {
            return redirect('/dashboard');   
        }
    }
    
    //update task function
    public function update(Request $request, Task $task)
    {
        if (isset($_POST['delete']))
        {
            $task->delete();
            return redirect('/dashboard');
        }
        else
        {
            $this->validate($request,[
                'description' => 'required'
            ]);
            $task->description = $request->description;
            
            $task->check = $request->has('check') ? 1 : 0;

            $task->save();
            return redirect('/dashboard');
        }
    }
}
