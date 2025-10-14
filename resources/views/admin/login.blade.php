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
    <script>
        window.onload = function(){
            $('body').addClass('loaded')
        }
    </script>
</head>
<body id="page_login"><input type="hidden" id="input_page" value="">
    <header>
        <div class="minWidth">
            <img src="/public/img/common/img_logo_v.webp" alt="할일태산 로고">
            <a href="{{ route('user.index') }}" target="_blank">홈페이지 바로가기</a>
        </div>
    </header>
    <main class="minWidth2">
        <form class="wrap_contents" id="form">
            <input type="text" placeholder="아이디를 입력해주세요" name="id">
            <input type="password" placeholder="비밀번호를 입력해주세요" name="password">
            <button type="button" class="btn_submit b_point" onclick="login()">LOGIN</button>
        </form>
    </main>
</body>
<script>
    function login() {
        let formData = new FormData(document.getElementById('form'));

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "/adm/v1/login",
            method : "POST",
            data : formData,
            processData : false,
            contentType : false,
            success : function (res) {
                if (res.result === 'success') {
                    location.href = '{{ route('admin.apply') }}'
                } else {
                    console.error(res);
                }
            },
            error:function(request, status, error){
                // console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                if (request.status === 401) {
                    alert("계정정보를 확인해주세요.");
                    document.querySelector('input[name="id"]').value = '';
                    document.querySelector('input[name="password"]').value = '';
                    return false;
                }
            }
        })
    }
</script>
</html>
