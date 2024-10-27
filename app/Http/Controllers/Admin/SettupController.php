<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AboutShopModel;
use App\Http\Controllers\getData;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RenderController;

class SettupController extends Controller
{
    public function home()
    {
        $data = $this->getDataSettupController();
        return view('admin.setting', RenderController::render('settup', $data));
    }

    public function store(Request $request)
    {
        $data = [];

        return view('admin.setting', RenderController::render('settup', $data));
    }

    public function edit(Request $request)
    {
        $query = AboutShopModel::query();
        $data = [];

        foreach ($request->request as $key => $value) {
            if ($key == "_token") {
                continue;
            }
            if (collect($value)->map('trim') != null) {
                AboutShopModel::query()->where('key', $key)->update([
                    'value' => json_encode($value), 
                ]);
            }
        }
        if (!empty($request->file())) {
            foreach ($request->file() as $key => $value) {
                $old_value = $query->where('key', $key)->first()->value;
                $name_file = $request->file($key)->store('public/about_shop');
                $query->where('key', $key)->update([
                    'value' => $name_file, 
                ]);
            }
            if (isset($old_value)) {
                Storage::delete($old_value);
            }
        }
        return redirect()->back()->with("success", "Thay đổi thành công");
    }

    public static function getDataSettupController() {
        $data = AboutShopModel::query()->get()->toArray();
        $format = [];
        $json_no = ['logo', 'banner'];
        foreach ($data as $value) {
            if (in_array($value['key'], $json_no)) {
                if (Storage::exists($value['value'])) {
                    $format[$value['key']] = Storage::url($value['value']);
                } else {
                    $format[$value['key']] = asset("assets/user/img/box.png");
                }
            } else {
                $format[$value['key']] = json_decode($value['value'], true);
            }
        }
        return $format;
    }
}
