window.onload = function(){
    $('body').addClass('loaded')
}

//====================
$(function(){

    if ($('.datepicker').length) {

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년'
        });

        $('.datepicker').datepicker({
            changeMonth: true,
            changeYear: true,
        });

        
        if ($('.mdpicker').length) {

            $('.mdpicker').multiDatesPicker({
                dateFormat: 'mm-dd',
            });
        
            $.datepicker._selectDateOverload = $.datepicker._selectDate;
            $.datepicker._selectDate = function(id, dateStr) {
                var target = $(id);
                var inst = this._getInst(target[0]);
                inst.inline = true;
                $.datepicker._selectDateOverload(id, dateStr);
                inst.inline = false;
        
                if (target[0].multiDatesPicker != null) {
                    target[0].multiDatesPicker.changed = false;
                } else {	
                    target.multiDatesPicker.changed = true;
                }
                this._updateDatepicker(inst);
        
                if (target[0].multiDatesPicker == undefined) {
                    this._hideDatepicker();
                    target[0].blur();
                }
            };

        }

    }

    let page = $('#input_page').val();

    if($('.fnb').length > 0){
        $('.fnb').load('/includes/user.fnb.html', function(){
            if(page != ''){
                $(`.fnb a[data-value="${page}"]`).addClass('active')
            }
        })
    }
    if($('.bg_body').length > 0){
        $('.bg_body').load('/includes/user.bg_body.html')
    }

})

function btn_goBack(){
    window.history.back()
}

//==================== validation
function maxLeng(el, maxlength){
    if(el.value.length > maxlength)  {
        el.value = el.value.substr(0, maxlength);
    }      
}

//전화번호
function phoneValidation(obj){
    obj.value = obj.value.replace(/[^0-9]/g, '').replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
}

function postCode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                };
            }


            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById("address0").value = addr + extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("address1").focus();
        }
    }).open();
}

function disabledCompanyName(obj) {
    if (obj.checked) {
        document.querySelector('input[name="company_name"]').readOnly = true;
        document.querySelector('input[name="company_name"]').value = "";
        return false;
    }
    document.querySelector('input[name="company_name"]').readOnly = false;
}

function emptyInput() {
    document.querySelector('input[name="resident_name"]').value = "";
    document.querySelector('input[name="resident_phone"]').value = "";
}

function getUser(type,obj) {
    if (obj.checked) {
        if (type === 1) {
            document.querySelector('input[name="manager_name"]').value = document.getElementById('name').value;
            document.querySelector('input[name="manager_phone"]').value = document.getElementById('phone').value;
            document.querySelector('input[name="manager_name"]').readOnly = true;
            document.querySelector('input[name="manager_phone"]').readOnly = true;
        }
        if (type === 2) {
            document.querySelector('input[name="resident_name"]').value = document.getElementById('name').value;
            document.querySelector('input[name="resident_phone"]').value = document.getElementById('phone').value;
            document.querySelector('input[name="resident_name"]').readOnly = true;
            document.querySelector('input[name="resident_phone"]').readOnly = true;
        }
    } else {
        if (type === 1) {
            document.querySelector('input[name="manager_name"]').value = '';
            document.querySelector('input[name="manager_phone"]').value = '';
            document.querySelector('input[name="manager_name"]').readOnly = false;
            document.querySelector('input[name="manager_phone"]').readOnly = false;
        }
        if (type === 2) {
            document.querySelector('input[name="resident_name"]').value = '';
            document.querySelector('input[name="resident_phone"]').value = '';
            document.querySelector('input[name="resident_name"]').readOnly = false;
            document.querySelector('input[name="resident_phone"]').readOnly = false;
        }
    }
}

function chkAll(obj) {
    if (obj.checked) {
        Array.from(document.querySelectorAll('.terms')).forEach(row => {
            row.checked = true;
        });
    } else {
        Array.from(document.querySelectorAll('.terms')).forEach(row => {
            row.checked = false;
        });
    }
}

function chkAllState() {
    let arr = 0;
    Array.from(document.querySelectorAll('.terms')).forEach(row => {
        if (row.checked) {
            arr++;
        }
    });

    if (arr === 3) {
        document.getElementById('q_third_all').checked = true;
    } else {
        document.getElementById('q_third_all').checked = false;
    }
}