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
            if (document.getElementById('start_date').value === "") {
                alert("시공 희망일을 입력해주세요.");
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
            let flag = false;
            Array.from(document.querySelectorAll('input[name="option4"]')).forEach(row => {
                if (row.checked) {
                    flag = true;
                }
            });
            if (!flag) {
                alert("당사에서 행위허가를 진행했는지 여부를 체크해주세요.");
                return false;
            }

            // if (!document.querySelector('input[name="terms4"]').checked) {
            //     alert("전문 상담에 대한 확인을 해주셔야합니다.");
            //     return false;
            // }

            return true;
        }

        function formSubmit() {
            if (validation()) {
                let formData = new FormData(document.getElementById('form'));
                formData.append('type','4');

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
<body id="page_sub4"><input type="hidden" id="input_page" value="">
    <main>
        <h3>사용검사</h3>
        <form id="form" class="bx_form">
            <h4>시공 희망일을 선택해주세요. <span class="t_red">*</span></h4>
            <h5>확정되지 않은 경우 예상일 또는 희망일을 입력해주세요.</h5>
            <div class="wrap_input">
                <input type="date" name="start_date" id="start_date" class="input_dateFrom datepicker" max="9999-12-31">
            </div>

            <h4>현장 주소를 입력해주세요. <span class="t_red">*</span></h4>
            <h5 class="t_dRed">주소를 꼭! 정확하게 입력해 주세요.</h5>
            <div class="wrap_input">
                <input type="text" id="address0" name="address1" onclick="postCode()" class="input_map" placeholder="주소를 입력해주세요.">
                <input type="text" id="address1" name="address2" placeholder="상세주소를 입력해주세요">
            </div>

            <h4>신청인명과 연락처를 입력해주세요. <span class="t_red">*</span></h4>
            <div class="wrap_input">
                <input type="text" name="name" id="name" class="input_name" placeholder="성명">
                <input type="text" name="phone" id="phone" maxlength="13" oninput="phoneValidation(this)" placeholder="연락처는 숫자만 입력해주세요">
            </div>

            <h4>신청인이 업체이시면 업체명을 작성해주세요.</h4>
            <h5>업체 등록 후 멤버쉽 전용 단가로 이용이 가능하게 됩니다. 차후 채팅으로 안내해 드릴게요.</h5>
            <div class="wrap_input">
                <label class="lb_chk"><input type="checkbox" name="company_name" id="">셀프 직영 공사입니다</label>
                <input type="text" placeholder="업체명을 입력해주세요." name="company_phone">
            </div>

            <h4>당사에서 행위허가를 진행한 현장인가요?</h4>
            <div class="wrap_input">
                <label class="lb_chk"><input type="radio" name="option4" value="y" id="">네, 할일태산에서 행위허가 했어요.</label>
                <label class="lb_chk"><input type="radio" name="option4" value="n" id="">아니오. 타사에서 진행했습니다.</label>
            </div>

            <h4>신청접수가 완료되면 방화판,방화유리,갑종방화문에 관한 전문 상담이 이루어집니다.</h4>
            <div class="wrap_input">
                <label class="lb_chk"><input type="checkbox" name="terms4" id="" value="y">네, 확인하였습니다.</label>
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
