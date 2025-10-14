<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일태산</title>
    <link rel="shortcut icon" href="/public/img/common/img_favicon.ico" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/public/css/user.common.css">
    <link rel="stylesheet" href="/public/css/user.sub.css">

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script>

    </script>
</head>
<body id="page_news"><input type="hidden" id="input_page" value="news">
    <main>
        <h2>소식</h2>
        <div class="bx_list">
            @foreach($rows as $rq)
                <a href="javascript:event.preventDefault()">
                    <p>{{ date('Y년 m월 d일', strtotime($rq->created_at)) }}</p>
                    @if ($rq->saved)
                        <img src="{{ asset('/storage/notice/'. $rq->saved) }}" alt="">
                    @endif
                </a>
            @endforeach
        </div>

        {{ $rows->withQueryString()->links('admin.paginate') }}

        <i style="height: 18px"></i>
        <button type="button" class="btn_submit b_point" onclick="location.href='{{ route('user.index') }}'">뒤로가기</button>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>
</html>
