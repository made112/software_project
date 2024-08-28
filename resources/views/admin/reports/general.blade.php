<!DOCTYPE html>
<html lang="ar" dir="ltr" data-dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        General Report
    </title>
    <!-- <link href="css/style.css" rel="stylesheet"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            background: #F5F6FA;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            padding: 0;
            width: 7.5in;
            background: #F5F6FA;
            font-family: 'Almarai', sans-serif;
        }

        .pdf {
            font-family: 'Almarai', sans-serif;
            position: relative;
            width: 100%;
            margin: auto;
            background: #F5F6FA;
            font-size: 10px;
        }

        .header {
            position: relative;
            color: #fff;
            background: #0E5299;
            padding: 16px;
        }

        .header .icon {
            position: absolute;
            content: "";
            bottom: 0;
            right: 0;
        }

        [dir="rtl"] .header .icon {
            right: auto;
            left: 0;
        }

        .header .title {
            font-family: 'Almarai';
            font-weight: 700;
            font-size: 18px;
            line-height: 36px;
            color: #F5F6FA;
            margin-bottom: 3px;
        }

        .header .info {
            font-family: 'Almarai';
            font-weight: 400;
            font-size: 11px;
            line-height: 12px;
            color: #F5F6FA;
        }

        .body {
            padding: 16px;
        }

        .d-felx {
            display: flex;
            width: 100%;
            gap: 11px;
            align-items: stretch;
            margin-bottom: 11px;
        }

        .d-felx:last-child {
            margin-bottom: 0;
        }

        .text-light {
            color: #939393;
        }

        .card {
            width: 100%;
            background: #FFFFFF;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.061);
            border-radius: 10px;
            padding: 13px;
        }

        .card .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            font-size: 12px;
            line-height: 16px;
            color: #303840;
        }

        .card .card-body .chart-box.chart-box-circle {
            width: 100px;
            height: 100px;
            margin: 1rem auto;
            overflow: hidden;
        }

        .card .card-body .chart-box.chart-box-circle canvas {
            width: 100%;
            height: 100%;
        }

        .card .card-body .chart-box.chart-box-bar {
            margin: 1rem auto;
            overflow: hidden;
            width: 100% !important;
        }

        .card .card-body .chart-box.chart-box-bar canvas {
            width: 100% !important;
        }

        .card .card-body .table {
            width: 100%;
        }

        .card .card-body .table tr td {
            font-weight: 400;
            font-size: 11px;
            line-height: 20px;
            color: #303840;
        }

        .card .card-body .table tr td .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #E6E9F4;
            display: inline-block;
            margin-inline-end: 10px;
        }

        .d-flex-3 .card {
            max-width: calc((100% / 3) - 5.5px);
        }

        .d-flex-2 .card {
            max-width: calc((100% / 2) - 5.5px);
        }

        .table-data {
            margin-top: 1rem;
        }

        .table-data tr th {
            font-weight: 400;
            font-size: 10px;
            line-height: 11px;
            color: #B5B5C3;
            text-align: center;
        }

        .table-data tr td:first-child,
        .table-data tr th:first-child {
            text-align: left;
        }

        [dir="rtl"] .table-data tr td:first-child,
        [dir="rtl"] .table-data tr th:first-child {
            text-align: right;
        }

        .table-data tr td {
            font-weight: 400;
            font-size: 12px;
            line-height: 11px;
            padding: 4px;
            color: #303840;
            text-align: center;
        }

        .table-data tr td:first-child {
            text-align: inherit;
        }

        .table-data tr:nth-child(odd) td {
            background: #F5F8FA;
        }

        .table-info {
            margin-top: 10px;
            text-align: center;
        }

        .table-info .title {
            font-weight: 400;
            font-size: 10px;
            text-align: center;
            color: #939393;
        }

        .table-info .count {
            font-weight: 700;
            font-size: 12px;
            text-align: center;
            color: #4D4F5C;
        }

        .table-info .parcentage {
            font-weight: 700;
            font-size: 10px;
            color: #4D4F5C;
        }

        .table-info .parcentage.up {
            color: #3CC480;
        }

        .table-info .parcentage.down {
            color: #FF4141;
        }
        .btn-download {
            position: fixed;
            left: 1rem;
            bottom: 1rem;
            width: 70px;
            height: 70px;
            line-height: 85px;
            text-align: center;
            border-radius: 50%;
            background-color: #0E5299;
            color: #fff;
        }
    </style>
