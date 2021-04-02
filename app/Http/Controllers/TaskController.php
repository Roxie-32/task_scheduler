<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    public function getAllTasks(){
        $tasks= Task::all();
        $response = [
            'tasks' => $tasks
        ];
          return response()->json($response,200);
    }

    public function getTask(){
            $task= Task::where('user_id', auth('api')->user()->id)->get();
            $response = [
                'task' => $task
            ];
              return response()->json($response,200);
    }

    public function addTask(TaskStoreRequest  $request){
        $task = new Task();
        $task->user_id=auth('api')->user()->id;
        $task->title=$request->input('title');
        $task->description=$request->input('description');
        $task->datetime=$request->input('datetime');
     
        $task->completed= (bool) $request->input('completed');

        $task->save();
        return response()->json(['task'=>$task], 201);



    }

    public function updateTask(TaskStoreRequest $request, $id){

        $user_id = auth('api')->user()->id;
        

        $result = Task::where('user_id', $user_id)->where('id', $id)->get();
        
            if(count($result)==0) {
                return response()->json(['message'=>'Document not found'],404);
            }else{
                $task = Task::find($id);
                if(!$task) {
                    return response()->json(['message'=>'Document not found'],404);
                }
                $task->user_id=auth('api')->user()->id;
                $task->title=$request->input('title');
                $task->description=$request->input('description');
                $task->datetime=$request->input('datetime');
                $task->completed=$request->input('completed');
        
                $task->save();
                return response()->json(['task'=>$task], 200);
            }
       

        }

        public function deleteTask($id){
            $user_id = auth('api')->user()->id;
        

            $result = Task::where('user_id', $user_id)->where('id', $id)->get();
            
                if(count($result)==0) {
                    return response()->json(['message'=>'Document not found'],404);
                }else{
            $task= Task::find($id);
           $check= $task->delete();
           if($check==true){
            return response()->json(['task'=>'Task deleted'], 200);
           }
           }

        }
}
