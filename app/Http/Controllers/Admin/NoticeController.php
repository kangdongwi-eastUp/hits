<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
  // list
  public function list()
  {
    $rows = Notice::from('notice as n')
      ->orderByDesc('created_at')
      ->paginate(2);
    return view('admin.news_list',compact('rows'));
  }

  // store
  public function store(Request $request): ?\Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'title' => 'required|string|max:45',
        'file' => 'required|image|mimes:jpg,jpeg,png,PNG,JPG,JPEG'
      ]
    );

    if ($validator->fails()) {
      $error = $validator->errors();
      $message = '';
      if ($error->has('title')) {
        $message = 'E1';
      }

      if ($error->has('file')) {
        $message = 'E2';
      }

      return response()->json([
        'message' => $message
      ],500);
    }

    try {
      $notice = Notice::create([
        'title' => $request->input('title'),
        'created_at' => now()
      ]);

      if ($request->hasFile('file')) {
        $saved = Str::uuid()->toString().'.'.$request->file('file')->getClientOriginalExtension();
        $origin = $request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('public/notice/',$saved);

        $notice->update([
          'saved' => $saved,
          'origin' => $origin
        ]);
      }

      return response()->json([
        'result' => 'success',
        'data' => $notice
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ]);
    }
  }

  // show
  public function show(Notice $notice): \Illuminate\Http\JsonResponse
  {
    return response()->json($notice);
  }

  // modify
  public function modify(Notice $notice,Request $request): ?\Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'title' => 'required|string|max:45',
        'file' => 'image|mimes:jpg,jpeg,png,PNG,JPG,JPEG'
      ]
    );

    if ($validator->fails()) {
      $error = $validator->errors();
      $message = '';
      if ($error->has('title')) {
        $message = 'E1';
      }

      if ($error->has('file')) {
        $message = 'E2';
      }

      return response()->json([
        'message' => $message
      ],500);
    }

    try {
      $notice->update([
        'title' => $request->input('title'),
        'updated_at' => now()
      ]);

      if ($request->hasFile('file')) {
        $saved = Str::uuid()->toString().'.'.$request->file('file')->getClientOriginalExtension();
        $origin = $request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('public/notice/',$saved);

        $notice->update([
          'saved' => $saved,
          'origin' => $origin
        ]);
      }

      return response()->json([
        'result' => 'success',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ]);
    }
  }

  // delete
  public function delete(Notice $notice): ?\Illuminate\Http\JsonResponse
  {
    try {
      $notice->delete();
      return response()->json([
        'message' => 'success'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ],500);
    }
  }

}
