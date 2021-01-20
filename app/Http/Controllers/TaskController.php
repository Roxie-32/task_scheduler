<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks(){
        $tasks= Task::all();
        $response = [
            'tasks' => $tasks
        ];
          return response()->json($response,200);
    }

    public function getTask($id){
            $task= Task::find($id);
            $response = [
                'task' => $task
            ];
              return response()->json($response,200);
    }

    public function addTask(Request $request){

        $task = new Task();
        $task->user_id=$request->input('user_id');
        $task->task_title=$request->input('task_title');
        $task->task_desc=$request->input('task_desc');
        $task->task_date=$request->input('task_date');
        $task->task_time_start=$request->input('task_time_start');
        $task->task_time_end=$request->input('task_time_end');

        $task->save();
        return response()->json(['task'=>$task], 201);



    }

    public function updateTask(Request $request, $id){
            $task = Task::find($id);
            if(!$task) {
                return response()->json(['message'=>'Document not found'],404);
            }
            $task->user_id=$request->input('user_id');
            $task->task_title=$request->input('task_title');
            $task->task_desc=$request->input('task_desc');
            $task->task_date=$request->input('task_date');
            $task->task_time_start=$request->input('task_time_start');
            $task->task_time_end=$request->input('task_time_end');
    
            $task->save();
            return response()->json(['task'=>$task], 200);

        }

        public function deleteTask($id){
            $task= Task::find($id);
           $check= $task->delete();
           if($check==true){
            return response()->json(['task'=>'Task deleted'], 200);

           }

        }
}
