<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Contact as contact;
use App\Models\Message;
use App\User as AppUser;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use View;

class ContactController extends MainController
{
    private $viewPath = 'admin.contact.';
    private $policy = 'contacts.';

    public function __construct()
    {
        View::share('pageTitle', trans('admin.contacts'));
    }

    public function index(Request $req)
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function show($id)
    {
        $message = contact::findOrFail($id);
        $message->update(['status' => 1]);

        return $this->getView($this->viewPath . 'show', $this->policy . 'view', ['message' => $message], 'view');
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        contact::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => trans('admin.contact')]);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('contact.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(contact $data)
    {
        $contacts = $data->currentYear()->get();
        return DataTables::of($contacts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('status', function ($model) {

                return getMsgStatus($model->show, $model->id);
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('contact.show', $model->id), null, route('contact.destroy', $model->id));
            })
            ->make(true);
    }

    public function multiDelete(Request $request, contact $data)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        if ($request->ajax()) {
            $ids = $request->id;
            foreach ($ids as $id) {
                $find = $data->find($id);
                if ($find == null) {
                    continue;
                }
                $find->delete();
            }
            return Response::json('done');
        }
        return view('errors.404');

    }


    public function getincomes(){

        View::share('pageTitle', 'messages');

        return $this->getView($this->viewPath . 'incomes', $this->policy . 'view');

    }


    public function ajaxloadincomes(Message $data){
        $user=Auth::user()->id;
        $messages = Message::where('mesg_to',$user)->currentYear()->get();
        return Datatables::of($messages)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('from', function ($model) {

                return $model->User_From->name;
            })

            ->editColumn('message', function ($model) {

                return $model->message;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('admin.showmsg.index', $model->id), null, route('contact.destroy', $model->id));
            })

            ->make(true);
    }

    public function getsent(){
        View::share('pageTitle', 'messages');
        return $this->getView($this->viewPath . 'sent', $this->policy . 'view');
    }




    public function ajaxloadsent(Message $data){
        $user=Auth::user()->id;
        $messages = Message::where('mesg_from',$user)->currentYear()->get();
        return Datatables::of($messages)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('to', function ($model) {

                return $model->User_To->name;
            })

            ->editColumn('message', function ($model) {

                return $model->message;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('admin.showmsg.index', $model->id), null, route('contact.destroy', $model->id));
            })

            ->make(true);
    }

    public function sendmessage(){
        View::share('pageTitle', 'messages');

        $users=AppUser::all();
        return $this->getView($this->viewPath . 'sendmsg', $this->policy . 'view',['users' => $users]);
    }

    public function postmessage(Request $request){
$message=new Message;
$message->mesg_from=Auth::user()->id;
$message->mesg_to=$request->user_id;
$message->message=$request->message;
$message->save();
return $this->getView($this->viewPath . 'sent', $this->policy . 'view');

    }
}
