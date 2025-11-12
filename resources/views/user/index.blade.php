<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일태산</title>
    <link rel="shortcut icon" href="/public/img/common/img_favicon.ico" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/public/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/public/css/user.common.css">
    <link rel="stylesheet" href="/public/css/user.index.css">

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/swiper-bundle.min.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swiperInit()
        })

        let slide_main;

        function swiperInit() {
            slide_main = new Swiper(".slide_main", {
                rewind: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    type: "fraction",
                },
            })
        }

        function btn_autoplay(obj) {
            if ($(obj).is('.paused')) {
                slide_main.autoplay.start()
            } else {
                slide_main.autoplay.stop()
            }
            $(obj).toggleClass('paused')
        }

        $(function() {
            $(document).on('click', 'input[type="checkbox"]', function(e) {
                let clickedName = $(this).attr('name');
                let clickedId = $(this).attr('id');

                if (['first_service', 'second_service', 'third_service'].includes(clickedName)) {
                    if ($(this).is(':checked')) {} else {
                        // 2025.10.12 강동위 추가 - 방충망 시공, 종합청소 신청서 추가
                        if (!$('input#four-service').is(':checked') && !$('input#five-service').is(':checked') && !$('input#six-service').is(':checked') && !$('input#seven-service').is(':checked')) {
                            $('input[type="checkbox"]').prop('disabled', false);
                        }
                    }
                } else if (['four-service', 'five-service', 'six-service', 'seven-service', 'eight-service'].includes(clickedId)) {
                    // 2025.10.12 강동위 추가 - 방충망 시공, 종합청소 신청서 추가
                    if ($('input[name="first_service"]').is(':checked') || $('input[name="second_service"]').is(':checked') || $('input[name="third_service"]').is(':checked')) {
                        e.preventDefault();
                        alert('해당 상품은 중복선택이 불가하세요. 개별선택을 해주세요');
                        return false;
                    }
                    if ($(this).is(':checked')) {
                        $('input[type="checkbox"]').not(this).prop('disabled', true);
                    } else {
                        $('input[type="checkbox"]').prop('disabled', false);
                    }
                }

                // 카운트 업데이트 로직을 이벤트 핸들러의 마지막으로 이동
                // setTimeout을 사용하여 DOM 변경(체크박스 선택/해제)이 완료된 후 카운트를 계산합니다.
                setTimeout(function() {
                    let checkedLength = $('.bx_links input:checked').length;

                    if (checkedLength == 0) {
                        $('.btn_submit').attr('data-value', '').removeClass('active');
                    } else {
                        $('.btn_submit').attr('data-value', checkedLength).addClass('active');
                        // 2025.10.12 강동위 추가 - 서비스 추가로 인한 신청하기 버튼이 잘 안보여서 하단 스크롤 기능 추가
                        $('html, body').animate({
                            scrollTop: $(document).height()
                        }, 300);
                    }
                }, 0);
            });

            $('.bx_links label').on('click', function(e) {
                let checkbox = $(this).find('input[type="checkbox"]');
                if (checkbox.prop('disabled')) {
                    e.preventDefault();
                    alert('해당 상품은 중복선택이 불가하세요. 개별선택을 해주세요');
                }
            });

        });
    </script>
</head>

<body id="page_index"><input type="hidden" id="input_page" value="home">
    <main>
        <div class="slide_main swiper">
            <div class="swiper-wrapper">
                @foreach($rows as $rq)
                <a href="{{ $rq->url ? : '' }}" class="swiper-slide"><img src="{{ asset('/storage/banner/'.$rq->saved) }}" alt=""></a>
                @endforeach
            </div>
            <button type="button" class="swiper-button-autoplay" onclick="btn_autoplay(this)"></button>
            <div class="swiper-pagination"></div>
        </div>
        <form class="bx_links" id="form" action="{{ route('user.application.write') }}">
            <label for="first-service">
                <img src="/public/img/user/main_lk_ico1.webp" alt="입주민 동의 아이콘">
                입주민 동의서
                <input type="checkbox" name="first_service" id="first-service" class="q_first" value="1" hidden><i></i>
            </label>
            <label for="second-service">
                <img src="/public/img/user/main_lk_ico2.webp" alt="승강기 아이콘">
                승강기 보양
                <input type="checkbox" name="second_service" id="second-service" class="q_first" value="2" hidden><i></i>
            </label>
            <label for="third-service">
                <img src="/public/img/user/main_lk_ico3.webp" alt="허가 아이콘">
                행위허가
                <input type="checkbox" name="third_service" class="q_first" id="third-service" value="3" hidden><i></i>
            </label>
            <label for="five-service">
                <img src="/public/img/user/main_lk_ico4.webp" alt="보양 아이콘">
                보양 탈거
                <input type="checkbox" name="q_second" id="five-service" value="5" hidden><i></i>
            </label>
            <label for="four-service">
                <img src="/public/img/user/main_lk_ico5.webp" alt="검사 아이콘">
                사용검사
                <input type="checkbox" name="q_second" id="four-service" value="4" hidden><i></i>
            </label>
            <label for="six-service">
                <img src="/public/img/user/main_lk_ico6.webp" alt="방충망 아이콘">
                방충망 시공
                <input type="checkbox" name="q_second" id="six-service" value="6" hidden><i></i>
            </label>
            <label for="seven-service">
                <img src="/public/img/user/main_lk_ico7.webp" alt="청소 아이콘">
                종합 청소
                <input type="checkbox" name="q_second" id="seven-service" value="7" hidden><i></i>
            </label>
            <label for="eight-service">
                <img src="/public/img/user/main_lk_ico8.webp" alt="폐기물수거 아이콘">
                폐기물 수거
                <input type="checkbox" name="q_second" id="eight-service" value="8" hidden><i></i>
            </label>

        </form>
        <button type="button" class="btn_submit b_point" onclick="document.getElementById('form').submit()">신청하기</button>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>

</html>