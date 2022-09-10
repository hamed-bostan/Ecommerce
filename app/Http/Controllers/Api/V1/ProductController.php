<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use function response;

class ProductController extends Controller
{

private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return ProductCollection::collection(Product::all());
//        return ProductResource::collection(Product::all());
    }



//    public function index()
//    {
//        return ProductResource::collection(
//            Product::query()->orderByDesc('id')->paginate(3)
//        );
//    }

    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->validated());
        $product->save();

        return response()->json([
            'message' => 'Creating was successful'
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $this->authorize(ProductPolicy::UPDATE, $product);

        $product->update($request->all());

        return response()->json([
            'message' => 'updating was successful',
        ]);
    }

//    public function moredetails()                             // works
//    {
//
//        return ProductResource::collection(Product::all());
//    }


    public function moredetails(Product $product)
    {

//        return ProductResource::collection(Product::query());
        return ProductResource::collection(
            Product::query()->orderByDesc('$product')->paginate(3));
    }
}