</head>

<body>
<a href="javascript:void(0)" class="btn-download">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-download"
            viewBox="0 0 16 16">
            <path
                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"
                fill="#fff"/>
            <path
                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"
            fill="#fff"/>
    </svg>
</a>

<section class="pdf" id="pdf">
    <div class="header">
        <h1 class="title">Software Report</h1>
        <p class="date">{{ $from->toDateString() }}  -  {{ $to->toDateString() }}</p>
        <div class="icon">
            <svg width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.3">
                    <path
                        d="M36.7797 36.9094H30.3769C30.2908 36.9094 30.222 36.8407 30.222 36.7545V30.3518C30.222 30.2657 30.2908 30.1969 30.3769 30.1969H36.7797C36.8656 30.1969 36.9344 30.2657 36.9344 30.3518V36.7545C36.9344 36.8407 36.8656 36.9094 36.7797 36.9094Z"
                        fill="#62EDC2"/>
                    <path
                        d="M26.7132 36.9094H20.3107C20.2246 36.9094 20.1558 36.8407 20.1558 36.7545V30.3518C20.1558 30.2657 20.2246 30.1969 20.3107 30.1969H26.7132C26.7994 30.1969 26.8682 30.2657 26.8682 30.3518V36.7545C26.8682 36.8407 26.7994 36.9094 26.7132 36.9094Z"
                        fill="#FF0176"/>
                    <path
                        d="M47.4173 36.9094H41.0148C40.9286 36.9094 40.8599 36.8407 40.8599 36.7545V30.3518C40.8599 30.2657 40.9286 30.1969 41.0148 30.1969H47.4173C47.5035 30.1969 47.5723 30.2657 47.5723 30.3518V36.7545C47.5723 36.8407 47.5035 36.9094 47.4173 36.9094Z"
                        fill="#62EDC2"/>
                    <path
                        d="M26.7132 26.838H20.3107C20.2246 26.838 20.1558 26.7691 20.1558 26.6831V20.2804C20.1558 20.1944 20.2246 20.1255 20.3107 20.1255H26.7132C26.7994 20.1255 26.8682 20.1944 26.8682 20.2804V26.6831C26.8682 26.7691 26.7994 26.838 26.7132 26.838Z"
                        fill="#62EDC2"/>
                    <path
                        d="M16.6185 26.838H10.216C10.1298 26.838 10.061 26.7691 10.061 26.6831V20.2804C10.061 20.1944 10.1298 20.1255 10.216 20.1255H16.6185C16.7047 20.1255 16.7734 20.1944 16.7734 20.2804V26.6831C16.7734 26.7691 16.7047 26.838 16.6185 26.838Z"
                        fill="#62EDC2"/>
                    <path
                        d="M16.6427 16.7769H10.2402C10.154 16.7769 10.0853 16.7081 10.0853 16.622V10.2194C10.0853 10.1333 10.154 10.0645 10.2402 10.0645H16.6427C16.7289 10.0645 16.7977 10.1333 16.7977 10.2194V16.622C16.8065 16.7081 16.7289 16.7769 16.6427 16.7769Z"
                        fill="#FF0176"/>
                    <path
                        d="M6.55744 16.7769H0.154673C0.0687807 16.7769 0 16.7081 0 16.622V10.2194C0 10.1333 0.0687807 10.0645 0.154673 10.0645H6.55744C6.64334 10.0645 6.71241 10.1333 6.71241 10.2194V16.622C6.71241 16.7081 6.63478 16.7769 6.55744 16.7769Z"
                        fill="#62EDC2"/>
                    <path
                        d="M16.6427 6.71245H10.2402C10.154 6.71245 10.0853 6.64361 10.0853 6.55756V0.154897C10.0853 0.0688395 10.154 0 10.2402 0H16.6427C16.7289 0 16.7977 0.0688395 16.7977 0.154897V6.55756C16.8065 6.64361 16.7289 6.71245 16.6427 6.71245Z"
                        fill="#62EDC2"/>
                    <path
                        d="M6.55823 6.71246H0.155454C0.0695625 6.71246 0.000793457 6.64362 0.000793457 6.55755V0.154897C0.000793457 0.0688395 0.0695625 0 0.155454 0H6.55823C6.64442 0 6.7132 0.0688395 6.7132 0.154897V6.55755C6.7132 6.64362 6.63556 6.71246 6.55823 6.71246Z"
                        fill="#62EDC2"/>
                    <path
                        d="M67.5812 16.7769H61.1785C61.0923 16.7769 61.0235 16.7081 61.0235 16.622V10.2194C61.0235 10.1333 61.0923 10.0645 61.1785 10.0645H67.5812C67.6671 10.0645 67.7359 10.1333 67.7359 10.2194V16.622C67.7359 16.7081 67.6671 16.7769 67.5812 16.7769Z"
                        fill="#C769F9"/>
                    <path
                        d="M57.4855 16.7769H51.0828C50.9969 16.7769 50.9278 16.7081 50.9278 16.622V10.2194C50.9278 10.1333 50.9969 10.0645 51.0828 10.0645H57.4855C57.5714 10.0645 57.6405 10.1333 57.6405 10.2194V16.622C57.6405 16.7081 57.5714 16.7769 57.4855 16.7769Z"
                        fill="#62EDC2"/>
                    <path
                        d="M67.5812 6.71245H61.1785C61.0923 6.71245 61.0235 6.64361 61.0235 6.55756V0.154897C61.0235 0.0688395 61.0923 0 61.1785 0H67.5812C67.6671 0 67.7359 0.0688395 67.7359 0.154897V6.55756C67.7359 6.64361 67.6671 6.71245 67.5812 6.71245Z"
                        fill="#62EDC2"/>
                    <path
                        d="M57.4855 6.71245H51.0828C50.9969 6.71245 50.9278 6.64361 50.9278 6.55756V0.154897C50.9278 0.0688395 50.9969 0 51.0828 0H57.4855C57.5714 0 57.6405 0.0688395 57.6405 0.154897V6.55756C57.6405 6.64361 57.5714 6.71245 57.4855 6.71245Z"
                        fill="#2390F5"/>
                    <path
                        d="M57.5124 26.838H51.1096C51.0237 26.838 50.9547 26.7691 50.9547 26.6831V20.2804C50.9547 20.1944 51.0237 20.1255 51.1096 20.1255H57.5124C57.5983 20.1255 57.6674 20.1944 57.6674 20.2804V26.6831C57.6674 26.7691 57.5983 26.838 57.5124 26.838Z"
                        fill="#62EDC2"/>
                    <path
                        d="M47.4173 26.838H41.0148C40.9286 26.838 40.8599 26.7691 40.8599 26.6831V20.2804C40.8599 20.1944 40.9286 20.1255 41.0148 20.1255H47.4173C47.5035 20.1255 47.5723 20.1944 47.5723 20.2804V26.6831C47.5723 26.7691 47.5035 26.838 47.4173 26.838Z"
                        fill="#FF0176"/>
                    <path
                        d="M41.0148 40.2649H47.4173C47.5035 40.2649 47.5723 40.3336 47.5723 40.4195V46.8223C47.5723 46.9082 47.5035 46.9773 47.4173 46.9773H41.0148C40.9286 46.9773 40.8599 46.9082 40.8599 46.8223V40.4195C40.8599 40.3336 40.9286 40.2649 41.0148 40.2649Z"
                        fill="#62EDC2"/>
                    <path
                        d="M51.1096 40.2649H57.5124C57.5983 40.2649 57.6674 40.3336 57.6674 40.4195V46.8223C57.6674 46.9082 57.5983 46.9773 57.5124 46.9773H51.1096C51.0237 46.9773 50.9547 46.9082 50.9547 46.8223V40.4195C50.9547 40.3336 51.0237 40.2649 51.1096 40.2649Z"
                        fill="#FF0176"/>
                    <path
                        d="M51.0828 50.3363H57.4855C57.5714 50.3363 57.6405 50.4054 57.6405 50.4912V56.894C57.6405 56.9799 57.5714 57.049 57.4855 57.049H51.0828C50.9969 57.049 50.9278 56.9799 50.9278 56.894V50.4912C50.9278 50.4054 50.9969 50.3363 51.0828 50.3363Z"
                        fill="#62EDC2"/>
                    <path
                        d="M61.1785 50.3363H67.5812C67.6671 50.3363 67.7359 50.4054 67.7359 50.4912V56.894C67.7359 56.9799 67.6671 57.049 67.5812 57.049H61.1785C61.0923 57.049 61.0235 56.9799 61.0235 56.894V50.4912C61.0235 50.4054 61.0923 50.3363 61.1785 50.3363Z"
                        fill="#FFE164"/>
                    <path
                        d="M51.0828 60.3973H57.4855C57.5714 60.3973 57.6405 60.4661 57.6405 60.5519V66.9547C57.6405 67.0409 57.5714 67.1097 57.4855 67.1097H51.0828C50.9969 67.1097 50.9278 67.0409 50.9278 66.9547V60.5519C50.9278 60.4661 50.9969 60.3973 51.0828 60.3973Z"
                        fill="#62EDC2"/>
                    <path
                        d="M61.1785 60.3973H67.5812C67.6671 60.3973 67.7359 60.4661 67.7359 60.5519V66.9547C67.7359 67.0409 67.6671 67.1097 67.5812 67.1097H61.1785C61.0923 67.1097 61.0235 67.0409 61.0235 66.9547V60.5519C61.0235 60.4661 61.0923 60.3973 61.1785 60.3973Z"
                        fill="#62EDC2"/>
                    <path
                        d="M0.154673 50.3363H6.55744C6.64334 50.3363 6.71241 50.4054 6.71241 50.4912V56.894C6.71241 56.9799 6.64334 57.049 6.55744 57.049H0.154673C0.0687807 57.049 0 56.9799 0 56.894V50.4912C0 50.4054 0.0687807 50.3363 0.154673 50.3363Z"
                        fill="#2390F5"/>
                    <path
                        d="M10.2497 50.3363H16.6525C16.7384 50.3363 16.8074 50.4054 16.8074 50.4912V56.894C16.8074 56.9799 16.7384 57.049 16.6525 57.049H10.2497C10.1638 57.049 10.0947 56.9799 10.0947 56.894V50.4912C10.0947 50.4054 10.1638 50.3363 10.2497 50.3363Z"
                        fill="#C769F9"/>
                    <path
                        d="M0.154673 60.3973H6.55744C6.64334 60.3973 6.71241 60.4661 6.71241 60.5519V66.9547C6.71241 67.0409 6.64334 67.1097 6.55744 67.1097H0.154673C0.0687807 67.1097 0 67.0409 0 66.9547V60.5519C0 60.4661 0.0687807 60.3973 0.154673 60.3973Z"
                        fill="#62EDC2"/>
                    <path
                        d="M10.2497 60.3973H16.6525C16.7384 60.3973 16.8074 60.4661 16.8074 60.5519V66.9547C16.8074 67.0409 16.7384 67.1097 16.6525 67.1097H10.2497C10.1638 67.1097 10.0947 67.0409 10.0947 66.9547V60.5519C10.0947 60.4661 10.1638 60.3973 10.2497 60.3973Z"
                        fill="#62EDC2"/>
                    <path
                        d="M10.216 40.2649H16.6185C16.7047 40.2649 16.7734 40.3336 16.7734 40.4195V46.8223C16.7734 46.9082 16.7047 46.9773 16.6185 46.9773H10.216C10.1298 46.9773 10.061 46.9082 10.061 46.8223V40.4195C10.061 40.3336 10.1384 40.2649 10.216 40.2649Z"
                        fill="#FFE164"/>
                    <path
                        d="M20.3107 40.2649H26.7132C26.7994 40.2649 26.8682 40.3336 26.8682 40.4195V46.8223C26.8682 46.9082 26.7994 46.9773 26.7132 46.9773H20.3107C20.2246 46.9773 20.1558 46.9082 20.1558 46.8223V40.4195C20.1558 40.3336 20.2331 40.2649 20.3107 40.2649Z"
                        fill="#62EDC2"/>
                </g>
            </svg>
        </div>
    </div>
    <div class="body">
        <div class="d-felx d-flex-3">
            {{-- Start Products --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Products</div>
                    <div class="count">{{ $products }}</div>
                </div>
                <div class="card-body">
                    <div class="chart-box chart-box-circle">
                        <canvas id="chart-1" width="70" height="70"></canvas>
                    </div>
                    <div class="chart-data">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="dot" style="background-color: #0E5299;"></span>
                                    <span class="title">Active</span>
                                    <span id="reportActiveProduct" data-value="{{ $active_products }}"></span>
                                </td>
                                <td>
                                    {{ $active_products }}
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($products > 0)
                                            {{ round ( ( $active_products / $products ) * 100, 2 ) }} %
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="dot"></span>
                                    <span class="title">Inactive</span>
                                    <span id="reportInactiveProduct" data-value="{{ $inactive_products }}"></span>
                                </td>
                                <td>
                                    {{ $inactive_products }}
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($products > 0)
                                            {{ round ( ( $inactive_products / $products ) * 100, 2 ) }} %
                                         @else
                                            {{ '0' }}
                                        @endif

                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Products --}}

            {{-- Start Companies --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Companies</div>
                    <div class="count">{{ $companies }}</div>
                </div>
                <div class="card-body">
                    <div class="chart-box chart-box-circle">
                        <canvas id="chart-2" width="70" height="70"></canvas>
                    </div>
                    <div class="chart-data">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="dot" style="background-color: #0E5299;"></span>
                                    <span class="title">Active</span>
                                    <span id="reportActiveCompanies" data-value="{{ $active_companies }}"></span>
                                </td>
                                <td>
                                    {{ $active_companies }}
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($companies > 0)
                                            {{ round( ($active_companies / $companies) * 100 , 2) }} %
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="dot"></span>
                                    <span class="title">Inactive</span>
                                    <span id="reportInactiveCompanies" data-value="{{ $inactive_companies }}"></span>
                                </td>
                                <td>
                                    @if($companies > 0)
                                        {{ $inactive_companies }}
                                    @else
                                        {{ '0' }}
                                    @endif
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($companies > 0)
                                            {{ round( ($inactive_companies / $companies) * 100 , 2) }} %
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Companies --}}

            {{-- Start Licenses --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Licenses</div>
                    <div class="count">
                        {{ $licenses }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-box chart-box-circle">
                        <canvas id="chart-3" width="70" height="70"></canvas>
                    </div>
                    <div class="chart-data">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="dot" style="background-color: #0E5299;"></span>
                                    <span class="title">Active</span>
                                    <span id="reportActiveLicenses" data-value="{{ $active_licenses }}"></span>
                                </td>
                                <td>
                                    {{ $active_licenses }}
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($licenses > 0)
                                            {{ round( ($active_licenses / $licenses ) * 100, 2) }} %
                                        @else
                                            {{ '0' }}
                                        @endif

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="dot"></span>
                                    <span class="title">Inactive</span>
                                    <span id="reportInactiveLicenses" data-value="{{ $inactive_licenses }}"></span>
                                </td>
                                <td>
                                    {{ $inactive_licenses }}
                                </td>
                                <td>
                                    <span class="text-light">
                                        @if($licenses > 0)
                                            {{ round( ($inactive_licenses / $licenses ) * 100, 2) }} %
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="dot" style="background-color: #FFCC5A;"></span>
                                    <span class="title">Expired</span>
                                    <span id="reportExpiredLicenses" data-value="{{ $expired_licenses }}">Expired</span>
                                </td>
                                <td>
                                    {{ $expired_licenses }}
                                </td>
                                <td>
                                    <spane class="text-light">
                                        @if($licenses > 0)
                                            {{ round( ($expired_licenses / $licenses ) * 100, 2) }} %
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </spane>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Licenses --}}

        </div>


        <div class="d-felx d-flex-2">

            {{-- Start Active Companies --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Active Companies</div>
                    <div class="count">
                        {{ $companies }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-data">
                        <table class="table ">
                            <tr>
                                <td>
                                    <div class="table-info">
                                        <div class="title">Daily</div>
                                        <div class="count">
                                            @if($avg != null)
                                                {{ round($avg, 2) }}
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </div>
                                        <div class="percentage up">
                                            <svg width="7" height="8" viewBox="0 0 7 8" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.74088 3.3194L2.74088 6.92295C2.73479 7.0191 2.75026 7.11539 2.78626 7.20545C2.82226 7.29551 2.87797 7.3773 2.94973 7.44541C3.02148 7.51352 3.10763 7.56641 3.20251 7.60059C3.29738 7.63476 3.39881 7.64944 3.5001 7.64366C3.60139 7.64944 3.70282 7.63476 3.79769 7.60059C3.89256 7.56641 3.97872 7.51352 4.05047 7.44541C4.12223 7.3773 4.17794 7.29551 4.21394 7.20545C4.24994 7.11539 4.26541 7.0191 4.25932 6.92295V3.3194H6.53699L3.5001 0.436557L0.463212 3.3194L2.74088 3.3194Z"
                                                    fill="#3CC480"/>
                                            </svg>

                                            13.8%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-info">
                                        <div class="title">Weekly</div>
                                        <div class="count">
                                            @if( $w_active_companies != null )
                                                {{ round($w_active_companies, 2) }}
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </div>
                                        <div class="percentage down">
                                            <svg width="7" height="8" viewBox="0 0 7 8" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.32044 4.63985V1.1358C4.32636 1.04231 4.31132 0.94868 4.27632 0.861106C4.24131 0.773533 4.18713 0.694005 4.11736 0.627773C4.04759 0.561541 3.96381 0.510112 3.87156 0.476881C3.77931 0.44365 3.68068 0.429373 3.58218 0.434993C3.48369 0.429373 3.38506 0.44365 3.29281 0.476881C3.20055 0.510112 3.11678 0.561541 3.04701 0.627773C2.97723 0.694005 2.92306 0.773533 2.88805 0.861106C2.85304 0.94868 2.838 1.04231 2.84392 1.1358V4.63985H0.62915L3.58218 7.44309L6.53521 4.63985H4.32044Z"
                                                    fill="#FF4141"/>
                                            </svg>

                                            13.8%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-info">
                                        <div class="title">Monthly</div>
                                        <div class="count">
                                            @if($m_active_companies != null )
                                                {{ round($m_active_companies, 2) }}
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </div>
                                        <div class="percentage up">
                                            <svg width="7" height="8" viewBox="0 0 7 8" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.74088 3.3194L2.74088 6.92295C2.73479 7.0191 2.75026 7.11539 2.78626 7.20545C2.82226 7.29551 2.87797 7.3773 2.94973 7.44541C3.02148 7.51352 3.10763 7.56641 3.20251 7.60059C3.29738 7.63476 3.39881 7.64944 3.5001 7.64366C3.60139 7.64944 3.70282 7.63476 3.79769 7.60059C3.89256 7.56641 3.97872 7.51352 4.05047 7.44541C4.12223 7.3773 4.17794 7.29551 4.21394 7.20545C4.24994 7.11539 4.26541 7.0191 4.25932 6.92295V3.3194H6.53699L3.5001 0.436557L0.463212 3.3194L2.74088 3.3194Z"
                                                    fill="#3CC480"/>
                                            </svg>

                                            13.8%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="chart-box chart-box-bar">
                        <canvas id="chart-4"></canvas>
                    </div>
                </div>
            </div>
            {{-- End Active Companies --}}

            {{-- Start Activations --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Activations</div>
                </div>
                <div class="card-body">
                    <div class="chart-box chart-box-bar" style="margin-top: 80px;">
                        <canvas id="chart-5"></canvas>
                    </div>
                </div>
            </div>
            {{-- End Activations --}}
        </div>

        <div class="d-felx d-flex-2">
            {{-- Start Top Companies --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Last Added Licenses</div>
                </div>
                <div class="card-body">
                    <div class="chart-data">
                        <table class="table table-data">
                            <tr>
                                <th>
                                    Licenses Code
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Date
                                </th>

                            </tr>
                            @foreach( $last_add_licenses as $license )
                                <tr>
                                    <td>
                                        {{ $license->license_code }}
                                    </td>
                                    <td>
                                        {{ $license->product->name }}
                                    </td>
                                    <td>
                                        {{ $license->created_at->toDateString() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Top Companies --}}

            {{-- Start Top Api Calls --}}
            <div class="card">
                <div class="card-header">
                    <div class="title">Top APIs</div>
                </div>
                <div class="card-body">
                    <div class="chart-data">
                        <table class="table table-data">
                            <tr>
                                <th>API</th>
                                <th>NO.Calls</th>
                                <th>Last Call Date</th>
                            </tr>
                            @foreach( $top_api_calls as $api )
                                <tr>
                                    <td>
                                        {{ $api->api_key }}
                                    </td>
                                    <td>
                                        {{ $api->cnt }}
                                    </td>
                                    <td>
                                        {{ $api->updated_at->toDateString() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Top Api Calls --}}
        </div>
    </div>
</section>


<script src="{{ asset('admin-assets/assets/reports/general/jspdf.debug.js') }} "></script>
<script src="{{ asset('admin-assets/assets/reports/general/html2canvas.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/general/html2pdf.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/general/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Products
    var reportActiveProduct = $('#reportActiveProduct').data('value');
    var reportInactiveProduct = $('#reportInactiveProduct').data('value');

    // Companies
    var reportActiveCompanies = $('#reportActiveCompanies').data('value');
    var reportInactiveCompanies = $('#reportInactiveCompanies').data('value');

    // Licenses
    var reportActiveLicenses = $('#reportActiveLicenses').data('value');
    var reportInactiveLicenses = $('#reportInactiveLicenses').data('value');
    var reportExpiredLicenses = $('#reportExpiredLicenses').data('value');

</script>

<script>

    const options = {
        margin: 0.0,
        filename: 'general_report_{{ \Carbon\Carbon::now()->format('Y-m-d') }}.pdf',
        image: {
            type: 'jpeg',
            quality: 500
        },
        html2canvas: {
            scale: 5,
            windowWidth: "100%"
        },
        jsPDF: {
            unit: 'cm',
        //    format: 'letter',
            orientation: 'portrait'
        }
    }

    $('.btn-download').click(function (e) {
        e.preventDefault();
        const element = document.getElementById('pdf');
        html2pdf().from(element).set(options).save();
    });


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }


</script>
<script>

    // chart 1
    const ctx = document.getElementById('chart-1').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Active',
                'InActive'
            ],
            datasets: [{
                label: 'Policies',
                data: [reportActiveProduct, reportInactiveProduct],
                backgroundColor: [
                    '#0E5299',
                    '#E6E9F4',
                ],
                hoverOffset: 4
            }],
            borderWidth: 6
        },
        options: {
            cutout: "60%",
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                },
                x: {
                    display: false,
                    grid: {
                        display: false
                    },
                }
            }
        },
    });

    // chart 2
    const ctx2 = document.getElementById('chart-2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: [
                'Active',
                'InActive'
            ],
            datasets: [{
                label: 'Poll',
                data: [reportActiveCompanies, reportInactiveCompanies],
                backgroundColor: [
                    '#0E5299',
                    '#E6E9F4',
                ],
                hoverOffset: 4
            }],
            borderWidth: 6
        },
        options: {
            cutout: "60%",
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                },
                x: {
                    display: false,
                    grid: {
                        display: false
                    },
                }
            }
        },
    });

    // chart 3
    const ctx3 = document.getElementById('chart-3').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: [
                'Active',
                'Inactive',
                'Expired',
            ],
            datasets: [{
                label: 'Assessments',
                data: [reportActiveLicenses, reportInactiveLicenses, reportExpiredLicenses],
                backgroundColor: [
                    '#0E5299',
                    '#E6E9F4',
                    '#FFCC5A',
                ],
                hoverOffset: 4
            }],
            borderWidth: 6
        },
        options: {
            cutout: "60%",
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                },
                x: {
                    display: false,
                    grid: {
                        display: false
                    },
                }
            }
        },
    });

    // chart 4
    const ctx_4 = document.getElementById('chart-4').getContext('2d');
    const chart_4 = new Chart(ctx_4, {
        type: 'bar',
        data: {
            labels: [

                @foreach( $chart_companies as $month_company )
                    "{{ $month_company->month }}",
                @endforeach
            ],
            datasets: [{
                maxBarThickness: 10,
                label: 'Company',
                data: [
                    @foreach( $chart_companies as $companies )
                        {{ $companies->companies }},
                    @endforeach
                ],
                borderWidth: 0,
                borderRadius: 50,
                backgroundColor: "#9BABFE",
            }]
        },
        options: {
            responsive: true,
            interaction: {
                intersect: false,
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: true,
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        },
    });

    // chart 5
    const ctx_5 = document.getElementById('chart-5').getContext('2d');
    const chart_5 = new Chart(ctx_5, {
        type: 'line',
        data: {
            labels: [
                @foreach($chart_activations as $month_activation)
                    "{{ $month_activation->month }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach( $chart_activations as $activation )
                        {{ $activation->activation }},
                    @endforeach
                ],
                borderWidth: 3,
                backgroundColor: "#0058FF",
                borderColor: "#0058FF",
                lineTension: 0,
            }]
        },
        options: {
            bezierCurve: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: true,
                    beginAtZero: true,
                    grid: {
                        display: true
                    }
                },
                x: {
                    grid: {
                        display: true
                    }
                }
            }
        },
    });

</script>
</body>
</html>
