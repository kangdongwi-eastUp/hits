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

    <style>
        .bx_chks_split {
            display: flex;
            justify-content: space-between;
            margin: 6px 0 18px;
        }
        .bx_chks_split .chk_group {
            width: 48%;
        }
        .bx_chks_split .chk_group .lb_chk {
            display: block;
            width: 100%;
            padding: 6px 0;
        }
    </style>

    <script>
        function validation() {
            if (document.getElementById('start_date').value === "") {
                alert("수거 희망일을 입력해주세요.");
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
            // 수거할 예상 폐기물량 필수 체크
            var arr = 0;
            Array.from(document.querySelectorAll('input[name="boyang[]"]')).forEach(row => {
                if (row.checked) {
                    arr++;
                }
            });
            if (arr === 0) {
                alert("수거할 예상 폐기물량을 선택해주세요.");
                return false;
            }
            let cnt = 0;
            Array.from(document.querySelectorAll('.required')).forEach(chk => {
                if (chk.checked) {
                    cnt++;
                }
            });
            if (cnt !== 2) {
                alert("개인정보 수집 및 이용동의, 개인정보 제3자 제공 동의는 필수입니다.");
                return false;
            }

            return true;
        }

        function formSubmit() {
            if (validation()) {
                let formData = new FormData(document.getElementById('form'));
                formData.append('type', '12');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/v1/application",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.result === 'success') {
                            location.href = `/application/${res.data.board_id}`;
                        } else {
                            console.log(res);
                        }
                    },
                    error: function(request, status, error) {
                        console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                    }
                });

            }
        }
    </script>
</head>

<body id="page_sub12"><input type="hidden" id="input_page" value="">
    <main>
        <h3>폐기물수거</h3>
        <form id="form" class="bx_form">
            <h4>수거 희망일을 선택해 주세요 <span class="t_red">*</span></h4>
            <h5>확정되지 않은 경우 예상일 또는 희망일을 입력해주세요.</h5>
            <div class="wrap_input">
                <input type="date" name="start_date" id="start_date" class="input_dateFrom datepicker" max="9999-12-31" placeholder="날짜를 선택해 주세요.">
            </div>

            <h4>현장 주소를 입력해주세요. <span class="t_red">*</span></h4>
            <h5 class="t_dRed">주소를 꼭! 정확하게 입력해 주세요.</h5>
            <div class="wrap_input">
                <input type="text" class="input_map" placeholder="주소를 입력해주세요." id="address0" onclick="postCode()" name="address1">
                <input type="text" id="address1" placeholder="000동 0000호" name="address2">
            </div>

            <h4>신청인명과 연락처를 입력해주세요. <span class="t_red">*</span></h4>
            <div class="wrap_input">
                <input type="text" id="name" name="name" class="input_name" placeholder="성명">
                <input type="text" id="phone" name="phone" maxlength="13" oninput="phoneValidation(this)" placeholder="-없이 숫자만 입력해주세요">
            </div>

            <h4>신청인이 업체이시면 업체명과 연락처를 작성해주세요.</h4>
            <h5>개인 입주자 신청인 경우 무관합니다.</h5>
            <div class="wrap_input">
                <input type="text" placeholder="업체명을 입력해주세요." name="company_name">
                <input type="text" id="company_phone" name="company_phone" maxlength="13" oninput="phoneValidation(this)" placeholder="-없이 숫자만 입력해주세요">
            </div>

            <h4>수거할 예상 폐기물량을 선택 해주세요.<span class="t_red">*</span></h4>
            <h5>기본 1톤 화물차로 운영됩니다.</h5>
            <div class="bx_chks_split">
                <div class="chk_group">
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 10마대 이하" id="">약 10마대 이하</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 6분의1차" id="">약 6분의1차</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 3분의1차" id="">약 3분의1차</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 2분의1차" id="">약 2분의1차</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 3분의2차" id="">약 3분의2차</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="약 1차" id="">약 1차</label>
                </div>
                <div class="chk_group">
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="알 수 없으며 알아서 싣고 연락 주세요." id="">알 수 없으며 </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;알아서 싣고 연락 주세요.</label>
                    <label class="lb_chk"><input type="checkbox" name="boyang[]" value="알 수 없으며 싣기전 연락 주세요." id="">알 수 없으며 </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;싣기전 연락 주세요.</label>
                </div>
            </div>
            <h4>참고할 사항이 있으면 작성 해주세요.</h4>
            <div class="wrap_input">
                <textarea name="contents" id="" cols="30" rows="10" placeholder="예) 긴급, 극 소량"></textarea>
            </div>

            <h4>다른 서비스도 이용할 예정이신가요?</h4>
            <div class="bx_chks">
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="입주민 동의서" id="">입주민 동의서</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="승강기 보양" id="">승강기 보양</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="행위허가" id="">행위허가</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="보양탈거" id="">보양탈거</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="사용검사" id="">사용검사</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="방충망 시공" id="">방충망 시공</label>
                <label class="lb_chk"><input type="checkbox" name="other_service_option[]" value="종합청소" id="">종합청소</label>
            </div>
            
            <div id="page_sub1">
                <label class="lb_chk lb_chkAll">
                    <input type="checkbox" name="q_third_all" id="q_third_all" onclick="chkAll(this)">
                    모두 선택
                </label>
                <ul class="bx_chkPolicy">
                    <li>
                        <label class="lb_chk"><input type="checkbox" name="terms1" class="terms required" onclick="chkAllState()">개인정보 수집 및 이용동의</label>
                        <a href="/includes/privacy01.html">(전체 보기)</a>
                    </li>
                    <li>
                        <label class="lb_chk"><input type="checkbox" name="terms2" class="terms required" onclick="chkAllState()">개인정보 제3자 제공 동의</label>
                        <a href="/includes/privacy02.html">(전체 보기)</a>
                    </li>
                    <li>
                        <label class="lb_chk"><input type="checkbox" name="terms3" class="terms" onclick="chkAllState()">마케팅 활용정보 동의 (선택)</label>
                        <a href="/includes/privacy03.html">(전체 보기)</a>
                    </li>
                </ul>
            </div>
            <div class="bx_btnBottom">
                <button type="button" class="btn_confirm b_point" onclick="formSubmit()">접수하기</button>
                <button type="button" class="btn_cancel b_secondary" onclick="location.href='{{ route('user.index') }}'">뒤로</button>
            </div>
        </form>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>

</html>