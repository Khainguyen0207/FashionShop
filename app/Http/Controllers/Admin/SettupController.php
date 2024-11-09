<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AboutShopModel;
use App\Http\Controllers\getData;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RenderController;

use function PHPUnit\Framework\never;

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
        foreach ($request->request as $key => $value) {
            if ($key == "_token") {
                continue;
            }
            if (!is_null(collect($value)->map('trim'))) {
                if (empty(AboutShopModel::query()->where('key', $key)->first())) {
                    AboutShopModel::query()->where('key', $key)->create([
                        'value' => json_encode($value),
                    ]);
                } else {
                    AboutShopModel::query()->where('key', $key)->update([
                        'value' => json_encode($value),
                    ]);
                }
            }
        }
        if (!empty($request->file())) {
            foreach ($request->file() as $key => $value) {
                $old_value = $query->where('key', $key)->first()->value;
                $name_file = $request->file($key)->store('public/about_store');
                $originalFileName = basename($name_file);
                $destinationPath = public_path('storage/about_store/' . $originalFileName);
                File::copy(storage_path('app/' . $name_file), $destinationPath);
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

    public function update(Request $request) {
        $query = AboutShopModel::query();
        $key = $request->input("name");
        $value = $request->input("value");
        $option = FunctionController::array_concat_key_value($key, $value);
        //Setting option
        if (empty($option)) {
           return redirect()->back()->with("error", "Không có tác vụ nào được thực thi");
        }
        return redirect()->back()->with("success", "Thay đổi thành công");
    }
    
    public function option(Request $request) {  
        $query = AboutShopModel::query();
        dd($request->all());
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
