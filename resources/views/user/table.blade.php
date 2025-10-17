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

    <!-- js -->
    <script src="/public/js/jquery-3.6.1.min.js"></script>
    <script src="/public/js/user.common.js"></script>
    <script>

    </script>
</head>

<body id="page_table"><input type="hidden" id="input_page" value="table">
    <main>
        <h2>단가표</h2>
        <p style="padding: 10px 0; text-align: right;">VAT 포함</p>
        <table class="tb_main">
            <colgroup>
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
            </colgroup>
            <thead>
                <tr>
                    <th rowspan="2">지역</th>
                    <th rowspan="2">유형</th>
                    <th rowspan="2">구분</th>
                    <th rowspan="2">금액(VAT포함)</th>
                    <th rowspan="2">기준</th>
                </tr>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="8">전국</td>
                    <td rowspan="8">입주민 동의서</td>
                    <td>9세대 이하</td>
                    <td>110,000원</td>
                    <td rowspan="8">일반적인 아파트</td>
                </tr>
                <tr>
                    <td>59세대 이하</td>
                    <td>165,000원</td>
                </tr>
                <tr>
                    <td>79세대 이하</td>
                    <td>220,000원</td>
                </tr>
                <tr>
                    <td>99세대 이하</td>
                    <td>275,000원</td>
                </tr>
                <tr>
                    <td>129세대 이하</td>
                    <td>330,000원</td>
                </tr>
                <tr>
                    <td>159세대 이하</td>
                    <td>385,000원</td>
                </tr>
                <tr>
                    <td>189세대 이하</td>
                    <td>440,000원</td>
                </tr>
                <tr>
                    <td>190세대 이상</td>
                    <td>별도문의</td>
                </tr>
                <tr>
                    <td rowspan="6">전국</td>
                    <td rowspan="6">보양</td>
                    <td>하프보양</td>
                    <td>88,000원</td>
                    <td rowspan="3">승강기 17인승 이하</td>
                </tr>
                <tr>
                    <td>준보양</td>
                    <td>110,000원</td>
                </tr>
                <tr>
                    <td>올보양</td>
                    <td>165,000원</td>
                </tr>
                <tr>
                    <td>바닥,벽</td>
                    <td>5,500원</td>
                    <td>실내 추가시</td>
                </tr>
                <tr>
                    <td>잠(삼방틀)</td>
                    <td>22,000원</td>
                    <td>기타층 추가시</td>
                </tr>
                <tr>
                    <td>커버링 보양</td>
                    <td>44,000원</td>
                    <td>1롤(2.7mX20m)</td>
                </tr>
                <tr>
                    <td rowspan="4">전국</td>
                    <td rowspan="4">보양 탈거</td>
                    <td>승강기</td>
                    <td>55,000원</td>
                    <td>인승 무관</td>
                </tr>
                <tr>
                    <td>개소당 추가</td>
                    <td>33,000원</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>바닥,벽</td>
                    <td>2,200원</td>
                    <td>승강기와 함께 의뢰시</td>
                </tr>
                <tr>
                    <td>바닥,벽(25장미만)</td>
                    <td>55,000원</td>
                    <td>별건 의뢰시</td>
                </tr>
                <tr>
                    <td rowspan="2">전국</td>
                    <td rowspan="2">행위허가</td>
                    <td>아파트</td>
                    <td>440,000</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>주상복합/빌라</td>
                    <td>880,000</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="5">전국</td>
                    <td rowspan="5">사용검사</td>
                    <td>방화판 판매</td>
                    <td>33,000원</td>
                    <td>자재만</td>
                </tr>
                <tr>
                    <td>방화판 시공</td>
                    <td>55,000원</td>
                    <td>실측+자재+시공</td>
                </tr>
                <tr>
                    <td>방화유리 시공</td>
                    <td>180,000원</td>
                    <td>실측+자재+시공</td>
                </tr>
                <tr>
                    <td>갑종방화문 판매</td>
                    <td>770,000원</td>
                    <td>자재만</td>
                </tr>
                <tr>
                    <td>갑종방화문 시공</td>
                    <td>1,320,000원</td>
                    <td>실측+자재+시공</td>
                </tr>
                <!-- 2025.10.14 강동위 추가 - 방충망 시공 및 종합청소 서비스 추가 -->
                <!--
            <tr>
                <td rowspan="12">전국</td>
                <td rowspan="12">방충망시공(유형별)</td>
                <td rowspan="4">대 1000X2100(mm)</br>거실,발코니</br>(전창)</td>
                <td>55,000원</td>
                <td>알루미늄 방충망</td>
            </tr>
            <tr>
                <td>66,000원</td>
                <td>섬유 미세 방충망</td>
            </tr>
            <tr>
                <td>77,000원</td>
                <td>스텐레스 방충망</td>
            </tr>
            <tr>
                <td>99,000원</td>
                <td>블랙 스텐레스 방충망</td>
            </tr>
            <tr>
                <td rowspan="4">중 1000X1500(mm)</br>방</br>(반창)</td>
                <td>44,000원</td>
                <td>알루미늄 방충망</td>
            </tr>
            <tr>
                <td>55,000원</td>
                <td>섬유 미세 방충망</td>
            </tr>
            <tr>
                <td>66,000원</td>
                <td>스텐레스 방충망</td>
            </tr>
            <tr>
                <td>77,000원</td>
                <td>블랙 스텐레스 방충망</td>
            </tr>
            <tr>
                <td rowspan="4">소 700X700(mm)</br>욕실,주방</br>(반반창)</td>
                <td>22,000원</td>
                <td>알루미늄 방충망</td>
            </tr>
            <tr>
                <td>33,000원</td>
                <td>섬유 미세 방충망</td>
            </tr>
            <tr>
                <td>33,000원</td>
                <td>스텐레스 방충망</td>
            </tr>
            <tr>
                <td>55,000원</td>
                <td>블랙 스텐레스 방충망</td>
            </tr>
