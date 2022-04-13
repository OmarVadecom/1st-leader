<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MainController;
use App\Models\Role\Role as role;
use App\Models\Role\RoleLang as roleLang;
use App\Models\Role\Permission as permission;
use App\Http\Requests\Admin\Role as roleReq;
use DataTables;
use Response;
use Auth;
use View;
class RoleController extends MainController
{
    private $viewPath = 'admin.role.';
    private $policy   = 'roles.';

    public function __construct()
    {
       View::share('pageTitle', trans('admin.roles'));
    }

 	public function index(Request $req)
 	{
 	   return $this->getView($this->viewPath . 'index', $this->policy . 'view');
 	}

 	public function create()
    {
        $permissions = permission::where('status', 1)->get();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['role' => null, 'permissions' => $permissions], 'create');
    }

    public function edit($id)
    {
        $role = role::findOrFail($id);
        $permissions = permission::where('status', 1)->get();
        $act = 'edit';
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['role' => $role, 'permissions' => $permissions], 'edit');
    }

    public function show($id)
    {
    	$role = role::findOrFail($id);
    	return $this->getView($this->viewPath . 'show', $this->policy . 'view', ['data' => $role], 'view');
    }

    public function store(roleReq $request)
    {
        if(! Auth::user()->can($this->policy . 'create')){
            return view(important_pages('403'));
        }

        $role = role::create([
            'status' => $request->status,
        ]);
        foreach (getAllLangFromDB() as $key => $lang){
            roleLang::create([
                'name'       => $request->name[$lang->code],
                'comment'    => $request->comment[$lang->code],
                'role_id'    => $role->id,
                'lang'       => $lang->code,
            ]);
        }
        $role->permissions()->sync($request->permissions);
        return redirect(route('role.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.role')]));
    }

    public function update($id, roleReq $request)
    {
        if(! Auth::user()->can($this->policy . 'create')){
            return view(important_pages('403'));
        }

        $role = role::findOrFail($id);
        if($id != 1){ 
            $role->update([
                'status' => $request->status,
            ]);
        }

        if($id != 1){
            $role->permissions()->sync($request->permissions);
        }
        return redirect(route('role.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.role')]));

    }

    public function destroy($id, Request $request)
    {
        if(! Auth::user()->can($this->policy . 'create')){
            if($request->ajax()){
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        if($id == 1){
             if($request->ajax()){
                return Response::json(trans('admin.ops'));
            }
            return view(important_pages('403'));
        }
        
        role::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => trans('admin.role')]);
        if($request->ajax()){
            return Response::json($delMessage);
        }
        return redirect(route('role.index'))->withFlashMessage($delMessage);
    }

 	public function AjaxLoad(role $data)
 	{
 	   $roles = $data->all();
    	$role = '';
    	return DataTables::of($roles)
           ->rawColumns(['action','select', 'status'])
           ->editColumn('select', function ($model) {
               return getSelectAjax($model);
            })

           ->editColumn('name', function ($model) {
              
                return $model->lang()->name;
            })
            
            ->editColumn('action', function ($model) {
            	return getAjaxAction($this->policy, $model, route('role.show', $model->id), route('role.edit', $model->id), route('role.destroy', $model->id));
            })
            ->make(true);
 	} 

 	public function multiDelete(Request $request, role $role)
    {

        if(! Auth::user()->can($this->policy . 'create')){
            if($request->ajax()){
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        if($request->ajax()){
            $ids = $request->id;
            foreach ($ids as $id) {
                if($id == 1){
                    continue;
                }

               $find =  $role->find($id);
               if($find == null){
                continue;
               }
               $find->delete();
            }
            return Response::json('done');
        }
        return view('errors.404');
        
    }
}
