<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일태산</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/public/img/common/img_favicon.ico" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/public/css/user.common.css">
    <link rel="stylesheet" href="/public/css/user.sub.css">

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script>
        
    </script>
</head>
<body id="page_confirm"><input type="hidden" id="input_page" value="">
    <main>
        <p class="b_point">신청하신 내용이 맞는지 확인해주세요.</p>
        
        <h4>공사 기간을 선택해주세요. <span class="t_red">*</span></h4>
        <h5>{{ date('Y-m-d',strtotime($board->start_date)) }} 부터 {{ date('Y-m-d',strtotime($board->end_date)) }}</h5>

        <h4>현장 주소를 입력해주세요. <span class="t_red">*</span></h4>
        <h5>{{ $board->address1.' '.$board->address2 }}</h5>

        <h4>신청인명과 연락처를 입력해주세요. <span class="t_red">*</span></h4>
        <h5>{{ $board->name }}<br>{{ $board->phone }}</h5>

        <h4>신청인이 업체이시면 업체명을 작성해주세요.</h4>
        <h5>{{ $board->option1 === 'y' ? '셀프 직영 공사 입니다.' : $board->company_name }}</h5>

        <h4>현재 주택의 유형을 선택해주세요.</h4>
        <h5>
            @if ($board->option3 === 1)
                현재 소유 중입니다.
            @elseif ($board->option3 === 2)
                매매 중 잔금 전입니다.
            @endif
        </h5>

        <h4>허가받을 공사 내용을 간략하게 작성해주세요.</h4>
        <h5>{!! nl2br($board->contents) !!}</h5>

        <h4>다른 서비스도 이용할 예정이신가요?</h4>
        <h5>
            {{ $other_service_options }}
        </h5>

        <i style="height: 29px;"></i>

        <label class="lb_chk"><input type="checkbox" name="" id="" class="required"><p>현장 주소를 재차 확인하였습니다.<span class="t_red">*</span></p></label>
        <label class="lb_chk"><input type="checkbox" name="" id="" class="required"><p>접수완료 후에 채팅창에 “신청인명” 또는 “업체명”을 입력해주세요.<span class="t_red">*</span></p></label>

        <i style="height: 18px;"></i>

        <div class="bx_btnBottom">
            <button type="button" class="btn_confirm b_point" onclick="formSubmit()">접수하기</button>
            <button type="button" class="btn_back" onclick="window.history.back()">뒤로가기</button>
        </div>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>
<script>
    function formSubmit() {
        let cnt = 0;

        Array.from(document.querySelectorAll('.required')).forEach(el => {
            if (el.checked) {
                cnt ++;
            }
        });
        if (cnt !== 2) {
            alert("체크박스를 선택해주세요.");
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/v1/application/{{ $board->board_id }}",
            success: function(res) {
                if (res.result === 'success') {
                    location.href = '{{ route('user.application.complete') }}';
                } else {
                    console.log(res);
                }
            },
            error:function(request, status, error){
                console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });
    }
</script>
</html>