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
        foreach ($request->file() as $key => $value) {
            $name_file = $request->file($key)->store();
            $request->file($key)->storeAs('/about_store',  $name_file);
            AboutShopModel::query()->where('key', $key)->update([
                'value' => $name_file,
            ]);
        }
        return redirect()->back()->with("Success", "Thanh cong");
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
