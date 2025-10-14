<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일태산</title>
    <link rel="shortcut icon" href="/public/img/common/img_favicon.ico" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/public/css/user.common.css">
    <link rel="stylesheet" href="/public/css/user.sub.css">

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="https://tistory4.daumcdn.net/tistory/3134841/skin/images/confetti_v2.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script src="/public/js/user.complete.js"></script>
    <script>
        $(function(){
            reAction();
        });
        function reAction() {
            $("#startButton").trigger("click");

            setTimeout(function () {
                $("#stopButton").trigger("click");


                setTimeout(reAction, 1000);  
            }, 10000);  
            }

    </script>
</head>
<body id="page_complete"><input type="hidden" id="input_page" value="">
    <main>
    <div class="buttonContainer is-hidden" style="display:none;">
        <button class="canvasBtn" id="stopButton">Stop Confetti</button>
        <button class="canvasBtn" id="startButton">Drop Confetti</button>
    </div>
        <div class="bx_border">
        <canvas id="canvas" style="position:absolute; top:0;"></canvas>
            <img src="/public/img/user/complete_ico_check.webp" alt="확인 아이콘">
            <b>접수완료</b>

            <p>
                접수 확인 알림톡이 전송됩니다.<br>
                채팅창에 “신청인명 또는 업체명”을 꼭! 남겨주세요.<br>
                좀 더 빠른 업무처리에 도움이 됩니다.
            </p>

            <span>
                (주)할일태산<br>
                365일 연중 무휴 / 24시간 신청 / 09:00~18:00
            </span>

            <div class="wrap_particles">
                <button type="button" class="btn btn_submit b_point" onclick="location.href='{{ route('user.index') }}'">확인</button>
                <div class="bx_particles">
                </div>
              </div>
        </div>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>
</html>
