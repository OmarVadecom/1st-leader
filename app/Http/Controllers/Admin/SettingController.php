<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Setting;
use Illuminate\Http\Request;
use View;

class SettingController extends MainController
{
    private $viewPath = 'admin.setting.';
    private $policy = 'settings.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.settings'));
    }

    public function index()
    {
        $settings = Setting::whereNotIn('type', ['layouts', 'script'])->orderBy('sort_number', 'asc')->get();
        return $this->getView($this->viewPath . 'index', $this->policy . 'view', ['settings' => $settings], 'edit');
    }

    public function scripts()
    {
        $settings = Setting::where('type', 'script')->orderBy('sort_number', 'asc')->get();
        return $this->getView($this->viewPath . 'layout', $this->policy . 'view', ['settings' => $settings], 'edit');
    }

    public function layouts()
    {
        $settings = Setting::where('type', 'layouts')->orderBy('sort_number', 'asc')->get();
        return $this->getView($this->viewPath . 'layout', $this->policy . 'view', ['settings' => $settings], 'edit');
    }

    public function update(Request $request, Setting $setting)
    {

        foreach (array_except($request->toArray(), ['_token', 'submit']) as $name => $array) {
            foreach ($array as $lang => $value) {
                $sieSettingsUpdate = $setting->where('name', $name)->where('lang', $lang)->firstOrFail();
                if ($sieSettingsUpdate->type == 'file') {
                    $file = $value;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('public/uploads/logo/', $filename);
                    $sieSettingsUpdate->update(['value' => $filename]);

                } else {
                    $sieSettingsUpdate->update(['value' => $value]);
                }
            }
        }
        return redirect()->back()->withFlashMessage(trans('admin.updated', ['name' => trans('admin.settings')]));
    }

    public function slugChecker(Request $req)
    {
        $word = $req->word;
        $slug = checkCount($req->check, seo_url($word));
        return response()->json($slug);
    }

    public function showIcons()
    {
        return view($this->viewPath . 'icon');
    }
}
