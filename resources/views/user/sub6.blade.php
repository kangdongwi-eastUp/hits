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
    <link rel="stylesheet" href="/public/js/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="/public/js/mdp/jquery-ui.multidatespicker.css">
    <link rel="stylesheet" href="/public/css/user.common.css">
    <link rel="stylesheet" href="/public/css/user.sub.css">

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/jquery-ui-1.13.2/jquery-ui.min.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="/public/js/mdp/jquery-ui.multidatespicker.js"></script>

    <script>
        function validation() {
            if (document.getElementById('start_date').value === "" || document.getElementById('end_date').value === "") {
                alert("기간을 입력해주세요.");
                return false;
            }
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
                formData.append('type','6');

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
<body id="page_sub6"><input type="hidden" id="input_page" value="">
    <main>
        <h3>입주민 동의서 + 승강기 보양</h3>
        <form id="form" class="bx_form">
            <h4>공사 기간을 입력해주세요. <span class="t_red">*</span></h4>
            <h5>확정되지 않은 경우 예상일 또는 희망일을 입력해주세요.</h5>
            <div class="wrap_input wrap_date">
                <input type="date" id="start_date" name="start_date" class="input_dateFrom datepicker" max="9999-12-31">
                부터&ensp;
                <input type="date" id="end_date" name="end_date" class="input_dateTo datepicker" max="9999-12-31">
            </div>

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

            <h4>현장 담당자명과 연락처를 작성해주세요.</h4>
            <h5>공사안내문에 표기되는 사항입니다.</h5>
            <div class="wrap_input">
                <label class="lb_chk"><input type="checkbox" name="" id="" onclick="getUser(1,this)">위 신청인과 같아요.</label>
                <input type="text" name="manager_name" id="" class="input_name" placeholder="성명" >
                <input type="text" name="manager_phone" id="" maxlength="13" oninput="phoneValidation(this)" placeholder="연락처는 숫자만 입력해주세요">
            </div>

            <h4>공사내용을 간략하게 작성해주세요.</h4>
            <h5>공사내용 중 비내력벽 철거, 발코니 확장이 있는 경우에는 사전 행위허가 진행 여부를 고려해 볼 필요가 있습니다.</h5>
            <div class="wrap_input">
                <textarea name="contents" id="" cols="30" rows="10" placeholder="예)철거,도배,바닥,욕실,목공,가구 등"></textarea>
            </div>

            <h4>소음이 집중적으로 예상되는 날을 작성해주세요.</h4>
            <h5>※ 미작성시 착공일로부터 3일을 임의로 표기해드립니다.</h5>
            <div class="wrap_input for_mdpicker">
                <input type="text" name="noise_date" id="" class="mdpicker">
            </div>

            <h4>희망하는 보양 타입을 선택해주세요. <span class="t_red">*</span></h4>
            <h5>중복 선택이 가능하며 긴급건은 당일 또는 익일입니다.</h5>
            <div class="bx_chks">
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="긴급" id="">긴급</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="올보양" id="">올보양</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="준보양" id="">준보양</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="하프보양" id="">하프보양</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="기타보양(바닥,벽)" id="">기타보양(바닥,벽)</label>
                <label class="lb_chk"><input type="checkbox" name="boyang[]" value="관리사무소 규정 확인후 시공해주세요." id="">관리사무소 규정 확인후 시공해주세요.</label>
            </div>

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
