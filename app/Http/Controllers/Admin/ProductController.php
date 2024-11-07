<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RenderController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

const MAX_PAGE = 15;
class ProductController extends Controller
{
    private $name_category;

    public function home()
    {
        return redirect(route('categories.home'));
    }

    public function index(string $id_category)
    {
        $search = request()->query();
        foreach ($search as $key => $value) {
            if (empty($value)) {
                unset($search[$key]);
            }
        }
        $getProducts = Product::where(function ($query) use ($search) {
            foreach ($search as $key => $value) {
                if (Schema::hasColumn('products', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->where('category_id', $id_category)->paginate(15);
        if ($getProducts->currentPage() > $getProducts->lastPage()) {
            abort(404);
        }
        $products = $this->getProducts($id_category, $getProducts);

        return view('admin.categories.products', RenderController::render('product', $products));
    }

    private function getProducts(string $id_category, $getProducts)
    {
        $keyTable = ['product_name', 'product_code', 'price', 'category_name', 'number_items'];
        $table = FunctionController::table('product', $keyTable);
        $products = $getProducts->items();
        try {
            $this->name_category = DB::table('categories')->where('id', $id_category)->select('name_category')->first()->name_category;
        } catch (\Throwable $th) {
            abort(404);
        }
        foreach ($products as $key => $item) {
            $products[$key] = collect($products[$key])->toArray();
            $products[$key] += [
                'category_name' => $this->name_category,
                'number_items' => $products[$key]['unsold_quantity'] - $products[$key]['sold_quantity'],
            ];
        }
        $render = [
            $table,
            $products,
            $keyTable,
            'name_category' => $this->name_category,
            'id' => $id_category,
            'number' => $getProducts->currentPage(),
            'maxPage' => $getProducts->lastPage(),
            'url' => $getProducts->path(),
        ];

        return $render;
    }

    public function store(ProductRequest $productRequest)
    {
        dd($productRequest);
        $data = $productRequest->validated();
        //Get id category from route parameter
        $id_category = $productRequest->route()->parameter('id_category');
        $urlImage = ''; //create variable urlImage to contain image link
        $fileInput = $productRequest->file('image');
        //Check image only png or jbg
        foreach ($fileInput as $value) {
            $urlImage .= $value->store('profile', 'public').'|';
        }
        $urlImage = substr($urlImage, 0, strlen($urlImage) - 1);
        $data['image'] = $urlImage; //Save image in storage
        $data += [
            'product_code' => 'MSSP'.$productRequest->route()->parameter('id_category').floor(rand(1, $id_category * 10000)),
            'unsold_quantity' => 0,
            'category_id' => $id_category,
        ];
        try {
            Product::query()->create($data);
        } catch (\Throwable $th) {
            return redirect(route('category.products.home', $id_category))->with(['error' => 'Thêm sản phẩm thất bại']);
        }

        return redirect(route('category.products.home', $id_category))->with(['success' => 'Thêm sản phẩm thành công']);
    }

    public function edit(string $id_category, string $id)
    {
        $information_product = Product::query()->where('id', $id)->first();
        $information_product->image = explode('|', $information_product->image);
        $images = [];
        foreach ($information_product->image as $key => $value) {
            $images[] = Storage::url($value);
            $information_product->image = $images;
        }
        $render = [
            'title' => 'Chỉnh sửa sản phẩm',
            ...$information_product->toArray(),
        ];

        return view('layouts.categories.product-add', $render);
    }

    public function update(ProductRequest $productRequest)
    {
        $data = $productRequest->validated();
        $urlImage = '';
        if (! empty($productRequest->file('image'))) {
            foreach ($productRequest->file('image') as $value) {
                $urlImage .= $value->store('profile', 'public').'|';
            }
            $urlImage = substr($urlImage, 0, strlen($urlImage) - 1);
            $data['image'] = $urlImage;
        }
        $id_category = $productRequest->route()->parameter('id_category');
        $product_id = $productRequest->route()->parameter('product_id');
        $data += [
            'category_id' => $id_category,
        ];
        try {
            Product::query()->where('id', $product_id)->update($data);
        } catch (\Throwable $th) {
            return redirect(route('category.products.home', $id_category))->with(['error' => 'Cập nhật sản phẩm thất bại']);
        }

        return redirect(route('category.products.home', $id_category))->with(['success' => 'Cập nhật sản phẩm thành công']);
    }

    public function destroy($id_category, $product_id)
    {
        $date = Carbon::now();
        $info = DB::table('products')->where('id', $product_id)->get();
        //Delete image in storage
        foreach (explode('|', $info->first()->image) as $value) {
            Storage::delete($value);
        }
        $deleted = DB::table('products')->where('id', $product_id)->delete();
        if ($deleted) {
            $num = count(explode('|', $info->first()->image));
            fwrite(fopen('./history/DeleteImageHistory.txt', 'a'), "Delete $num image  =>  Time $date\n");
            fwrite(fopen('./history/UpdateDataBase.txt', 'a'), "Delete product: $info \nIn table 'products' =>  Time $date\n");
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
