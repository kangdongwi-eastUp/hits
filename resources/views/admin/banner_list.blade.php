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

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/admin.common.js"></script>
</head>
<body id="page_banner_list"><input type="hidden" id="input_page" value="banner">
    <header></header>
    <main class="minWidth2">
        <h2>상단 배너 관리</h2>
        <div class="wrap_contents">
            <div class="bx_btnTop">
                <button type="button" class="br_gray" onclick="location.href='{{ route('admin.banner.write') }}'"><img src="/public/img/admin/ico_write.svg" alt="등록 아이콘">&nbsp;배너 등록</button>
            </div>

            <table class="tb_main">
                <colgroup>
                    <col width="8%">
                    <col width="">
                    <col width="10%">
                    <col width="8%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <th>No.</th>
                    <th>배너명</th>
                    <th>등록날짜</th>
                    <th>삭제</th>
                    <th>Y / N</th>
                </thead>
                <tbody>
                    @php
                        $no = $rows->total() - (($rows->currentPage() - 1) * $rows->perPage());
                    @endphp
                    @foreach($rows as $rq)
                        <tr>
                            <td>{{ $no-- }}</td>
                            <td>{!! $rq->banner_name !!}</td>
                            <td>{{ date('Y.m.d',strtotime($rq->created_at)) }}</td>
                            <td><button type="button" class="btn br_gray" onclick="deleteBanner({{ $rq->banner_id }})"><img src="/public/img/admin/ico_delete.svg" alt="삭제 아이콘">&nbsp;삭제</button></td>
                            <td><button type="button" class="btn br_gray" onclick="changeStatus({{ $rq->banner_id }},this)">{{ $rq->status === 'y' ? 'Y' : 'N' }}</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rows->withQueryString()->links('admin.paginate') }}
        </div>
    </main>
</body>
<script>
    async function changeStatus(banner_id,obj) {
        let currentStatus = obj.innerText.trim();
        let text = '숨김 처리 하시겠습니까?';
        let status = 'n';
        if (currentStatus === 'N') {
            text = '보임 처리 하시겠습니까?';
            status = 'y';
        }

        if (confirm(text)) {
            const url = `/adm/v1/banner/${banner_id}/status`;
            const params = {
                'status' : status
            };
            const options = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type' : 'application/json',
                },
                method : 'PUT',
                body : JSON.stringify(params)
            };

            try {
                const response = await fetch(url,options);
                const res = await response.json();
                if (res.result === 'success') {
                    location.reload()
                } else {
                    console.error(res);
                }
            } catch (err) {
                console.error(err);
            }
        }
    }
    async function deleteBanner(banner_id) {
        if (confirm("정말로 삭제처리 하시겠습니까?")) {
            const url = `/adm/v1/banner/${banner_id}`;
            const options = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : 'DELETE'
            };

            try {
                const response = await fetch(url,options);
                const res = await response.json();
                if (res.result === 'success') {
                    location.reload();
                } else {
                    console.error(res);
                }
            } catch (err) {
                console.error(err);
            }
        }
    }
</script>
</html>
