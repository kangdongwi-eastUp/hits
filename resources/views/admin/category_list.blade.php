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
<body id="page_category_list"><input type="hidden" id="input_page" value="category">
    <header></header>
    <main class="minWidth2">
        <h2>카테고리 관리</h2>
        <div class="wrap_contents">
            <div class="bx_btnTop">
                <button type="button" class="br_gray" onclick="location.href='{{ route('admin.apply.delete') }}'"><img src="/public/img/admin/ico_delete.svg" alt="삭제 아이콘">&nbsp;휴지통</button>
            </div>
            <hr class="hr_lists">
            <ul class="bx_lists">
                <li>
                    <p class="row01 {{ $result[1] === 'y' ? 'new' : '' }}">입주민 동의서</p>
                    <button type="button" onclick="location.href='/adm/boards/1'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[6] === 'y' ? 'new' : '' }}">입주민 동의서 + 승강기보양</p>
                    <button type="button" onclick="location.href='/adm/boards/6'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[2] === 'y' ? 'new' : '' }}">승강기 보양</p>
                    <button type="button" onclick="location.href='/adm/boards/2'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[7] === 'y' ? 'new' : '' }}">입주민 동의서 + 승강기보양 + 행위허가</p>
                    <button type="button" onclick="location.href='/adm/boards/7'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[3] === 'y' ? 'new' : '' }}">행위허가</p>
                    <button type="button" onclick="location.href='/adm/boards/3'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[8] === 'y' ? 'new' : '' }}">입주민동의서 + 행위허가</p>
                    <button type="button" onclick="location.href='/adm/boards/8'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[9] === 'y' ? 'new' : '' }}">승강기 보양 + 행위허가</p>
                    <button type="button" onclick="location.href='/adm/boards/9'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[4] === 'y' ? 'new' : '' }}">사용검사</p>
                    <button type="button" onclick="location.href='/adm/boards/4'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[5] === 'y' ? 'new' : '' }}">보양탈거</p>
                    <button type="button" onclick="location.href='/adm/boards/5'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <!-- 2025.10.15 강동위 추가 - 방충망 시공 , 종합청소 서비스 추가 -->
                <li>
                    <p class="row01 {{ $result[10] === 'y' ? 'new' : '' }}">방충망시공</p>
                    <button type="button" onclick="location.href='/adm/boards/10'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
                <li>
                    <p class="row01 {{ $result[11] === 'y' ? 'new' : '' }}">종합청소</p>
                    <button type="button" onclick="location.href='/adm/boards/11'"><img src="/public/img/admin/category_ico_page.svg" alt="페이지 아이콘"></button>
                </li>
            </ul>
        </div>
    </main>
</body>
</html>
