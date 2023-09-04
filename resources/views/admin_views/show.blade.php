@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('admin_views.index') }}"> Видео</a> / {{ $video->name }} </h4>
        <div class="row">
            <!-- Inline text elements -->
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Информация</h5>
                    <div class="card-body">
                        <hr class="m-0">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                @if (!empty($video->image))
                                    <img class="img-fluid rounded my-4" src="{{ Storage::url($video->image) }}"
                                        height="240" width="240" alt="User avatar">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" height="240" width="240"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <circle cx="7.499" cy="9.5" r="1.5"></circle>
                                        <path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path>
                                        <path
                                            d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <hr class="m-0">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Баннер:</small></td>
                                    <td class="py-3">
                                        @if (!empty($video->image_banner))
                                            <img class="img-fluid rounded my-4"
                                                src="{{ Storage::url($video->image_banner) }}" height="240" width="240"
                                                alt="User avatar">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" height="240" width="240"
                                                viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                <circle cx="7.499" cy="9.5" r="1.5"></circle>
                                                <path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path>
                                                <path
                                                    d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z">
                                                </path>
                                            </svg>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->name }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Kатегория:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">
                                            {{ $video->category->name ?? 'Без категории' }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Дата создания:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->created_at }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Допустимый минимальный
                                            возраст:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->minimum_age }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Партнерская
                                            компания:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->partner_company->name ?? 'Без партнерской компании' }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Дата события:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->event_date }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Ссылка на видео:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->video }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small
                                            class="text-light fw-semibold">Длительность(секунды):</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->duration }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="m-0">
                        <h5 class="card-header">Заработок</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Сумма проданных
                                            билетов:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $sum_tickets }}р.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <hr class="m-0">
                        <h5 class="card-header">График</h5>
                        <div class="card-body px-0">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel"
                                    style="position: relative;">
                                    <div class="d-flex p-4 pt-3">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="../assets/img/icons/unicons/wallet.png" alt="User">
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Total Balance</small>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0 me-1">$459.10</h6>
                                                <small class="text-success fw-semibold">
                                                    <i class="bx bx-chevron-up"></i>
                                                    42.9%
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="incomeChart" style="min-height: 215px;">
                                        <div id="apexchartsj7gc65gz"
                                            class="apexcharts-canvas apexchartsj7gc65gz apexcharts-theme-light"
                                            style="width: 445px; height: 215px;"><svg id="SvgjsSvg1473" width="445"
                                                height="215" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                                class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                                transform="translate(0, 0)" style="background: transparent;">
                                                <g id="SvgjsG1475" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(0, 10)">
                                                    <defs id="SvgjsDefs1474">
                                                        <clipPath id="gridRectMaskj7gc65gz">
                                                            <rect id="SvgjsRect1480" width="433.635009765625"
                                                                height="175.73" x="-3" y="-1"
                                                                rx="0" ry="0" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskj7gc65gz"></clipPath>
                                                        <clipPath id="nonForecastMaskj7gc65gz"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskj7gc65gz">
                                                            <rect id="SvgjsRect1481" width="455.635009765625"
                                                                height="201.73" x="-14" y="-14"
                                                                rx="0" ry="0" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#fff"></rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient1501" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1502" stop-opacity="0.5"
                                                                stop-color="rgba(105,108,255,0.5)" offset="0"></stop>
                                                            <stop id="SvgjsStop1503" stop-opacity="0.25"
                                                                stop-color="rgba(195,196,255,0.25)" offset="0.95"></stop>
                                                            <stop id="SvgjsStop1504" stop-opacity="0.25"
                                                                stop-color="rgba(195,196,255,0.25)" offset="1"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <line id="SvgjsLine1479" x1="427.135009765625" y1="0"
                                                        x2="427.135009765625" y2="173.73" stroke="#b6b6b6"
                                                        stroke-dasharray="3" stroke-linecap="butt"
                                                        class="apexcharts-xcrosshairs" x="427.135009765625"
                                                        y="0" width="1" height="173.73" fill="#b1b9c4"
                                                        filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                    <g id="SvgjsG1507" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1508" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"><text id="SvgjsText1510"
                                                                font-family="Helvetica, Arial, sans-serif" x="0"
                                                                y="202.73" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="13px"
                                                                font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1511"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1513"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="61.09071568080358" y="202.73" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="13px"
                                                                font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1514">Jan</tspan>
                                                                <title>Jan</title>
                                                            </text><text id="SvgjsText1516"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="122.18143136160717" y="202.73"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1517">Feb</tspan>
                                                                <title>Feb</title>
                                                            </text><text id="SvgjsText1519"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="183.27214704241072" y="202.73"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1520">Mar</tspan>
                                                                <title>Mar</title>
                                                            </text><text id="SvgjsText1522"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="244.36286272321428" y="202.73"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1523">Apr</tspan>
                                                                <title>Apr</title>
                                                            </text><text id="SvgjsText1525"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="305.45357840401783" y="202.73"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1526">May</tspan>
                                                                <title>May</title>
                                                            </text><text id="SvgjsText1528"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="366.5442940848214" y="202.73" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="13px"
                                                                font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1529">Jun</tspan>
                                                                <title>Jun</title>
                                                            </text><text id="SvgjsText1531"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="427.63500976562494" y="202.73"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1acb8"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1532">Jul</tspan>
                                                                <title>Jul</title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG1535" class="apexcharts-grid">
                                                        <g id="SvgjsG1536" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine1538" x1="0" y1="0"
                                                                x2="427.635009765625" y2="0" stroke="#eceef1"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1539" x1="0" y1="43.4325"
                                                                x2="427.635009765625" y2="43.4325" stroke="#eceef1"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1540" x1="0" y1="86.865"
                                                                x2="427.635009765625" y2="86.865" stroke="#eceef1"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1541" x1="0"
                                                                y1="130.29749999999999" x2="427.635009765625"
                                                                y2="130.29749999999999" stroke="#eceef1"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1542" x1="0" y1="173.73"
                                                                x2="427.635009765625" y2="173.73" stroke="#eceef1"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1537" class="apexcharts-gridlines-vertical"></g>
                                                        <line id="SvgjsLine1544" x1="0" y1="173.73"
                                                            x2="427.635009765625" y2="173.73" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        <line id="SvgjsLine1543" x1="0" y1="1"
                                                            x2="0" y2="173.73" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    </g>
                                                    <g id="SvgjsG1482"
                                                        class="apexcharts-area-series apexcharts-plot-series">
                                                        <g id="SvgjsG1483" class="apexcharts-series"
                                                            seriesName="seriesx1" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1505"
                                                                d="M 0 173.73L 0 112.92450000000001C 21.38175048828125 112.92450000000001 39.70896519252232 125.95425 61.09071568080357 125.95425C 82.47246616908481 125.95425 100.79968087332588 86.86500000000001 122.18143136160714 86.86500000000001C 143.5631818498884 86.86500000000001 161.89039655412947 121.611 183.27214704241072 121.611C 204.65389753069195 121.611 222.98111223493305 34.74600000000001 244.36286272321428 34.74600000000001C 265.7446132114955 34.74600000000001 284.0718279157366 104.238 305.45357840401783 104.238C 326.8353288922991 104.238 345.16254359654016 65.14875 366.54429408482144 65.14875C 387.9260445731027 65.14875 406.2532592773438 91.20825 427.635009765625 91.20825C 427.635009765625 91.20825 427.635009765625 91.20825 427.635009765625 173.73M 427.635009765625 91.20825z"
                                                                fill="url(#SvgjsLinearGradient1501)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMaskj7gc65gz)"
                                                                pathTo="M 0 173.73L 0 112.92450000000001C 21.38175048828125 112.92450000000001 39.70896519252232 125.95425 61.09071568080357 125.95425C 82.47246616908481 125.95425 100.79968087332588 86.86500000000001 122.18143136160714 86.86500000000001C 143.5631818498884 86.86500000000001 161.89039655412947 121.611 183.27214704241072 121.611C 204.65389753069195 121.611 222.98111223493305 34.74600000000001 244.36286272321428 34.74600000000001C 265.7446132114955 34.74600000000001 284.0718279157366 104.238 305.45357840401783 104.238C 326.8353288922991 104.238 345.16254359654016 65.14875 366.54429408482144 65.14875C 387.9260445731027 65.14875 406.2532592773438 91.20825 427.635009765625 91.20825C 427.635009765625 91.20825 427.635009765625 91.20825 427.635009765625 173.73M 427.635009765625 91.20825z"
                                                                pathFrom="M -1 217.1625L -1 217.1625L 61.09071568080357 217.1625L 122.18143136160714 217.1625L 183.27214704241072 217.1625L 244.36286272321428 217.1625L 305.45357840401783 217.1625L 366.54429408482144 217.1625L 427.635009765625 217.1625">
                                                            </path>
                                                            <path id="SvgjsPath1506"
                                                                d="M 0 112.92450000000001C 21.38175048828125 112.92450000000001 39.70896519252232 125.95425 61.09071568080357 125.95425C 82.47246616908481 125.95425 100.79968087332588 86.86500000000001 122.18143136160714 86.86500000000001C 143.5631818498884 86.86500000000001 161.89039655412947 121.611 183.27214704241072 121.611C 204.65389753069195 121.611 222.98111223493305 34.74600000000001 244.36286272321428 34.74600000000001C 265.7446132114955 34.74600000000001 284.0718279157366 104.238 305.45357840401783 104.238C 326.8353288922991 104.238 345.16254359654016 65.14875 366.54429408482144 65.14875C 387.9260445731027 65.14875 406.2532592773438 91.20825 427.635009765625 91.20825"
                                                                fill="none" fill-opacity="1" stroke="#696cff"
                                                                stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMaskj7gc65gz)"
                                                                pathTo="M 0 112.92450000000001C 21.38175048828125 112.92450000000001 39.70896519252232 125.95425 61.09071568080357 125.95425C 82.47246616908481 125.95425 100.79968087332588 86.86500000000001 122.18143136160714 86.86500000000001C 143.5631818498884 86.86500000000001 161.89039655412947 121.611 183.27214704241072 121.611C 204.65389753069195 121.611 222.98111223493305 34.74600000000001 244.36286272321428 34.74600000000001C 265.7446132114955 34.74600000000001 284.0718279157366 104.238 305.45357840401783 104.238C 326.8353288922991 104.238 345.16254359654016 65.14875 366.54429408482144 65.14875C 387.9260445731027 65.14875 406.2532592773438 91.20825 427.635009765625 91.20825"
                                                                pathFrom="M -1 217.1625L -1 217.1625L 61.09071568080357 217.1625L 122.18143136160714 217.1625L 183.27214704241072 217.1625L 244.36286272321428 217.1625L 305.45357840401783 217.1625L 366.54429408482144 217.1625L 427.635009765625 217.1625">
                                                            </path>
                                                            <g id="SvgjsG1484" class="apexcharts-series-markers-wrap"
                                                                data:realIndex="0">
                                                                <g id="SvgjsG1486" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1487" r="6"
                                                                        cx="0" cy="112.92450000000001"
                                                                        class="apexcharts-marker no-pointer-events wlsa204gv"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="0"
                                                                        j="0" index="0"
                                                                        default-marker-size="6"></circle>
                                                                    <circle id="SvgjsCircle1488" r="6"
                                                                        cx="61.09071568080357" cy="125.95425"
                                                                        class="apexcharts-marker no-pointer-events wf0klyrnx"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="1"
                                                                        j="1" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1489" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1490" r="6"
                                                                        cx="122.18143136160714" cy="86.86500000000001"
                                                                        class="apexcharts-marker no-pointer-events wq286ue7r"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="2"
                                                                        j="2" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1491" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1492" r="6"
                                                                        cx="183.27214704241072" cy="121.611"
                                                                        class="apexcharts-marker no-pointer-events wlkv3nfux"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="3"
                                                                        j="3" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1493" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1494" r="6"
                                                                        cx="244.36286272321428" cy="34.74600000000001"
                                                                        class="apexcharts-marker no-pointer-events wfrj8trodk"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="4"
                                                                        j="4" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1495" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1496" r="6"
                                                                        cx="305.45357840401783" cy="104.238"
                                                                        class="apexcharts-marker no-pointer-events wmnqceu3h"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="5"
                                                                        j="5" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1497" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1498" r="6"
                                                                        cx="366.54429408482144" cy="65.14875"
                                                                        class="apexcharts-marker no-pointer-events wfr1exj0b"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="6"
                                                                        j="6" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG1499" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMaskj7gc65gz)">
                                                                    <circle id="SvgjsCircle1500" r="6"
                                                                        cx="427.635009765625" cy="91.20825"
                                                                        class="apexcharts-marker no-pointer-events wxpbspc47g"
                                                                        stroke="#696cff" fill="#ffffff" fill-opacity="1"
                                                                        stroke-width="4" stroke-opacity="0.9"
                                                                        rel="7" j="7" index="0"
                                                                        default-marker-size="6"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1485" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine1545" x1="0" y1="0"
                                                        x2="427.635009765625" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1546" x1="0" y1="0"
                                                        x2="427.635009765625" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1547" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1548" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1549" class="apexcharts-point-annotations"></g>
                                                    <rect id="SvgjsRect1550" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect">
                                                    </rect>
                                                    <rect id="SvgjsRect1551" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe"
                                                        class="apexcharts-selection-rect"></rect>
                                                </g>
                                                <rect id="SvgjsRect1478" width="0" height="0" x="0"
                                                    y="0" rx="0" ry="0" opacity="1"
                                                    stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe">
                                                </rect>
                                                <g id="SvgjsG1533" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-8, 0)">
                                                    <g id="SvgjsG1534" class="apexcharts-yaxis-texts-g"></g>
                                                </g>
                                                <g id="SvgjsG1476" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 107.5px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light"
                                                style="left: 305.635px; top: 94.7083px;">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Jul
                                                </div>
                                                <div class="apexcharts-tooltip-series-group apexcharts-active"
                                                    style="order: 1; display: flex;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(105, 108, 255);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label">series-1:
                                                            </span><span class="apexcharts-tooltip-text-y-value">29</span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"
                                                style="left: 406.541px; top: 185.73px;">
                                                <div class="apexcharts-xaxistooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 19.1875px;">
                                                    Jul</div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center pt-4 gap-2">
                                        <div class="flex-shrink-0" style="position: relative;">
                                            <div id="expensesOfWeek" style="min-height: 57.7px;">
                                                <div id="apexcharts1ye9pbo5h"
                                                    class="apexcharts-canvas apexcharts1ye9pbo5h apexcharts-theme-light"
                                                    style="width: 60px; height: 57.7px;"><svg id="SvgjsSvg1552"
                                                        width="60" height="57.7" xmlns="http://www.w3.org/2000/svg"
                                                        version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                        xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                        style="background: transparent;">
                                                        <g id="SvgjsG1554" class="apexcharts-inner apexcharts-graphical"
                                                            transform="translate(-10, -10)">
                                                            <defs id="SvgjsDefs1553">
                                                                <clipPath id="gridRectMask1ye9pbo5h">
                                                                    <rect id="SvgjsRect1556" width="86"
                                                                        height="87" x="-3" y="-1"
                                                                        rx="0" ry="0" opacity="1"
                                                                        stroke-width="0" stroke="none"
                                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="forecastMask1ye9pbo5h"></clipPath>
                                                                <clipPath id="nonForecastMask1ye9pbo5h"></clipPath>
                                                                <clipPath id="gridRectMarkerMask1ye9pbo5h">
                                                                    <rect id="SvgjsRect1557" width="84"
                                                                        height="89" x="-2" y="-2"
                                                                        rx="0" ry="0" opacity="1"
                                                                        stroke-width="0" stroke="none"
                                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                            </defs>
                                                            <g id="SvgjsG1558" class="apexcharts-radialbar">
                                                                <g id="SvgjsG1559">
                                                                    <g id="SvgjsG1560" class="apexcharts-tracks">
                                                                        <g id="SvgjsG1561"
                                                                            class="apexcharts-radialbar-track apexcharts-track"
                                                                            rel="1">
                                                                            <path id="apexcharts-radialbarTrack-0"
                                                                                d="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 39.99617740968999 18.098171065291247"
                                                                                fill="none" fill-opacity="1"
                                                                                stroke="rgba(236,238,241,0.85)"
                                                                                stroke-opacity="1" stroke-linecap="round"
                                                                                stroke-width="2.0408536585365864"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area"
                                                                                data:pathOrig="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 39.99617740968999 18.098171065291247">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1563">
                                                                        <g id="SvgjsG1567"
                                                                            class="apexcharts-series apexcharts-radial-series"
                                                                            seriesName="seriesx1" rel="1"
                                                                            data:realIndex="0">
                                                                            <path id="SvgjsPath1568"
                                                                                d="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 22.2810479140526 52.873572242130095"
                                                                                fill="none" fill-opacity="0.85"
                                                                                stroke="rgba(105,108,255,0.85)"
                                                                                stroke-opacity="1" stroke-linecap="round"
                                                                                stroke-width="4.081707317073173"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                                data:angle="234" data:value="65"
                                                                                index="0" j="0"
                                                                                data:pathOrig="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 22.2810479140526 52.873572242130095">
                                                                            </path>
                                                                        </g>
                                                                        <circle id="SvgjsCircle1564"
                                                                            r="18.881402439024395" cx="40"
                                                                            cy="40"
                                                                            class="apexcharts-radialbar-hollow"
                                                                            fill="transparent"></circle>
                                                                        <g id="SvgjsG1565"
                                                                            class="apexcharts-datalabels-group"
                                                                            transform="translate(0, 0) scale(1)"
                                                                            style="opacity: 1;"><text id="SvgjsText1566"
                                                                                font-family="Helvetica, Arial, sans-serif"
                                                                                x="40" y="45"
                                                                                text-anchor="middle"
                                                                                dominant-baseline="auto" font-size="13px"
                                                                                font-weight="400" fill="#697a8d"
                                                                                class="apexcharts-text apexcharts-datalabel-value"
                                                                                style="font-family: Helvetica, Arial, sans-serif;">$65</text>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <line id="SvgjsLine1569" x1="0" y1="0"
                                                                x2="80" y2="0" stroke="#b6b6b6"
                                                                stroke-dasharray="0" stroke-width="1"
                                                                stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                                            </line>
                                                            <line id="SvgjsLine1570" x1="0" y1="0"
                                                                x2="80" y2="0" stroke-dasharray="0"
                                                                stroke-width="0" stroke-linecap="butt"
                                                                class="apexcharts-ycrosshairs-hidden"></line>
                                                        </g>
                                                        <g id="SvgjsG1555" class="apexcharts-annotations"></g>
                                                    </svg>
                                                    <div class="apexcharts-legend"></div>
                                                </div>
                                            </div>
                                            <div class="resize-triggers">
                                                <div class="expand-trigger">
                                                    <div style="width: 61px; height: 59px;"></div>
                                                </div>
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="mb-n1 mt-1">Expenses This Week</p>
                                            <small class="text-muted">$39 less than last week</small>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 446px; height: 377px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <hr class="m-0">
                        <h5 class="card-header">Список просмотров</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Секунд просмотрено</th>
                                    <th>Клиент(Имя)</th>
                                    <th>Клиент(Почта)</th>
                                    <th>Страна</th>
                                    <th>Дата</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($views as $view)
                                    <tr>
                                        <td>{{ $view->seconds_viewed }}</td>
                                        <td>{{ $view->client->name ?? 'Данные отсутствуют' }}</td>
                                        <td>{{ $view->client->email ?? 'Данные отсутствуют'}}</td>
                                        <td>{{ $view->country->name ?? 'Данные отсутствуют' }}</td>
                                        <td>{{ $view->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger">По вашему запросу ничего не найдено.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        @if ($views->links()->paginator->hasPages())
                            <div class="demo-inline-spacing">
                                {{ $views->links() }}
                            </div>
                        @endif



                        <hr class="m-0">
                        <div class="row demo-vertical-spacing">
                            <div class="col">
                                <a class="btn btn-primary text-nowrap" href="{{ route('admin_views.index') }}">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
