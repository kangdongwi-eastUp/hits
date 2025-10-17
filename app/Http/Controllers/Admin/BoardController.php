<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Option;
use App\Models\mang_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
  // index
  public function index() {
    // 2025.10.15 강동위 수정 - 방충망 시공, 종합청소 서비스 추가
    for ($i=1; $i<=11; $i++) {
      $rows = Board::where('type',$i)
        ->where('tmp','n')
        ->where('delete_status','n')
        ->get();

      if ($rows->count() > 0) {
        $result[$i] = 'y';
      } else {
        $result[$i] = 'n';
      }
    }

    return view('admin.category_list',compact('result'));
  }

  public function list (Request $request) {
    $type = $request->type;
    // 2025.10.15 강동위 수정 - 방충망 시공, 종합청소 서비스 추가
    $arr = ['1','2','3','4','5','6','7','8','9', '10', '11'];

    if (!in_array($type,$arr,true)) {
      return redirect()->back();
    }

    Board::where('type',$type)
      ->update([
        'status' => 'y',
      ]);

    $rows = Board::where('type',$type)
      ->where('delete_status','n')
      ->where('tmp','n')
      ->orderByDesc('created_at')
      ->get();

    return view('admin.category_detail',compact('rows','type'));
  }

  public function deleteList () {
    $rows = Board::from('board as b')
      ->where('delete_status','y')
      ->orderByDesc('created_at')
      ->get();
    return view('admin.delete_list',compact('rows'));
  }
  public function delete(Request $request): \Illuminate\Http\JsonResponse
  {
    $validator = Validator::make(
      $request->all(),
      [
        'arr' => 'required|array'
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'result' => 'fail',
        'message' => $validator->errors()->toArray()
      ]);
    }

    DB::beginTransaction();
    try {
      $boards = $request->input('arr');
      foreach ($boards as $board) {
        Board::where('board_id',$board)->delete();
      }

      $result = ['result' => 'success'];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail','message' => $e->getMessage()];
      DB::rollBack();
    }

    return response()->json($result);
  }
  public function restore(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'arr' => 'required|array'
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'result' => 'fail',
        'message' => $validator->errors()->toArray()
      ]);
    }

    DB::beginTransaction();
    try {
      $boards = $request->input('arr');
      foreach ($boards as $board) {
        Board::where('board_id',$board)->update([
          'delete_status' => 'n',
        ]);
      }

      $result = ['result' => 'success'];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail','message' => $e->getMessage()];
      DB::rollBack();
    }

    return response()->json($result);
  }

  public function changeDeleteStatus(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'arr' => 'required|array'
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'result' => 'fail',
        'message' => $validator->errors()->toArray()
      ]);
    }

    DB::beginTransaction();
    try {
      $boards = $request->input('arr');
      foreach ($boards as $board) {
        Board::where('board_id',$board)->update([
          'delete_status' => 'y'
        ]);
      }

      $result = ['result' => 'success'];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail','message' => $e->getMessage()];
      DB::rollBack();
    }

    return response()->json($result);
  }

  public function boardDetail(Board $board)
  {
    $rows = Option::where('board_id',$board->board_id)->get();
    if ($rows->count() === 0) {
      $options = null;
    } else {
      foreach ($rows as $row) {
        $options[] = $row->contents;
      }
      $options = implode(',',$options);
    }
    
    // 2025.10.15 강동위 수정 - 망옵션 리스트 추가
    $rows2 = mang_option::where('board_id',$board->board_id)->get();
    if ($rows2->count() === 0) {
      $mang_options = null;
    } else {
      foreach ($rows as $row) {
        $mang_options[] = $row->contents;
      }
      $mang_options = implode(',',$mang_options);
    }

    $view = 'admin.category_detail_content'.$board->type;
    return view($view, compact('board','options', 'mang_options'));
  }

}
