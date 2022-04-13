<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Admin\User as UserReq;
use App\Models\Role\Role;
use App\User;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use View;

class UserController extends MainController
{
    private $viewPath = 'admin.user.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.users'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create(Role $role)
    {
        $roles = $role->langPluck()->prepend(trans('admin.selectSom'), '0');
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['roles' => $roles], 'create');
    }

    public function edit($id, Role $role)
    {
        $roles = $role->langPluck()->prepend(trans('admin.selectSom'), '0');
        $user = User::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['roles' => $roles, 'user' => $user], 'edit');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'show', ['data' => $user], 'view');
    }

    public function store(User $user, UserReq $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('404'));
        }

        if ($request->isAdmin == 1 && $request->role_id == null) {
            return redirect()->back()->withInput($request->all())->withErrors(['role_id' => trans('validation.required', ['attribute' => 'role'])]);
        }

        $user->create($this->getInput($request));

        return redirect(route('users.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.user')]));
    }

    public function update($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('403'));
        }
        if ($id == 1 && Auth::user()->id != 1) {
            return view('admin.errors.403');
        }
        if ($request->isAdmin == 1 && $request->role_id == null) {
            return redirect()->back()->withInput($request->all())->withErrors(['role_id' => trans('validation.required', ['attribute' => 'role'])]);
        }
        $user = User::findOrFail($id);
        $user->update($this->getInput($request, $id));
        return redirect(route('users.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.user')]));
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.404'));
            }
            return view(important_pages('404'));
        }

        if ($id != 1) {
            User::findOrFail($id)->delete();
            $delMessage = trans('admin.deleted', ['name' => trans('admin.user')]);
            if ($request->ajax()) {
                return Response::json($delMessage);
            }
            return redirect(route('user.index'))->withFlashMessage($delMessage);
        }
        return false;
    }

    public function formUpdate()
    {
        return view($this->viewPath . 'update');
    }

    public function dataUpdate(Request $request)
    {
        $input = $request->only('name', 'email');
        Auth::user()->update($input);
        return redirect()->back()->withFlashMessage(trans('admin.updated', ['name' => trans('admin.user')]));
    }

    private function getInput($request, $id = null)
    {
        $input = $request->only('name', 'email', 'password', 'role_id', 'isAdmin', 'type', 'branch');
        if ($id != null) {
            $roleID = $id == 1 ? 1 : $request->role_id;
            $adminOrUser = $id == 1 ? 1 : $request->isAdmin;
            $input['type'] = $request->type;
            $input['role_id'] = $roleID;
            $input['isAdmin'] = $adminOrUser;
        }
        return $input;
    }

    /* Ajax */
    public function AjaxLoad(User $data)
    {
        $users = $data->currentYear()->get();
        return DataTables::of($users)
            ->rawColumns(['action', 'select'])
            ->editColumn('select', function ($model) {
                return $model->id;
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('users.show', $model->id), route('users.edit', $model->id), route('users.destroy', $model->id), ['edit' => [], 'show' => [], 'delete' => [1]]);
            })
            ->make(true);
    }

    public function changePass(Request $request, User $users)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.404'));
            }
            return view(important_pages('404'));
        }

        if (!$request->ajax()) {
            return view('errors.404');
        }

        $rules = array(
            'password' => 'required|string|min:6',
        );
        // for Validator
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $user = User::find($request->id);
            $user->update(['password' => $request->password]);
            return Response::json('done');
        }
    }
}
