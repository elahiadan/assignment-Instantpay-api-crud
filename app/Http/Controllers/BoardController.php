<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BoardController extends BaseController
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

            // get boards details with login user and tasks
            $boards = Board::with(['user', 'tasks'])->where(Board::USER_ID, $userId)->get();

            // check boards exists
            if (empty($boards)) {
                return $this->sendError('Board not found');
            }

            //  send reponse
            return $this->sendResponse($boards);
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

            // validate input data
            $validator = Validator::make($data, [
                Board::NAME => 'required|string|max:255',
            ]);

            // check validation fail
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // create new board
            $board = new Board();
            $board->{Board::NAME} = $data['name'];
            $board->{Board::USER_ID} = Auth::id();
            $board->save();

            //  send response
            return $this->sendResponse($board, "Board created successfully", 201);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function update(Request $request, $boardId)
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

            // validate input data
            $validator = Validator::make($data, [
                Board::NAME => 'required|string|max:255',
            ]);

            // check validation fail
            if ($validator->fails()) {
                return $this->sendError('something went wrong', 422, $validator->errors());
            }

            // get board details with login user
            $board = Board::where([Board::ID => $boardId, Board::USER_ID => $userId])->first();

            // check board exists
            if (empty($board)) {
                return $this->sendError('Board not found');
            }

            // update board details
            $board->update($data);

            //  send response
            return $this->sendResponse($board, "Board updated successfully");
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }

    public function destroy($boardId)
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

            // get board details with login user
            $board = Board::where([Board::USER_ID => $userId, Board::ID => $boardId])->first();

            // check board exists
            if (empty($board)) {
                return $this->sendError('Board not found');
            }

            // delete tasks
            Task::where([Task::USER_ID => $userId, Task::BOARD_ID => $boardId])->delete();

            // delete board
            $board->delete();

            //  send response
            return $this->sendResponse(null, "Board deleted successfully", 200);
        } catch (\Throwable $error) {
            return $this->sendError('something went wrong', 500, $error);
        }
    }
}
