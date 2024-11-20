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
use App\Models\OptionModel;
use Illuminate\Support\Facades\Session;

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
        $data = [
        ];
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
        $key = $request->input("name");
        $value = $request->input("value");
        $option = FunctionController::array_concat_key_value($key, $value);
        //Setting option
        if (empty($option)) {
           return redirect()->back()->with("error", "Không có tác vụ nào được thực thi");
        }
        $query = OptionModel::query();
        if (empty($request->input("id_option"))) {
            $query->create([
                'name' => $request->input("name_option"),
                'option' => json_encode($option),
            ]);
        } else {
            $data_option = OptionModel::findOrFail($request->input("id_option"));  
            $data_option->fill([
                'name' => $request->input("name_option"),
                'option' => json_encode($option),
            ]);
            if ($data_option->isDirty()) {
                $data_option->save();
            } else {
                return back()->with("error", "Không có tác vụ nào được thực thi");
            }
        }
        return back()->with("success", "Dữ liệu được lưu");
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
    /*
        return component view option_clone 
        */
    public function get_data_settup() {
        $options = OptionModel::query()->findOrFail(request()->input("id"));
        $options['type'] = request()->input("type");
        return view("layouts.components.option_clone", $options);
    }

    public static function getDataSettupController() {
        $about_shop = AboutShopModel::query()->get()->toArray();
        $option_samples = OptionModel::query()->get();
        $format = [];
        $json_no = ['logo', 'banner'];
        foreach ($about_shop as $value) {
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
        $format["option_samples"] = $option_samples;
        return $format;
    }

    public function destroy(Request $request, string $id) {
        $option = OptionModel::findOrFail($id);
        if (empty($option)) {
            return back()->with("error", "Không thể thực hiện");
        }
        $option->delete("id", $id);
        return response()->json(['success' => "Thành công"], 200);
    }
}
