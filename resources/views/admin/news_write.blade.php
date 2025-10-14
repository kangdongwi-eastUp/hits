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
    <script>

    </script>
</head>
<body id="page_news_write"><input type="hidden" id="input_page" value="news">
    <header></header>
    <main class="minWidth2">
        <h2>소식 ▸ 글 작성</h2>
        <form id="form" class="wrap_contents">
            <div class="bx_write">
                <dl><dt>소식명</dt>
                    <dd>
                        <input type="text" name="title">
                    </dd>
                </dl>
                <dl><dt>이미지 등록</dt>
                    <dd>
                        <label class="lb_inputFile">
                            <img src="/public/img/common/img_nothumb.webp" alt="미리보기 이미지" id="prevImg">
                            <input type="file" name="file" id="" hidden="hidden" onchange="filePrev(this)">
                        </label>
                        <p>
                            소식 이미지 권장 사이즈: 768px*768px (1:1) 비율<br>
                            파일 형식: jpg / png
                        </p>
                    </dd>
                </dl>
            </div>
            <div class="bx_btnBottom">
                <button type="button" onclick="formSubmit()">확인</button>
                <button type="button" onclick="location.href='{{ route('admin.notice') }}'">취소</button>
            </div>
        </form>
    </main>
</body>
<script>

    function validationChk() {
        if (document.querySelector('input[name="title"]').value.trim().length === 0) {
            alert("소식명을 입력해주세요.");
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
            if (confirm("소식을 등록하시겠습니까?")) {
                let formData = new FormData(document.getElementById('form'));

                $.ajax({
                    headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method : 'POST',
                    url : '/adm/v1/notice',
                    data : formData,
                    contentType : false,
                    processData : false,
                    success : function (res) {
                        if (res.result === 'success') {
                            location.href = '{{ route('admin.notice') }}'
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
</script>
</html>