-->
                <tr>
                    <td rowspan="11">전국</td>
                    <td rowspan="11">종합청소</td>
                    <td>주거 일반 입주청소</td>
                    <td>15,000원</td>
                    <td>신축 또는 이사과정의 청소</td>
                </tr>
                <tr>
                    <td>주거 공사후 입주청소</td>
                    <td>18,000원</td>
                    <td>준공 청소가 되어 있지 않은 상태의 청소</td>
                </tr>
                <tr>
                    <td>주거 거주중 입주청소</td>
                    <td>18,000원</td>
                    <td>거주하고 있는 상태의 청소</td>
                </tr>
                <tr>
                    <td>사무공간 청소</td>
                    <td>300,000원 부터</td>
                    <td>사무공간 운영중 또는 이사 청소</td>
                </tr>
                <tr>
                    <td>외식업 매장 청소</td>
                    <td>400,000원 부터</td>
                    <td>식당, 카페 등 운영중 또는 입점 청소</td>
                </tr>
                <tr>
                    <td>유통업 매장 청소</td>
                    <td>600,000원 부터</td>
                    <td>대,중,소형 마트 운영중 또는 입점 청소</td>
                </tr>
                <tr>
                    <td>스크린 골프장 청소</td>
                    <td>140,000원 부터</td>
                    <td>운영중 또는 입점 청소</td>
                </tr>
                <tr>
                    <td>간판,어닝,유리 청소</td>
                    <td>150,000원 부터</td>
                    <td>상업공간 운영중 청소</td>
                </tr>
                <tr>
                    <td>외벽청소</td>
                    <td>1,000,000원 부터</td>
                    <td>대,중,소형 건축물 외관 청소</td>
                </tr>
                <tr>
                    <td>에어컨 청소</td>
                    <td>100,000원 부터</td>
                    <td>스탠드,벽걸이,천정형 정밀 청소</td>
                </tr>
                <tr>
                    <td>기타 가중이용시설 청소</td>
                    <td colspan="2">별도문의</td>
                </tr>
                <tr>
                    <td>기타</td>
                    <td>권역외 지역</td>
                    <td>출장비</td>
                    <td>80,000원</td>
                    <td>전국 도시지역외</td>
                </tr>
            </tbody>
        </table>
        <h2>방충망 시공 단가표</h2>
        <p style="padding: 10px 0; text-align: right;">VAT 포함</p>
        <table class="tb_main">
            <colgroup>
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
            </colgroup>
            <thead>
                <tr style="height:36px;">
                    <th rowspan="3">품목</td>
                    <th colspan="3">유형 및 금액</td>
                </tr>
                <tr style="height:36px;">
                    <th>대</br>1000 X 2100(mm)</td>
                    <th>중</br>1000 ~ 1700(mm)</td>
                    <th>소</br>700 ~ 700(mm)</td>
                </tr>
                <tr style="height:36px;">
                    <th>거실</br>(전창)</td>
                    <th>방</br>(반창)</td>
                    <th>욕실,주방</br>(반반창)</td>
                </tr>
                <tr>
                    <th style="height:36px;">알루미늄 방충망</td>
                    <td>55,000원</td>
                    <td>44,000원</td>
                    <td>22,000원</td>
                </tr>
                <tr>
                    <th style="height:36px;">섬유 미세 방충망</td>
                    <td>66,000원</td>
                    <td>55,000원</td>
                    <td>33,000원</td>
                </tr>
                <tr>
                    <th style="height:36px;">스텐레스 방충망</td>
                    <td>77,000원</td>
                    <td>66,000원</td>
                    <td>33,000원</td>
                </tr>
                <tr>
                    <th style="height:36px;">블랙 스텐레스 방충망</td>
                    <td>99,000원</td>
                    <td>77,000원</td>
                    <td>55,000원</td>
                </tr>
        </table>
        <i style="height: 30px"></i>
        <table class="tb_main">
            <colgroup>
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
                <col style="width: default;">
            </colgroup>
            <thead>
                <tr style="height:36px;">
                    <th rowspan="2">평형별</td>
                    <th colspan="4">소재별</td>
                </tr>
                <tr style="height:36px;">
                    <th>알루미늄</br>방충망</td>
                    <th>섬유 미세</br>방충망</td>
                    <th>스텐레스</br>방충망</td>
                    <th>블랙 스텐레스</br>방충망</td>
                </tr>
                <tr style="height:36px;">
                    <th>20평형대</th>
                    <td>250,000원</td>
                    <td>280,000원</td>
                    <td>300,000원</td>
                    <td>360,000원</td>
                </tr>
                <tr style="height:36px;">
                    <th>30평형대</th>
                    <td>300,000원</td>
                    <td>330,000원</td>
                    <td>360,000원</td>
                    <td>440,000원</td>
                </tr>
                <tr style="height:36px;">
                    <th>40평형대</th>
                    <td>360,000원</td>
                    <td>400,000원</td>
                    <td>440,000원</td>
                    <td>550,000원</td>
                </tr>
                <tr style="height:36px;">
                    <th>50평형대</th>
                    <td>420,000원</td>
                    <td>460,000원</td>
                    <td>520,000원</td>
                    <td>620,000원</td>
                </tr>
                <tr style="height:36px;">
                    <th>60평형대</th>
                    <td>480,000원</td>
                    <td>550,000원</td>
                    <td>600,000원</td>
                    <td>700,000원</td>
                </tr>

        </table>
        <i style="height: 30px"></i>
        <button type="button" class="btn_submit b_point" onclick="btn_goBack()">뒤로가기</button>
    </main>
    <nav class="fnb"></nav>
    <div class="pc bg_body"></div>
</body>

</html>