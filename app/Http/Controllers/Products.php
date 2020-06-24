<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

use App\Http\Controllers\Pictures;
use App\Product;
use App\Picture;

class Products extends Controller
{
    private $contentType;
    private $pictures;
    private $response;
    private $payload;
    private $productInfo;
    private $pictureInfo;
    private $hasPermission;
    private $isAdmin;

    public function __construct(Request $request)
    {
        // verify client authentication
        try {
            auth()->userOrFail();

            $this->isAdmin = intval(auth()->user()->admin);

            $this->hasPermission = true;
        } catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            $this->hasPermission = false;
            $this->response = [
                'status' => 401,
                'message' => 'Unauthenticated.'
            ];
        }

        if($this->hasPermission)
        {
            $this->response = [
                'status' => 200,
                'success' => true
            ];

            $this->request = $request;

            $this->pictures = new Pictures;
            $this->paginate = request('paginate') == "true" ? true : false;
            $this->payload = $this->request->all();

            $this->productInfo = new \stdClass();
            $this->pictureInfo = new \stdClass(); 
        }              
    }

    public function index()
    {
        if($this->hasPermission)
        {
            $allowedStatus = $this->isAdmin ? [1,2,3] : [0,1,2,3];

            if($this->request->has('search') && $this->request->has('except'))
            {
                $search = $this->request->all()['search'];
                $exceptions = explode(',', $this->request->all()['except']);

                $this->response['data'] = Product::with('pictures')->whereNotIn('id', $exceptions)
                                    ->whereIn('status', $allowedStatus)->where('name', 'like', '%' . $search . '%')->get();
            } else {
                $this->response = Product::with('pictures')->whereIn('status', $allowedStatus)->paginate(50);
            }
        }

        return response($this->response, 200);
    }

    public function show($id)
    {
        if($this->hasPermission)
        {
            $this->response['data'] = Product::where('id', $id)->with('pictures')->get();
        }

        return response($this->response, $this->response['status']);
    }

    public function store()
    {
        if($this->hasPermission)
        {
            $savePicture = true;

            try {
                $this->productInfo->id = Product::updateOrCreate($this->payload,$this->payload)->id;
            } catch(\Exception $e) {
                $savePicture = false;
                $this->response['status'] = 400;
                $this->response['message'] = 'something went wrong when trying to create product.';
            }

            $this->storePicture($savePicture);
        }
 
        return response($this->response, $this->response['status']);
    }

    public function update($id)
    {
        $this->productInfo->id = $id;

        if($this->hasPermission)
        {
            $savePicture = $this->request->has('image');

            try {
                $exists = Product::find($id);

                if(!$exists)
                {
                    throw new \Exception("could not find this product.");
                }

                Product::find($id)->update($this->payload);

                $productHasImages = Product::find($id)->pictures->count() > 0;

                if($savePicture && $productHasImages)
                {
                    $this->pictureInfo->id = Product::find($id)->pictures[0]->id;

                    Picture::find($this->pictureInfo->id)->delete();
                }

            } catch(\Exception $e) {
                $savePicture = false;
                $this->response['status'] = 400;
                $this->response['message'] = 'something went wrong when trying to update product, maybe it can not exist.';
            }

            $this->storePicture($savePicture);
        }

        return response($this->response, $this->response['status']);
    }

    public function destroy($id)
    {
        if($this->hasPermission)
        {
            try {

                Product::find($id)->delete();

            } catch(\Exception $e) {
                $this->response['status'] = 400;
                $this->response['message'] = $e->getMessage();
            }
        }

        return response($this->response, $this->response['status']);
    }

    public function storePicture($canSavePicture)
    {
        if(gettype($canSavePicture) != "boolean") return false;

        if($canSavePicture)
        {
            try {
                $this->productInfo->filename = $this->pictures->store($this->request);

                if($this->productInfo->filename)
                {
                    Picture::create(['title' => $this->productInfo->filename, 'product_id' => $this->productInfo->id]);
                }
            } catch(\Exception $e) {
                $this->response['status'] = 400;
                $this->response['message'] = $e->getMessage();
            }
        }
    }
}
