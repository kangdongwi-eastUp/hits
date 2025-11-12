<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>할일태산 어드민</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="/public/img/common/img_favicon.ico" type="image/x-icon">

  <!-- css -->
  <link rel="stylesheet" href="/public/css/admin.common.css">
  <link rel="stylesheet" href="/public/css/admin.sub.css">

  <!-- js -->
  <script src="/public/js/jquery-3.6.1.min.js"></script>
  <script src="/public/js/admin.common.js"></script>
</head>
<body id="page_category_detail"><input type="hidden" id="input_page" value="category">
<header></header>
@php
  if ($type === '1') {
    $title = '입주민 동의서';
  }
  if ($type === '2') {
    $title = '승강기 보양';
  }
  if ($type === '3') {
    $title = '행위허가';
  }
  if ($type === '4') {
    $title = '사용검사';
  }
  if ($type === '5') {
    $title = '보양탈거';
  }
  if ($type === '6') {
    $title = '입주민 동의서 + 승강기 보양';
  }
  if ($type === '7') {
    $title = '입주민 동의서 + 승강기 보양 + 행위허가';
  }
  if ($type === '8') {
    $title = '입주민 동의서 + 행위허가';
  }
  if ($type === '9') {
    $title = '승강기 보양 + 행위허가';
  }
  // 2025.10.15 강동위 추가 - 방충망 시공 , 종합청소 서비스 추가 
  if ($type === '10') {
    $title = '방충망 시공';
  }
  if ($type === '11') {
    $title = '종합청소';
  }
  if ($type === '12') {
    $title = '폐기물 수거';
  }
@endphp
<main class="minWidth2">
  <h2>{{ $title }}</h2>
  <div class="wrap_contents">
    <div class="bx_btnTop">
      <i></i>
      <button type="button" class="br_gray" onclick="deleteBoards()"><img src="/public/img/admin/ico_delete.svg" alt="삭제 아이콘">&nbsp;삭제</button>
    </div>
    <script>
        function deleteBoards() {
          let arr = [];
          Array.from(document.querySelectorAll('input[name="chkBox"]')).forEach(row => {
            if (row.checked) {
              arr.push(row.value);
            }
          });

          if (arr.length === 0) {
            alert("삭제할 신청서를 선택해주세요.");
            return false;
          }
          deleteAPI(arr);
        }
        function deleteBoard(BoardID) {
          let arr = [];
          arr.push(BoardID);
          deleteAPI(arr);
        }
        function deleteAPI(arr) {
          if (confirm("해당 신청서를 삭제하시겠습니까?")) {
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: "put",
              url: "/adm/v1/boards/change-status",
              data: {
                'arr' : arr
              },
              success: function(res) {
                if (res.result === 'success') {
                  location.reload();
                } else {
                  console.log(res);
                }
              },
              error:function(request, status, error){
                console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
              }
            });
          }
        }
    </script>
    <hr class="hr_lists">
    <ul class="bx_lists">
      @foreach($rows as $rq)
        <li>
          <label class="lb_chk">
            <input type="checkbox" name="chkBox" id="" value="{{ $rq->board_id }}">
            <p class="row01">{{ $rq->name }}</p><p class="dt">{{ $rq->created_at}}</p>
          </label>
          <button type="button" onclick="location.href='/adm/board/{{ $rq->board_id }}'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
          <button type="button" onclick="deleteBoard({{ $rq->board_id }})"><img src="/public/img/admin/category_ico_delete.svg" alt="삭제 아이콘"></button>
        </li>
      @endforeach
    </ul>
  </div>
</main>
</body>
</html>