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
<body id="page_banner_write"><input type="hidden" id="input_page" value="banner">
    <header></header>
    <main class="minWidth2">
        <h2>상단 배너 관리 ▸ 배너 등록</h2>
        <form id="form" class="wrap_contents">
            <div class="bx_write">
                <dl><dt>배너명</dt>
                    <dd>
                        <input type="text" name="banner_name">
                    </dd>
                </dl>
                <dl><dt>이미지 등록</dt>
                    <dd>
                        <label class="lb_inputFile">
                            <img src="/public/img/common/img_nothumb_v.webp" alt="미리보기 이미지" id="prevImg">
                            <input type="file" name="file" id="" hidden="hidden" onchange="filePrev(this)">
                        </label>
                        <p>
                            상단 배너 권장 사이즈: 1024px*384px<br>
                            파일 형식: jpg / png
                        </p>
                    </dd>
                </dl>
                <dl><dt>URL 등록</dt>
                    <dd>
                        <input type="text" name="url">
                    </dd>
                </dl>
            </div>
            <div class="bx_btnBottom">
                <button type="button" onclick="formSubmit()">확인</button>
                <button type="button" onclick="location.href='{{ route('admin.banners') }}'">취소</button>
            </div>
        </form>
    </main>
</body>
<script>
    function filePrev(obj) {
        const file = obj.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('prevImg').src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    }

    function validationChk() {
        if (document.querySelector('input[name="banner_name"]').value.trim().length === 0) {
            alert("배너명을 입력해주세요.");
            return false;
        }
        if (document.querySelector('input[name="file"]').files.length === 0) {
            alert("이미지를 첨부해주세요.");
            return false;
        }
        return true;
    }

    function formSubmit() {
        if (validationChk()) {
            if (confirm("배너를 등록하시겠습니까?")) {
                let formData = new FormData(document.getElementById('form'));

                $.ajax({
                    headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method : 'POST',
                    url : '/adm/v1/banner',
                    data : formData,
                    contentType : false,
                    processData : false,
                    success : function (res) {
                        if (res.result === 'success') {
                            location.href = '{{ route('admin.banners') }}'
                        } else {
                            console.error(res);
                        }
                    },
                    error:function(request, status, error){
                        console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }
                })
            }
        }
    }
</script>
</html>
