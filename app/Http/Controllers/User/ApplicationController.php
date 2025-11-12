<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\mang_option;
use App\Models\other_service_option;
use App\Models\Board;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
  public function storeBoard(Board $board)
  {
    try {
      $board->update([
        'tmp' => 'n',
        'created_at' => now()
      ]);

      $apiController = new ApiController();
      $apiController->send($board);

      return response()->json([
        'result' => 'success',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function write(Request $request)
  {
    if ($request->input('first_service') || $request->input('second_service') || $request->input('third_service')) {
      if ($request->input('q_second')) {
        return redirect()->back()->with('msg', '서비스를 다시 선택해주세요.');
      }
      // type : 7
      if ($request->input('first_service') && $request->input('second_service') && $request->input('third_service')) {
        return view('user.sub7');
      }
      // type : 6
      if ($request->input('first_service') && $request->input('second_service') && !$request->input('third_service')) {
        return view('user.sub6');
      }
      // type : 8
      if ($request->input('first_service') && !$request->input('second_service') && $request->input('third_service')) {
        return view('user.sub8');
      }
      // type : 9
      if (!$request->input('first_service') && $request->input('second_service') && $request->input('third_service')) {
        return view('user.sub9');
      }
      // type : 1
      if ($request->input('first_service') && !$request->input('second_service') && !$request->input('third_service')) {
        return view('user.sub1');
      }
      // type : 2
      if (!$request->input('first_service') && $request->input('second_service') && !$request->input('third_service')) {
        return view('user.sub2');
      }
      // type : 3
      if (!$request->input('first_service') && !$request->input('second_service') && $request->input('third_service')) {
        return view('user.sub3');
      }
    }

    if ($request->input('q_second')) {
      if ($request->input('first_service') || $request->input('second_service') || $request->input('third_service')) {
        return redirect()->back()->with('msg', '서비스를 다시 선택해주세요.');
      }
      // if ($request->input('q_second') === '4') {
      //   return view('user.sub4');
      // } else {
      //   return view('user.sub5');
      // }
      // 2025.10.12 강동위 추가 - 방충망 시공, 종합청소 신청서 추가 
      if ($request->input('q_second') === '4') {  // 사용검사
        return view('user.sub4');
      } else if ($request->input('q_second') === '5') {  // 보양탈거
        return view('user.sub5');
      } else if ($request->input('q_second') === '6') {  // 방충망 시공
        return view('user.sub10');
      } else if ($request->input('q_second') === '7') {  // 종합 청소
        return view('user.sub11');
      } else {                // 폐기물 수거
        return view('user.sub12');
      }
    }
  }

  // write
  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'type' => 'required|integer|max:12'   // 2025.10.12 강동위 수정 - 방충망 시공, 종합 청소 서비스 추가로 인한 max값 12로 수정
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'result' => 'fail',
        'message' => $validator->errors()->toArray()
      ]);
    }

    if ($request->input('type') === '1') {
      $result = $this->type1($request);
    }
    if ($request->input('type') === '2') {
      $result = $this->type2($request);
    }
    if ($request->input('type') === '3') {
      $result = $this->type3($request);
    }
    if ($request->input('type') === '4') {
      $result = $this->type4($request);
    }
    if ($request->input('type') === '5') {
      $result = $this->type5($request);
    }
    if ($request->input('type') === '6') {
      $result = $this->type6($request);
    }
    if ($request->input('type') === '7') {
      $result = $this->type7($request);
    }
    if ($request->input('type') === '8') {
      $result = $this->type8($request);
    }
    if ($request->input('type') === '9') {
      $result = $this->type9($request);
    }
    // 2025.10.12 강동위 수정 - 방충망 시공, 종합 청소 서비스 추가로 인한 type 10, type 11 추가
    if ($request->input('type') === '10') {
      $result = $this->type10($request);
    }
    if ($request->input('type') === '11') {
      $result = $this->type11($request);
    }
    if ($request->input('type') === '12') {
      $result = $this->type12($request);
    }

    return response()->json($result);
  }

  public function type1($req)
  {
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }
      $option2 = null;
      $resident_name = $req->resident_name;
      $resident_phone = $req->resident_phone;
      if ($req->option2 === 'y') {
        $option2 = 'y';
        $resident_name = null;
        $resident_phone = null;
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'manager_name' => $req->manager_name,
        'manager_phone' => $req->manager_phone,
        'resident_name' => $resident_name,
        'resident_phone' => $resident_phone,
        'option2' => $option2,
        'contents' => $req->contents,
        'noise_date' => $req->noise_date,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 1
      ]);

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
    }
    return $result;
  }
  public function type2($req)
  {
    DB::beginTransaction();
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 2
      ]);

      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }
  public function type3($req)
  {
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'contents' => $req->contents,
        'option3' => $req->option3,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 3
      ]);

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
    }
    return $result;
  }
  public function type4($req)
  {
    if ($req->terms3 === 'on') {
      $terms = 'y';
    } else {
      $terms = 'n';
    }

    $terms4 = 'n';
    if ($req->terms4 === 'y') {
      $terms4 = 'y';
    }

    $option1 = null;
    if ($req->option1) {
      $option1 = 'y';
    }

    try {
      $board = Board::create([
        'start_date' => $req->start_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'company_name' => $req->company_name,
        'company_phone' => $req->company_phone,
        'created_at' => now(),
        'option1' => $option1,
        'option4' => $req->option4,
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'terms4' => $terms4,
        'type' => 4
      ]);

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
    }
    return $result;
  }
  public function type5($req)
  {
    DB::beginTransaction();
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 5
      ]);

      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }
  public function type6($req)
  {
    DB::beginTransaction();
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }
      $option2 = null;
      $resident_name = $req->resident_name;
      $resident_phone = $req->resident_phone;
      if ($req->option2 === 'y') {
        $option2 = 'y';
        $resident_name = null;
        $resident_phone = null;
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'manager_name' => $req->manager_name,
        'manager_phone' => $req->manager_phone,
        'resident_name' => $resident_name,
        'resident_phone' => $resident_phone,
        'option2' => $option2,
        'contents' => $req->contents,
        'noise_date' => $req->noise_date,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 6
      ]);

      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }
  public function type7($req)
  {
    DB::beginTransaction();
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }
      $option2 = null;
      $resident_name = $req->resident_name;
      $resident_phone = $req->resident_phone;
      if ($req->option2 === 'y') {
        $option2 = 'y';
        $resident_name = null;
        $resident_phone = null;
      }
      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'manager_name' => $req->manager_name,
        'manager_phone' => $req->manager_phone,
        'resident_name' => $resident_name,
        'resident_phone' => $resident_phone,
        'option2' => $option2,
        'contents' => $req->contents,
        'noise_date' => $req->noise_date,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 7,
        'option3' => $req->option3,
        'contents2' => $req->contents2,
      ]);

      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }

    return $result;
  }
  public function type8($req)
  {
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }
      $option2 = null;
      $resident_name = $req->resident_name;
      $resident_phone = $req->resident_phone;
      if ($req->option2 === 'y') {
        $option2 = 'y';
        $resident_name = null;
        $resident_phone = null;
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'manager_name' => $req->manager_name,
        'manager_phone' => $req->manager_phone,
        'resident_name' => $resident_name,
        'resident_phone' => $resident_phone,
        'option2' => $option2,
        'contents' => $req->contents,
        'noise_date' => $req->noise_date,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 8,
        'option3' => $req->option3,
        'contents2' => $req->contents2,
      ]);

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
    }
    return $result;
  }
  public function type9($req)
  {
    DB::beginTransaction();
    try {
      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,
        'end_date' => $req->end_date,
        'address1' => $req->address1,
        'address2' => $req->address2,
        'name' => $req->name,
        'phone' => $req->phone,
        'option1' => $option1,
        'company_name' => $req->company_name,
        'contents' => $req->contents,
        'created_at' => now(),
        'terms1' => 'y',
        'terms2' => 'y',
        'terms3' => $terms,
        'type' => 9,
        'option3' => $req->option3,

      ]);

      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }


  // type 10 store
  public function type10($req)
  {
    DB::beginTransaction();
    try {

      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([

        'start_date' => $req->start_date,           // 시공희망일
        'address1' => $req->address1,               // 현장주소1
        'address2' => $req->address2,               // 현장주소2
        'name' => $req->name,                       // 신청인명
        'phone' => $req->phone,                     // 신청인 연락처
        'option1' => $option1,                      // 셀프 직영공사 여부
        'company_name' => $req->company_name,       // 업체명
        'company_phone' => $req->company_phone,     // 업체 연락처  
        'created_at' => now(),                      // 등록일자
        'terms1' => 'y',                            // 개인정보 수집 및 동의여부
        'terms2' => 'y',                            // 개인정보 제3자 제공 동의 여부
        'terms3' => $terms,                         // 마케팅 활용정보 동의
        'type' => 10                                // type 방충망 시공

      ]);

      // 방충망 종류 저장 ( 기존 보양 테이블에 저장함 )
      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 망 옵션 저장
      $mang_options = $req->mang_option;
      foreach ($mang_options as $mang_option) {
        mang_option::create([
          'board_id' => $board->board_id,
          'contents' => $mang_option
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }
  // type 11 store
  public function type11($req)
  {
    DB::beginTransaction();
    try {

      $option1 = null;
      if ($req->option1) {
        $option1 = 'y';
      }

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([

        'start_date' => $req->start_date,           // 청소 희망일
        'address1' => $req->address1,               // 현장주소1
        'address2' => $req->address2,               // 현장주소2
        'name' => $req->name,                       // 신청인명
        'phone' => $req->phone,                     // 신청인 연락처
        'option1' => $option1,                      // 셀프 직영공사 여부
        'company_name' => $req->company_name,       // 업체명
        'company_phone' => $req->company_phone,     // 업체 연락처  
        'created_at' => now(),                      // 등록일자
        'terms1' => 'y',                            // 개인정보 수집 및 동의여부
        'terms2' => 'y',                            // 개인정보 제3자 제공 동의 여부
        'terms3' => $terms,                         // 마케팅 활용정보 동의
        'type' => 11                                // type 방충망 시공

      ]);

      // 청소공간유형 ( 기존 보양 테이블에 저장함 )
      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }
  // type 12 store
  public function type12($req)
  {
    DB::beginTransaction();
    try {

      if ($req->terms3 === 'on') {
        $terms = 'y';
      } else {
        $terms = 'n';
      }

      $board = Board::create([
        'start_date' => $req->start_date,           // 수거 희망일
        'address1' => $req->address1,               // 현장주소1
        'address2' => $req->address2,               // 현장주소2
        'name' => $req->name,                       // 신청인명
        'phone' => $req->phone,                     // 신청인 연락처
        'company_name' => $req->company_name,       // 업체명
        'company_phone' => $req->company_phone,     // 업체 연락처  
        'contents' => $req->contents,               // 참조사항
        'created_at' => now(),                      // 등록일자
        'terms1' => 'y',                            // 개인정보 수집 및 동의여부
        'terms2' => 'y',                            // 개인정보 제3자 제공 동의 여부
        'terms3' => $terms,                         // 마케팅 활용정보 동의
        'type' => 12                                // type 폐기물수거

      ]);

      // 수거할 예상 폐기물량 ( 기존 보양 테이블에 저장함 )
      $boyangs = $req->boyang;
      foreach ($boyangs as $boyang) {
        Option::create([
          'board_id' => $board->board_id,
          'contents' => $boyang
        ]);
      }

      // 2025.10.28 강동위 수정 - 다른서비스 이용 조회 추가
      if (!empty($req->other_service_option)) {
          $other_service_options = $req->other_service_option;
          foreach ($other_service_options as $other_service_option) {
              other_service_option::create([
                  'board_id' => $board->board_id,
                  'contents' => $other_service_option
              ]);
          }
      }

      $result = ['result' => 'success', 'data' => $board];
      DB::commit();
    } catch (\Exception $e) {
      $result = ['result' => 'fail', 'message' => $e->getMessage()];
      DB::rollBack();
    }
    return $result;
  }

  public function previewShow(Board $board)
  {
    if ($board->tmp === 'n') {
      return redirect()->route('user.index');
    }

    $rows = Option::where('board_id', $board->board_id)->get();

    if ($rows->count() === 0) {
      $options = null;
    } else {
      foreach ($rows as $row) {
        $options[] = $row->contents;
      }
      $options = implode(',', $options);
    }

    // 2025.09.24 강동위 수정 - 방충망 시공, 종합청소 서비스 추가로 인한 mang_option 조회 로직 추가
    $mang_option_rows = mang_option::where('board_id', $board->board_id)->get();

    if ($mang_option_rows->count() === 0) {
      $mang_options = null;
    } else {
      foreach ($mang_option_rows as $mang_option_row) {
        $mang_options[] = $mang_option_row->contents;
      }
      $mang_options = implode(',', $mang_options);
    }

    // 2025.11.07 강동위 수정 - 다른서비스 이용 옵션 조회 추가 other_service_option
    $other_service_option_rows = other_service_option::where('board_id', $board->board_id)->get();

    if ($other_service_option_rows->count() === 0) {
      $other_service_options = null;
    } else {
      foreach ($other_service_option_rows as $other_service_option_row) {
        $other_service_options[] = $other_service_option_row->contents;
      }
      $other_service_options = implode(',', $other_service_options);
    }

    return view('user.confirm' . $board->type, compact('board', 'options', 'mang_options', 'other_service_options'));
  }
}
