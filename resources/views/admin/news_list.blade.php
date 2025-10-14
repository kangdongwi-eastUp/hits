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
<body id="page_news"><input type="hidden" id="input_page" value="news">
    <header></header>
    <main class="minWidth2">
        <h2>소식</h2>
        <div class="wrap_contents">
            <div class="bx_btnTop">
                <button type="button" class="br_gray" onclick="location.href='{{ route('admin.notice.write') }}'"><img src="/public/img/admin/ico_write.svg" alt="작성 아이콘">&nbsp;글 작성</button>
            </div>

            <table class="tb_main">
                <colgroup>
                    <col width="8%">
                    <col width="">
                    <col width="10%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <th>No.</th>
                    <th>소식명</th>
                    <th>등록날짜</th>
                    <th>삭제</th>
                </thead>
                <tbody>
                    @php
                        $no = $rows->total() - (($rows->currentPage() - 1) * $rows->perPage());
                    @endphp
                    @foreach($rows as $rq)
                        <tr>
                            <td>{{ $no-- }}</td>
                            <td>{!! $rq->title !!}</td>
                            <td>{{ date('Y.m.d',strtotime($rq->created_at)) }}</td>
                            <td><button  type="button" class="btn br_gray" onclick="deleteNotice({{ $rq->notice_id }})"><img src="/public/img/admin/ico_delete.svg" >&nbsp;삭제</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rows->withQueryString()->links('admin.paginate') }}
        </div>
    </main>
</body>
<script>
    function deleteNotice(notice_id) {
        if (confirm("해당 소식을 삭제하시겠습니까?")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                method : "DELETE",
                url : `/adm/v1/notice/${notice_id}/delete`,
                success : function (res) {
                    if (res.message === 'success') {
                        location.reload()
                    } else {
                        console.log(res);
                    }
                },
                error:function(request, status, error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            })
        }
    }
</script>
</html>
