<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends BaseController
{
    public function index()
    {
        try {
            // get login user id
            $userId = Auth::id();

            // get user details
            $user = User::find($userId);

            // check user exists
            if (empty($user)) {
                return $this->sendError('Unauthenticated', 401);
            }

            // get tasks with boards and users
            $tasks = Task::with(['board' => function ($q) {
                $q->with('user');
            }])->where(Task::USER_ID, $userId)->get();

            // send response
            return $this->sendResponse($tasks);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function store(Request $request)
    {
        try {
            // get login user id
            $userId = Auth::id();

            // get user details
            $user = User::find($userId);

            // check user exists
            if (empty($user)) {
                return $this->sendError('Unauthenticated', 401);
            }

            // get input data from client
            $data = $request->all();

            // check data is validate or not
            $validator = Validator::make($data, [
                Task::NAME => 'required|string|max:255',
                Task::DESCRIPTION => 'required',
                Task::BOARD_ID => 'required|integer|exists:boards,id',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // get board details with user login user
            $board = Board::where([Board::ID => $data['board_id'], Board::USER_ID => $userId])->first();

            // check board exists
            if (empty($board)) {
                return $this->sendError('Board not found');
            }

            // create new task
            $task = new Task();
            $task->{Task::NAME} = $data['name'];
            $task->{Task::DESCRIPTION} = $data['description'];
            $task->{Task::BOARD_ID} = $data['board_id'];
            $task->{Task::USER_ID} = Auth::id();
            $task->{Task::STATUS} = Task::PENDING;
            $task->save();

            //  send response
            return $this->sendResponse($task, "Task created successfully", 201);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function update(Request $request, $taskId)
    {
        try {
            // get login user id
            $userId = Auth::id();

            // get user details
            $user = User::find($userId);

            // check user exists
            if (empty($user)) {
                return $this->sendError('Unauthenticated', 401);
            }

            //  input data from client
            $data = $request->all();

            // check data is validate or not
            $validator = Validator::make($data, [
                Task::NAME => 'required|string|max:255',
                Task::DESCRIPTION => 'required',
                Task::BOARD_ID => 'required|integer|exists:boards,id',
                Task::STATUS => 'required|integer|in:' . implode(",", Task::TASK_STATUS),
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // get task details with board and user login user
            $task = Task::where([Task::ID => $taskId, Task::USER_ID => $userId, Task::BOARD_ID => $data['board_id']])->first();

            // check task exists
            if (empty($task)) {
                return $this->sendError('Task not found');
            }

            // update task details
            $task->update($data);

            // send response
            return $this->sendResponse($task, "task updated successfully");
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function destroy($id)
    {
        try {
            // get login user id
            $userId = Auth::id();

            // get user details
            $user = User::find($userId);

            // check user exists
            if (empty($user)) {
                return $this->sendError('Unauthenticated', 401);
            }

            // get tasks
            $tasks = Task::where([Task::ID => $id, Task::USER_ID => $userId])->get();

            // check task exists
            if ($tasks->isEmpty()) {
                return $this->sendError('Task not found');
            }

            // delete tasks
            foreach ($tasks as $item) {
                $item->delete();
            }

            // send response
            return $this->sendResponse(null, "Task deleted successfully", 200);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }
}
