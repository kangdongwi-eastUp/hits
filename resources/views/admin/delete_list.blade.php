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
</head>
<body id="page_delete_list"><input type="hidden" id="input_page" value="delete">
    <header></header>
    <main class="minWidth2">
        <h2>휴지통</h2>
        <div class="wrap_contents">
            <div class="bx_btnTop">
                <button type="button" class="br_gray" onclick="restoreBoards()"><img src="/public/img/admin/ico_restore.svg" alt="복구 아이콘">&nbsp;복구</button>
                <i></i>
                <button type="button" class="br_gray" onclick="deleteBoards()"><img src="/public/img/admin/ico_delete.svg" alt="삭제 아이콘">&nbsp;영구삭제</button>
            </div>

            <hr class="hr_lists">
            <ul class="bx_lists">
                @foreach($rows as $row)
                    <li>
                        <label class="lb_chk">
                            <input type="checkbox" name="chkBox" class="" id="" value="{{ $row->board_id }}">
                            <p class="row01">{{ $row->name }}</p>
                        </label>
                        <button type="button" onclick="deleteBoard({{ $row->board_id }})"><img src="/public/img/admin/category_ico_delete.svg" alt="삭제 아이콘"></button>
                    </li>
                @endforeach
            </ul>
        </div>
    </main>
</body>
<script>
    function restoreBoards() {
        let arr = [];
        Array.from(document.querySelectorAll('input[name="chkBox"]')).forEach(row => {
            if (row.checked) {
                arr.push(row.value);
            }
        });

        if (arr.length === 0) {
            alert("복구할 신청서를 선택해주세요.");
            return false;
        }

        if (confirm("해당 신청서를 복구하시겠습니까?")) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "put",
                url: "/adm/v1/boards/restore",
                data: {
                    'arr' : arr
                },
                success: function(res) {
                    if (res.result === 'success') {
                        location.reload();
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

    function deleteBoard(board_id) {
        let arr = [];
        arr.push(board_id);
        deleteAPI(arr);
    }

    function deleteAPI(arr) {
        if (confirm("해당 신청서를 삭제하시겠습니까?")) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "delete",
                url: "/adm/v1/boards/delete",
                data: {
                    'arr' : arr
                },
                success: function(res) {
                    if (res.result === 'success') {
                        location.reload();
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

    function deleteBoards() {
        let arr = [];
        Array.from(document.querySelectorAll('input[name="chkBox"]')).forEach(row => {
            if (row.checked) {
                arr.push(row.value);
            }
        });

        if (arr.length === 0) {
            alert("삭제할 신청서를 선택해주세요.");
            return false;
        }
        deleteAPI(arr);
    }
</script>
</html>
