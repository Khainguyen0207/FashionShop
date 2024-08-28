<?php

namespace App\Http\Controllers\Admin;

use id;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Storage;

const MAX_PAGE = 15;
class ProductController extends Controller
{
    private $name_category;

    public function home() {
        return redirect(route('categories.home'));
    }

    public function index(string $id_category) {
        $products = $this->getProducts($id_category);
        return view('admin.categories.products', RenderController::render('product', $products));
    }

    public function page(string $id_category, string $page)
    {
        $products = $this->getProducts($id_category);
        return view('admin.categories.products', RenderController::render('product', $products));
    }

    private function getProducts(string $id_category) {
        $getProducts = DB::table('products')
            ->where('category_id', $id_category)
            ->paginate(15);
        $keyTable = [ 'product_name', 'product_code', 'price', 'category_name', 'number_items'];
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
                'category_name' => $this->name_category ,
                'number_items' =>  $products[$key]['sold_quantity'] - $products[$key]['unsold_quantity']
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
            'url' => $getProducts->path()
        ];
       
        return $render;
    }

    public function store(ProductRequest $productRequest) {
        $data = $productRequest->validated();
        $urlImage = "";
        foreach ($productRequest->file('image') as $key => $value) {
            $urlImage .= $value->store('profile', 'public') .'|';
        }
        $urlImage = substr($urlImage, 0, strlen($urlImage) - 1);
        $id_category = $productRequest->route()->parameter('id_category');
        $data['image'] = $urlImage;
        $data += [
            'product_code' => "MSSP" .$productRequest->route()->parameter('id_category') .floor(rand(1, $id_category * 10000)),
            'unsold_quantity' => 0,
            'category_id' => $id_category,
        ];
        try {
            Product::query()->create($data);
        } catch (\Throwable $th) {
            return redirect(route('category.products.home', $id_category))->with(['status' => 'Thêm sản phẩm thất bại']);
        }
        return redirect(route('category.products.home', $id_category))->with(['success' => 'Thêm sản phẩm thành công']);
    }

    public function show(string $id_category, string $id)
    {
        //Hello 
    }

    public function edit(string $id_category, string $id)
    {
        $information_product = Product::query()->where('id', $id)->first();
        $information_product->image = explode("|", $information_product->image);
        $images = [];
        foreach ($information_product->image as $key => $value) {
            $images[] = Storage::url($value);
        }
        $render = [
            'title' => "Chỉnh sửa sản phẩm",
            'product_name' => $information_product->product_name, 
            'price'  => $information_product->price, 
            'sold_quantity' => $information_product->sold_quantity, 
            'description' => $information_product->description,
            'images' => $images,
            'id_category' => $id_category,
            'product_id' => $id
        ];
        return view('layouts.categories.product-add', $render);
    }

    public function update(ProductRequest $productRequest)
    {
        $data = $productRequest->validated();
        $urlImage = "";
        if (!empty($productRequest->file('image'))) {
            foreach ($productRequest->file('image') as $key => $value) {
                $urlImage .= $value->store('profile', 'public') .'|';
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
    
    public function destroy($id_category, $product_id) {
        $info = DB::table('products')->where('id', $product_id)->get();
        $deleted = DB::table('products')->where('id', $product_id)->delete();
        $date = Carbon::now();
        if ($deleted) {
            fwrite(fopen('UpdateDataBase.txt', 'a'), "Delete product: $info \nIn table 'products' =>  Time $date\n");
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
}