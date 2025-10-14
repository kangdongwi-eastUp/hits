<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{
  // index
  public function index(Request $request)
  {
    $rows = Banner::from('banner as b')
      ->orderByDesc('created_at')
      ->paginate(2);
    return view('admin.banner_list',compact('rows'));
  }

  // store
  public function store(Request $request): ?\Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'banner_name' => 'required|max:45|string',
        'file' => 'required|image|mimes:jpg,jpeg,png,JPG,JPEG,PNG',
      ]
    );

    if ($validator->fails()) {
      $error = $validator->errors();

      $message = '';
      if ($error->has('banner_name')) {
        $message = 'E1';
      }
      if ($error->has('file')) {
        $message = 'E2';
      }
      return response()->json(['message' => $message],400);
    }

    try {
      $banner = Banner::create([
        'banner_name' => $request->input('banner_name'),
        'status' => 'y',
        'url' => $request->input('url'),
        'created_at' => now()
      ]);

      if ($request->hasFile('file')) {
        $saved = Str::uuid()->toString().'.'.$request->file('file')->getClientOriginalExtension();
        $origin = $request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('public/banner/',$saved);
        $banner->update([
          'saved' => $saved,
          'origin' => $origin
        ]);
      }

      return response()->json([
        'result' => 'success',
        'data' => $banner
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ],500);
    }
  }

  // show
  public function show(Banner $banner): \Illuminate\Http\JsonResponse
  {
    return response()->json($banner);
  }

  // delete
  public function delete(Banner $banner): ?\Illuminate\Http\JsonResponse
  {
    try {
      $banner->delete();
      return response()->json([
        'result' => 'success'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ],500);
    }
  }

  // modify
  public function modify(Banner $banner,Request $request): ?\Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'banner_name' => 'required|max:45|string',
        'file' => 'image|mimes:jpg,jpeg,png,JPG,JPEG,PNG',
      ]
    );

    if ($validator->fails()) {
      $error = $validator->errors();

      $message = '';
      if ($error->has('banner_name')) {
        $message = 'E1';
      }
      if ($error->has('file')) {
        $message = 'E2';
      }
      return response()->json(['message' => $message],400);
    }

    try {
      $banner->update([
        'banner_name' => $request->input('banner_name'),
        'updated_at' => now()
      ]);

      if ($request->hasFile('file')) {
        $saved = Str::uuid()->toString().'.'.$request->file('file')->getClientOriginalExtension();
        $origin = $request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('public/banner/',$saved);
        $banner->update([
          'saved' => $saved,
          'origin' => $origin
        ]);
      }

      return response()->json([
        'result' => 'success'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ],500);
    }
  }

  // modify view status
  public function modifyViewStatus(Banner $banner,Request $request): ?\Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'status' => 'required|in:y,n|string'
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'message' => $validator->errors()->toArray()
      ],400);
    }

    try {
      $banner->update([
        'status' => $request->input('status'),
        'updated_at' => now()
      ]);

      return response()->json([
        'result' => 'success'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ],500);
    }
  }
}
