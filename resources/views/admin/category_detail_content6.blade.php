<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일태산 어드민</title>
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
<body id="page_category_content"><input type="hidden" id="input_page" value="category">
    <header></header>
    <main class="minWidth3">
        <h2>입주민 동의서 + 승강기 보양</h2>
        <div class="wrap_contents">
            <h3>공사 기간을 입력해주세요. <span class="t_red">*</span></h3>
            <h4>{{ date('Y-m-d',strtotime($board->start_date)) }} 부터 {{ date('Y-m-d',strtotime($board->end_date)) }}</h4>

            <h3>현장 주소를 입력해주세요. <span class="t_red">*</span></h3>
            <h4>{{ $board->address1.' '.$board->address2 }}</h4>

            <h3>신청인명과 연락처를 입력해주세요. <span class="t_red">*</span></h3>
            <h4>{{ $board->name }}<br>{{ $board->phone }}</h4>

            <h3>신청인이 업체이시면 업체명을 작성해주세요.</h3>
            <h4>{{ $board->option1 === 'y' ? '셀프 직영 공사 입니다.' : $board->company_name }}</h4>

            <h3>현장 담당자명과 연락처를 작성해주세요.</h3>
            <h4>{{ $board->manager_name }}<br>{{ $board->manager_phone }}</h4>

            <h3>공사내용을 간략하게 작성해주세요.</h3>
            <h4>{!! nl2br($board->contents) !!}</h4>

            <h3>소음이 집중적으로 예상되는 날을 작성해주세요.</h3>
            <h4>{!! nl2br($board->noise_date) !!}</h4>

            <h3>희망하는 보양 타입을 선택해주세요. <span class="t_red">*</span></h3>
            <h4>
                {{ $options }}
            </h4>

            <i style="height: 38px;"></i>
            <button type="button" class="btn_back" onclick="location.href='/adm/boards/{{ $board->type }}'">뒤로가기</button>
        </div>
    </main>
</body>
</html>
