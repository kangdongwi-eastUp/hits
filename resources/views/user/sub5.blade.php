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
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    
    <script>
        function validation() {
            if (document.getElementById('address0').value.length === 0 || document.getElementById('address1').value.length === 0) {
                alert("주소를 입력해주세요.");
                return false;
            }
            if (document.getElementById('name').value.length === 0) {
                alert("이름을 확인해주세요.");
                return false;
            }
            if (document.getElementById('phone').value.length === 0) {
                alert("연락처를 입력해주세요.");
                return false;
            }
            var arr = 0;
            Array.from(document.querySelectorAll('input[name="boyang[]"]')).forEach(row => {
                if (row.checked) {
                    arr++;
                }
            });
            if (arr === 0) {
                alert("보양 타입을 선택해주세요.");
                return false;
            }
            return true;
        }

        function formSubmit() {
            if (validation()) {
                let formData = new FormData(document.getElementById('form'));
                formData.append('type','5');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/v1/application",
                    data: formData,
                    processData : false,
                    contentType : false,
                    success: function(res) {
                        if (res.result === 'success') {
                            location.href = `/application/${res.data.board_id}`;
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
</head>
<body id="page_sub5"><input type="hidden" id="input_page" value="">
    <main>
        <h3>보양탈거</h3>
        <form id="form" class="bx_form">
            <h4>현장 주소를 입력해주세요. <span class="t_red">*</span></h4>
            <h5 class="t_dRed">주소를 꼭! 정확하게 입력해 주세요.</h5>
            <div class="wrap_input">
                <input type="text" id="address0" name="address1" onclick="postCode()" class="input_map" placeholder="주소를 입력해주세요.">
                <input type="text" id="address1" name="address2" placeholder="상세주소를 입력해주세요">
            </div>

            <h4>신청인명과 연락처를 입력해주세요. <span class="t_red">*</span></h4>
            <div class="wrap_input">
                <input type="text" id="name" name="name" class="input_name" placeholder="성명">
                <input type="text" id="phone" name="phone" maxlength="13" oninput="phoneValidation(this)" placeholder="연락처는 숫자만 입력해주세요">
            </div>

            <h4>신청인이 업체이시면 업체명을 작성해주세요.</h4>
            <h5>
                업체 등록 후 멤버쉽 전용 단가로 이용이 가능하게 됩니다. 차후 채팅으로 안내해 드릴게요.
            </h5>
            <div class="wrap_input">
                <label class="lb_chk"><input type="checkbox" name="option1" id="" onclick="disabledCompanyName(this)">셀프 직영 공사입니다</label>
                <input type="text" placeholder="업체명을 입력해주세요." name="company_name">
            </div>

            <h4>탈거할 보양을 선택해주세요. <span class="t_red">*</span></h4>
            <h5>잠깐! 당사에서 시공한 보양만 철거가 가능하며 폐기를 포함합니다.</h5>
            <div class="wrap_input">
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="승강기 보양" id="">승강기 보양</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="기타 보양(바닥,벽)" id="">기타 보양(바닥,벽)</label>
            </div>

            <h4>*보양탈거는 신청한 날로부터 당일 또는 익일 중 순회하며 탈거가 이루어집니다.</h4>

            <i style="height: 16px;"></i>
            <div class="bx_btnBottom">
                <button type="button" class="btn_confirm b_point" onclick="formSubmit()">접수하기</button>
                <button type="button" class="btn_cancel b_secondary" onclick="location.href='{{ route('user.index') }}'">취소</button>
            </div>
        </form>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>
</html>
