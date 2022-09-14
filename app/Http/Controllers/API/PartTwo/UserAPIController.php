<?php

namespace App\Http\Controllers\API\PartTwo;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateUserRequest;
use App\Models\User;
use App\Repositories\userRepository;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAPIController extends Controller
{
    use AuthenticatesUsers;

    private $userRepository;
    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getAllUsers();
            return $this->sendResponse($users, 'Users retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
            ]);
            if (auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                // Authentication passed...
                $data = User::where('username', $request->username)->first();
                return $this->sendResponse($data, 'User retrieved successfully');
            } else {
                return $this->sendError('invalid data', 200);
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $input = $request->all();
            $api_token = Str::random(60);
            $input['api_token'] = $api_token;
            $input['password'] = Hash::make($request->password);
            $this->userRepository->registerNewUser($input);
            return $this->sendResponse(['api_token' => $api_token], 'User registered successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->getUserInfo($id);
            return $this->sendResponse($user, 'User retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (isset($request->password)) {
                $request->request->add(['password' => Hash::make($request->password)]);
            }
            $input = $request->all();
            $this->userRepository->updateUser($input, $id);
            return $this->sendResponse([], 'User updated successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($api_token)
    {
        try {
            $this->userRepository->deleteUser($api_token);
            return $this->sendResponse([], 'User removed successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    public function username()
    {
        return 'username';
    }
}
