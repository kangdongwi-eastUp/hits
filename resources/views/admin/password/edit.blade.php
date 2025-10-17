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

    <style>
        /* 비밀번호 변경 페이지 전용 스타일 */
        .wrap_contents form {
            max-width: 600px;
            /* 폼의 최대 너비를 900px로 제한 */
            margin: 0 auto;
            /* 폼을 중앙에 정렬 */
        }

        .tb_main th {
            text-align: left;
            padding-left: 20px;
            background-color: black;
            vertical-align: middle;
            height: 38px;
        }

        .tb_main td {
            padding: 15px 20px;
            height: 38px;
        }

        .tb_main input[type="password"] {
            width: 350px;
            height: 35px;
            border: 1px solid #ddd;
            padding: 0 10px;
            border-radius: 4px;
        }

        .tb_main input[type="password"]:focus {
            border-color: #333;
            outline: none;
        }

        .error_message {
            display: block;
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 8px;
        }

        .password-rules-info {
            font-size: 0.9em;
            color: #6c757d;
            margin-top: 8px;
        }
    </style>
</head>

<body><input type="hidden" id="input_page" value="password">
    <header></header>
    <main class="minWidth2">
        <h2>비밀번호 변경</h2>
        <div class="wrap_contents">
            <div class="bx_btnTop">
                <p class="page_title">안전한 계정 관리를 위해 주기적으로 비밀번호를 변경해주세요.</p>
            </div>
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                @method('PUT')
                <table class="tb_main">
                    <colgroup>
                        <col width="200px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>현재 비밀번호</th>
                            <td>
                                <input type="password" id="current_password" name="current_password" placeholder="현재 비밀번호를 입력하세요" required>
                                @error('current_password')
                                <span class="error_message">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>새 비밀번호</th>
                            <td>
                                <input type="password" id="password" name="password" placeholder="새 비밀번호" required>
                                @error('password')
                                <span class="error_message">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>새 비밀번호 확인</th>
                            <td>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="새 비밀번호 확인" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="password-rules-info">비밀번호는 <strong>영문,숫자,특수기호를 조합하여 8자리이상 16자리 이하</strong>로 만들어 주세요.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="bx_btnBottom">
                    <button type="button" class="btn_cancel" onclick="location.href='/adm/boards'">취소</button>
                    <button type="submit" class="btn_able">비밀번호 변경</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>