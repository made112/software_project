<!DOCTYPE html>
<html lang="en" dir="ltr" data-dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>

    <link rel="stylesheet" href="{{ asset('admin-assets/assets/reports/detailed/css/bootstrap.min.css') }}">


    <!-- <link href="css/style.css" rel="stylesheet"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Almarai', sans-serif;
        }
        @page{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html{
            background: #F5F6FA;
        }
        body {
            box-sizing: border-box;
            margin: 0 auto;
            padding: 0;
            width: 270mm;
            background: #F5F6FA;
        }
        main section{
            display: block;
            height: 210mm;
            margin: 0;
            overflow: hidden;
        }
        .pdf {
            font-family: 'Almarai', sans-serif;
            position: relative;
            background: #F5F6FA;
            font-size: 10px;
        }
        .header {
            position: relative;
            color: #fff;
            background: #0E5299;
            padding:  0 16px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            height: 70px;
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
            line-height: 2;
            color: #F5F6FA;
            margin-bottom: 3px;
            padding-top: 10px;
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
            overflow: hidden;
            height: calc(815px - (70px + 16px + 16px));
        }
        .row{
            margin-bottom: 20px;
        }
        .row:last-child{
            margin-bottom: 0;
        }
        .text-light {
            color: #939393 !important;
        }
        .card-custom {
            width: 100%;
            background: #FFFFFF;
            /* box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.061); */
            border-radius: 10px;
            padding: 13px;
            border: none;
            height: 100%;
            border: 1px solid #E6E9F4;
        }
        .card-custom .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            font-size: 12px;
            line-height: 16px;
            color: #303840;
        }
        .card-custom .card-body .chart-box.chart-box-circle {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 1rem auto;
            overflow: hidden;
        }
        .card-custom .card-body .chart-box.chart-box-circle .data-count{
            position: absolute;
            content: "";
            width: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #303840;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
        }
        .card-custom .card-body .chart-box.chart-box-circle canvas {
            width: 100%;
            height: 100%;
        }
        .card-custom .card-body .chart-box.chart-box-bar {
            margin: 1rem auto;
            overflow: hidden;
            width: 100% !important;
        }
        .card-custom .card-body .chart-box.chart-box-bar canvas{
            width: 100% !important;
            min-height: 140px!important;
            max-height: 240px !important;
        }
        .card-custom .card-body .table{
            width: 100%;
        }
        .card-custom .card-body .chart-data{
            width: 60%;
            margin: auto;
        }
        .card-custom .card-body .chart-data td{
            padding: 5px;
            line-height: 16px !important;
        }
        .card-custom .card-body .table tr td {
            font-weight: 400;
            font-size: 11px;
            line-height: 20px;
            color: #303840;
            border-color: transparent;
        }
        .card-custom .card-body .table tr td .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #E6E9F4;
            display: inline-block;
            margin-inline-end: 10px;
        }
        .table-data {
            margin-top: 11px;
        }
        .table{
            margin-bottom: 0;
        }
        .table-data tr th {
            font-weight: 400;
            font-size: 10px;
            line-height: 11px;
            color: #B5B5C3;
            text-align: center;
            border-color: transparent;
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
            padding: 5px;
            color: #303840;
            text-align: center;
            border-color: transparent;
        }
        .table-data tr td:first-child {
            text-align: inherit;
        }
        .table-data tr:nth-child(odd) td {
            background: #F5F8FA;
        }
        .table-info{
            margin-top: 10px;
            text-align: center;
        }
        .table-info .title{
            font-weight: 400;
            font-size: 10px;
            text-align: center;
            color: #939393;
        }
        .table-info .count{
            font-weight: 700;
            font-size: 12px;
            text-align: center;
            color: #4D4F5C;
        }
        .table-info .parcentage{
            font-weight: 700;
            font-size: 10px;
            color: #4D4F5C;
        }
        .table-info .parcentage.up{
            color: #3CC480;
        }
        .table-info .parcentage.down{
            color: #FF4141;
        }
        .nav-badge{
            gap: 10px;
        }
        .nav-badge li{
            display: block;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 400;
            padding: 1px 1rem;
        }
        .nav-badge li.active{
            background-color: rgb(62, 165, 66, .1);
            color: rgb(62, 165, 66);
        }
        .nav-badge li.inactive{
            background-color: rgb(228, 62, 62, .1);
            color: rgb(228, 62, 62);
        }
        .nav-badge li.expired{
            background-color: rgba(227, 155, 54, .1);
            color: rgba(227, 155, 54, 1);
        }
        .nav-badge li.blocked{
            background-color: rgba(67, 66, 93, .1);
            color: rgba(67, 66, 93, 1);
        }
        .btn-download{
            position: fixed;
            left: 1rem;
            bottom: 1rem;
            width: 70px;
            height: 70px;
            line-height: 70px;
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
<main id="pdf">
        <section class="pdf">
            <div class="header">
                <h1 class="title">Software Report</h1>
                <p class="date">{{ $from->toDateString() }} - {{ $to->toDateString() }}</p>
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
                <div class="row align-items-stretch">
                    <div class="col-4">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Products</div>
                            </div>
                            <div class="card-body d-flex justify-content-center flex-column">
                                <div class="chart-box chart-box-circle">
                                    <div class="data-count">
                                        {{ $products }}
                                    </div>
                                    <canvas id="chart-1-1" width="70" height="70"></canvas>
                                </div>
                                <div class="chart-data">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="dot" style="background-color: #0E5299;"></span>
                                                <span class="title">Active</span>
                                                <span id="reportActiveProductDetailed" data-value="{{ $active_products }}"></span>
                                            </td>
                                            <td>
                                                {{ $active_products }}
                                            </td>
                                            <td>
                                                <span class="text-light">
                                                    @if($products > 0)
                                                        {{ round( ($active_products / $products) * 100, 2) }} %
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
                                                <span id="reportInactiveProductDetailed" data-value="{{ $inactive_products }}"></span>
                                            </td>
                                            <td>
                                                {{ $inactive_products }}
                                            </td>
                                            <td>
                                                <span class="text-light">
                                                    @if($products > 0)
                                                        {{ round( ($inactive_products / $products) * 100, 2) }} %
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
                    </div>
                    <div class="col-8">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Last Selled Products</div>
                            </div>
                            <div class="card-body">
                                <div class="table-data">
                                    <table class="table ">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Company Name</th>
                                            <th>Date</th>
                                        </tr>
                                        @foreach( $last_selled_products as $selled_products )
                                            <tr>
                                                <td>
                                                    @if($selled_products->product)
                                                        {{ $selled_products->product->name }}
                                                    @else
                                                        {{ 'No Data' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($selled_products->client)
                                                        {{ $selled_products->client->name }}
                                                    @else
                                                        {{ 'No Data' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $selled_products->created_at->toDateString() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-7">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Total Income</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-data w-auto mx-auto my-3">
                                    <table class="table w-auto">
                                        <tr>
                                            @foreach( $income_array_product as $income_data )
                                                <td>
                                                    <span class="dot" style="background-color: {{ $income_data['backgroundColor'] }}"></span>
                                                    <span class="title">
                                                        {{ $income_data['product'] }}
                                                    </span>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                                <div class="chart-box chart-box-bar mb-0">
                                    <canvas id="chart-1-2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Licenses</div>
                            </div>
                            <div class="card-body">
                                <div class="table-data">
                                    <table class="table ">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Licences</th>
                                            <th>Versions</th>
                                            <th>Users</th>
                                        </tr>
                                        @foreach( $licenses_products as $license )
                                            <tr>
                                                <td>
                                                    {{ $license->product->name }}
                                                </td>
                                                <td>
                                                    {{ $license->id }}
                                                </td>
                                                <td>
                                                    @if($license->product->last_version)
                                                        {{ $license->product->last_version->name }}
                                                    @else
                                                        {{'No Data'}}
                                                    @endif
                                                </td>
                                                <td>
                                                   {{ $license->users }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pdf">
            <div class="header">
                <h1 class="title">Software Report</h1>
                <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
                <div class="row align-items-stretch">
                    <div class="col-4">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Companies</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-box chart-box-circle">
                                    <div class="data-count">
                                        {{ $companies }}
                                    </div>
                                    <canvas id="chart-2-1" width="70" height="70"></canvas>
                                </div>
                                <div class="chart-data">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="dot" style="background-color: #0E5299;"></span>
                                                <span class="title">Active</span>
                                                <span id="detailedReportActiveCompanies" data-value="{{ $active_companies }}">Active</span>
                                            </td>
                                            <td>
                                                {{ $active_companies }}
                                            </td>
                                            <td>
                                                <span class="text-light">
                                                    @if($active_companies > 0)
                                                        {{ round( ($active_companies / $companies) * 100, 2) }} %
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
                                                <span id="detailedReportInactiveCompanies" data-value="{{ $inactive_companies }}">Inactive</span>
                                            </td>
                                            <td>
                                                @if($active_companies > 0)
                                                    {{ $inactive_companies }}
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </td>
                                            <td>
                                                <spane class="text-light">
                                                    @if($active_companies > 0)
                                                        {{ round( ($inactive_companies / $companies) * 100, 2) }} %
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
                    </div>
                    <div class="col-8">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Last Selled Products</div>
                            </div>
                            <div class="card-body">
                                <div class="table-data">
                                    <table class="table ">
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Product Name</th>
                                            <th>Project Manager</th>
                                            <th>Contacts</th>
                                        </tr>
                                        @foreach($last_selled_products as $last_product)
                                            <tr>
                                                <td>
                                                    @if($last_product->client)
                                                        {{ $last_product->client->name }}
                                                    @else
                                                        {{ 'No data' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($last_product->product)
                                                        {{ $last_product->product->name }}
                                                    @else
                                                        {{ 'No Data' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($last_product->client)
                                                        @foreach( $last_product->client->projects_manager as $manager )
                                                            {{ $manager->manager->name }}
                                                        @endforeach
                                                    @else
                                                        {{ 'No data' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($last_product->client)
                                                        {{ $last_product->client->email }}, {{ $last_product->client->phone_number }}
                                                    @else
                                                        {{ 'No data' }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-7">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Users Activities</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-box chart-box-bar">
                                    <canvas id="chart-2-2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card-custom">
                            <div class="card-header">
                                <div class="title">Active Companies</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-data">
                                    <table class="table ">
                                        <tr>
                                            <td>
                                                <div class="table-info">
                                                    <div class="title">Daily</div>
                                                    <div class="count">
                                                        {{ round($avg, 2) }}
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
                                                        {{ round($w_companies,2) }}
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
                                                        {{ round($m_companies,2) }}
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
                                    <canvas id="chart-2-3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
            <div class="row mb-0">
                <div class="col-12">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Companies ({{ $companies }})</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>Company Name</th>
                                        <th>No. Products</th>
                                        <th>Licences</th>
                                        <th>Country, City</th>
                                        <th>Project Manager</th>
                                        <th>Contacts</th>
                                    </tr>
                                    @foreach($company_products as $company)
                                       <tr>
                                            <td>
                                                {{ $company->name }}
                                            </td>
                                            <td>
                                                {{ count($company->products) }}
                                            </td>
                                            <td>
                                                <ul class="nav nav-badge">
                                                @if(count ($company->products) > 0)
                                                    @php
                                                        foreach ($company->products as $product) {
                                                            $active_license = $company->licenses->where('product_id', $product->id )->where('client_id', $company->id)->where('usage', 1)->where('date', '>=', $to)->count();
                                                            $inactive_license = $company->licenses->where('product_id', $product->id )->where('client_id', $company->id)->where('usage', 0)->where('date', '>=', $to)->count();
                                                            $expired_license = $company->licenses->where('product_id', $product->id )->where('client_id', $company->id)->where('date', '<', $to)->count();
                                                            $blocked_license = $company->licenses->where('product_id', $product->id )->where('client_id', $company->id)->where('block', 1)->count();
                                                        }
                                                    @endphp

                                                    <li class="active">
                                                        @if ($active_license)
                                                            {{ $active_license }}

                                                        @else
                                                            {{ '0' }}
                                                        @endif
                                                        Active
                                                    </li>
                                                    <li class="inactive">
                                                        {{ $inactive_license }}
                                                        Inactive
                                                    </li>
                                                    <li class="expired">
                                                        {{ $expired_license }}
                                                        Expired
                                                    </li>
                                                    <li class="blocked">
                                                        {{ $blocked_license }}
                                                        Blocked
                                                    </li>
                                                @else
                                                    <li class="text-danger">
                                                        {{ 'No Licenses' }}
                                                    </li>
                                                @endif
                                                </ul>
                                            </td>
                                            <td>
                                                {{ $company->country->name_en }}, {{ $company->city->name }}
                                            </td>
                                            <td>
                                                @foreach($company->projects_manager as $manager )
                                                    {{ $manager->manager->name }},
                                                @endforeach
                                            </td>
                                            <td>{{ $company->email }}, {{ $company->phone_number }}</td>
                                       </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
            <div class="row align-items-stretch">
                <div class="col-4">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Licences</div>
                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ $licenses }}
                                </div>
                                <canvas id="chart-4-1" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table" style="line-height: 16px;">
                                    <tr>
                                        <td style="line-height: 16px;">
                                            <span class="dot" style="background-color: #0E5299;"></span>
                                            <span class="title">Active</span>
                                            <span id="detailedReportActiveLicenses" data-value="{{ $active_licenses }}">Active</span>
                                        </td>
                                        <td style="line-height: 16px;">
                                            {{ $active_licenses }}
                                        </td>
                                        <td style="line-height: 16px;">
                                            <span class="text-light">
                                                @if($licenses > 0)
                                                    {{ round( ($active_licenses / $licenses) * 100, 2) }} %
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <td style="line-height: 16px;">
                                        <span class="dot" style="background-color: #ffcc5a;"></span>
                                        <span class="title">Inactive</span>
                                        <span id="detailedReportInactiveLicenses" data-value="{{ $inactive_licenses }}">Inactive</span>
                                    </td>
                                    <td style="line-height: 16px;">
                                        {{ $inactive_licenses }}
                                    </td>
                                    <td style="line-height: 16px;">
                                        <span class="text-light">
                                            @if($licenses > 0)
                                                {{ round( ($inactive_licenses / $licenses) * 100, 2) }} %
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </span>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 16px;">
                                            <span class="dot"></span>
                                            <span class="title">Expired</span>
                                            <span id="detailedReportExpiredLicenses" data-value="{{ $expired_licenses }}">Expired</span>
                                        </td>
                                        <td style="line-height: 16px;">
                                            {{ $expired_licenses }}
                                        </td>
                                        <td style="line-height: 16px;">
                                            <span class="text-light">
                                                @if($licenses > 0)
                                                    {{ round( ($expired_licenses / $licenses) * 100, 2) }} %
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
                </div>
                <div class="col-8">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Last Licenses Activation (7)</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>Licence Code</th>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach( $last_activate_licenses as $last_license )
                                        <tr>
                                            <td>
                                                {{ $last_license->license->license_code }}
                                            </td>
                                            <td>
                                                {{ $last_license->license->product->name }}
                                            </td>
                                            <td>
                                                {{ $last_license->license->client->name }}
                                            </td>
                                            <td>
                                                {{ $last_license->updated_at->toDateString() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-7">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Product Licenses Income</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-data w-auto mx-auto my-3">
                                <table class="table w-auto">
                                    <tr>
                                        @foreach( $income_array as $income)
                                            <td>
                                                <span class="dot" style="background-color: {{ $income['backgroundColor'] }};"></span>
                                                <span class="title">
                                                    {{ $income['product'] }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <div class="chart-box chart-box-bar mb-0">
                                <canvas id="chart-4-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Last Added Licenses</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>Licence Code</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach( $last_add_licenses as $last_license )
                                        <tr>
                                            <td>
                                                {{ $last_license->license_code }}
                                            </td>
                                            <td>{{ $last_license->product->name }}</td>
                                            <td>
                                                {{ $last_license->created_at->toDateString() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
            <div class="row mb-0">
                <div class="col-12">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Nearly Finished (Renewal Team) ({{ count($nearly_licenses) }})</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table " style="font-size: 12px;">
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Product Name</th>
                                        <th>Licence Code</th>
                                        <th>Licence Type</th>
                                        <th>Project Manager</th>
                                        <th>Expiration Date</th>
                                    </tr>
                                    @foreach( $nearly_licenses as $license )
                                        <tr>
                                            <td>
                                                {{ $license->client->name }}
                                            </td>
                                            <td>
                                                {{ $license->product->name }}
                                            </td>
                                            <td>
                                                {{ $license->license_code }}
                                            </td>
                                            <td>
                                                @if ( $license->type == 1 )
                                                    {{ "Online" }}
                                                @else
                                                    {{ "Offline" }}
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($license->client->projects_manager as $project_manager)
                                                    {{ $project_manager->manager->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $license->updated_at->toDateString() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
            <div class="row align-items-stretch">
                <div class="col-5">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Activations</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ $activations }}
                                </div>
                                <canvas id="chart-5-1" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #0E5299;"></span>
                                            <span class="title">Success Activation</span>
                                            <span id="detailedSuccessActivation" data-value="{{ $success_activate  }}"></span>
                                        </td>
                                        <td>
                                            {{ $success_activate }}
                                        </td>
                                        <td>
{{--                                            @dd(round( ($success_activate / $activations) * 100, 2))--}}
                                            @if($activations > 0)
                                                <span class="text-light"> {{ round( ($success_activate / $activations) * 100, 2) }} %</span>
                                            @else
                                                {{ '0' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #FFCC5A;"></span>
                                            <span class="title">Failed Activation</span>
                                            <span id="detailedFailedActivation" data-value="{{ $failed_activate  }}"></span>
                                        </td>
                                        <td>
                                            {{ $failed_activate }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($activations > 0)
                                                    {{ round( ( $failed_activate / $activations ) * 100, 2 )}} %
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot"></span>
                                            <span class="title">Success Deactivation</span>
                                            <span id="detailedSuccessDeactivation" data-value="{{ $success_deactivate  }}"></span>
                                        </td>
                                        <td>
                                            {{ $success_deactivate }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($activations > 0)
                                                    {{ round ( ( $success_deactivate / $activations ) * 100, 2 ) }} %
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot"></span>
                                            <span class="title">Failed Deactivation</span>
                                            <span id="detailedFailedDeactivation" data-value="{{ $failed_deactivate  }}"></span>
                                        </td>
                                        <td>
                                            {{ $failed_deactivate }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($activations > 0)
                                                    {{ round( ( $failed_deactivate / $activations ) * 100, 2 )  }} %
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
                </div>
                <div class="col-7">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Activations</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-bar">
                                <canvas id="chart-5-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-7">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Notifications History</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-bar">
                                <canvas id="chart-5-3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Notifications</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ $notifications }}
                                </div>
                                <canvas id="chart-5-4" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #0E5299;"></span>
                                            <span class="title">Total Notifications</span>
                                            <span id="detailedTotalNotifications" data-value="{{ $notifications }}"></span>
                                        </td>
                                        <td>
                                            {{ $notifications }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #E6E9F4;"></span>
                                            <span class="title">Today Notifications</span>
                                            <span id="detailedTodayNotifications" data-value="{{ $todayNotificationsCount }}"></span>
                                        </td>
                                        <td>
                                            {{ $todayNotificationsCount }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">{{ $from->toDateString() }} / {{ $to->toDateString() }}</p>
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
            <div class="row align-items-stretch">
                <div class="col-4">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Downloads</div>
                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ $downloads }}
                                </div>
                                <canvas id="chart-6-1" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #0E5299;"></span>
                                            <span class="title">Success Downloads</span>
                                            <span id="detailedSuccessDownloads" data-value="{{ $success_downloads }}"></span>
                                        </td>
                                        <td>
                                            {{ $success_downloads }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($downloads > 0)
                                                    {{ round( ($success_downloads / $downloads) * 100, 2) }} %
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot"></span>
                                            <span class="title">Failed Downloads</span>
                                            <span id="detailedFailedDownloads" data-value="{{ $failed_downloads }}"></span>
                                        </td>
                                        <td>
                                            {{ $failed_downloads }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($downloads > 0)
                                                    {{ round( ($failed_downloads / $downloads) * 100, 2) }} %
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
                </div>
                <div class="col-8">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Last Downloads</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>Version</th>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                    </tr>
                                    @if(count($last_downloads) > 0)
                                        @foreach( $last_downloads as $last_download )
                                            <tr>
                                                <td>
                                                    {{ $last_download->version->name }}
                                                </td>
                                                <td>
                                                    {{ $last_download->product->name }}
                                                </td>
                                                <td>{{ $last_download->client->name }}</td>
                                                <td>
                                                    {{ $last_download->updated_at->toDateString() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="alert alert-danger mt-5">
                                            <td colspan="4" class="alert alert-danger text-center">
                                                <strong>
                                                    {{ 'There Is No Data' }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-7">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Downloads History</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-bar mb-0">
                                <canvas id="chart-6-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Downloads / Products</div>
                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ count($product_downloads) }}
                                </div>
                                <canvas id="chart-6-3" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table">
                                    @if(count($download_products_array) > 0)
                                        @foreach($download_products_array as $download)
                                            <tr>
                                                <td>
                                                    <span class="dot" style="background-color: {{ $download['backgroundColor'] }};"></span>

                                                    <span class="title">
                                                        {{ $download['product'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $download['products'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <span class="dot" style="background-color: #ddd;"></span>

                                                <span class="title">
                                                    No Data
                                                </span>
                                            </td>
                                            <td>
                                                0 %
                                            </td>
                                        </tr>
                                    @endif

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="pdf">
        <div class="header">
            <h1 class="title">Software Report</h1>
            <p class="date">01/05/2021 - 31/05/2022</p>
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
            <div class="row align-items-stretch">
                <div class="col-4">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">API Calls</div>
                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <div class="chart-box chart-box-circle">
                                <div class="data-count">
                                    {{ $api_calls }}
                                </div>
                                <canvas id="chart-7-1" width="70" height="70"></canvas>
                            </div>
                            <div class="chart-data">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #0E5299;"></span>
                                            <span class="title">Success API Calls</span>
                                            <span id="detailedSuccessApiCalls" data-value="{{ $success_api_calls }}"></span>
                                        </td>
                                        <td>
                                            {{ $success_api_calls }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($api_calls > 0)
                                                    {{ round( ($success_api_calls / $api_calls) * 100,2 ) }} %
                                                @else
                                                    {{ '0' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot"></span>
                                            <span class="title">Failed API Calls</span>
                                            <span id="detailedFailedApiCalls" data-value="{{ $failed_api_calls }}"></span>
                                        </td>
                                        <td>
                                            {{ $failed_api_calls }}
                                        </td>
                                        <td>
                                            <span class="text-light">
                                                @if($api_calls > 0)
                                                    {{ round( ($failed_api_calls / $api_calls) * 100,2 ) }} %
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
                </div>
                <div class="col-8">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Last API Calls</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>API</th>
                                        <th>Function</th>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach($last_api_calls as $last_api_call)
                                        <tr>
                                            <td>
                                                {{ $last_api_call->api_key }}
                                            </td>
                                            <td>
                                                @if ( $last_api_call->function  == 1)
                                                    {{ 'Get Last Version' }}
                                                @elseif ( $last_api_call->function  == 2)
                                                    {{ 'Check Availability License' }}
                                                @elseif ( $last_api_call->function == 3)
                                                    {{ 'Activate License' }}
                                                @elseif ( $last_api_call->function == 4)
                                                    {{ 'Deactivate License' }}
                                                @elseif ( $last_api_call->function == 5)
                                                    {{ 'Check Update' }}
                                                @elseif ( $last_api_call->function == 6)
                                                    {{ 'Update Downloads' }}
                                                @elseif ( $last_api_call->function == 7)
                                                    {{ 'View Package' }}
                                                @elseif ( $last_api_call->function == 8)
                                                    {{ 'Sign In' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($last_api_call->product)
                                                    {{ $last_api_call->product->name }}
                                                @else
                                                    {{ 'No Data' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($last_api_call->client)
                                                    {{ $last_api_call->client->name }}
                                                @else
                                                    {{ 'No Data' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $last_api_call->created_at->toDateString() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-7">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">API Activity</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-box chart-box-bar mb-0">
                                <canvas id="chart-7-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-custom">
                        <div class="card-header">
                            <div class="title">Licenses</div>
                        </div>
                        <div class="card-body">
                            <div class="table-data">
                                <table class="table ">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Licences</th>
                                        <th>Versions</th>
                                        <th>Users</th>
                                    </tr>
                                    @foreach($top_api_calls as $top_api)
                                        <tr>
                                            <td>
                                                {{ $top_api->product->name }}
                                            </td>
                                            <td>
                                                @foreach( $top_api->product->licenses as $license)
                                                    @if ($loop->last)
                                                        {{ $license->id }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($top_api->version)
                                                    {{ $top_api->version->id }}
                                                @else
                                                    {{ 'No Data' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $top_api->cnt }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('admin-assets/assets/reports/detailed/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/detailed/js/jspdf.debug.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/detailed/js/html2canvas.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/detailed/js/html2pdf.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/reports/detailed/js/chart.min.js') }}"></script>

<script>
    const options = {
        margin: 0,
        filename: 'detailed_report._{{ \Carbon\Carbon::now()->format('Y-m-d') }}.pdf',
        image: {
            type: 'jpeg',
            quality: 200
        },
        html2canvas: {
            scale: 1,
            windowWidth: "100%"
        },
        jsPDF: {
            unit: 'cm',
            //    format: 'letter',
            orientation: 'landscape'
        }
    }

    $('.btn-download').click(function(e){
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



        var reportActiveProductDetailed = $('#reportActiveProductDetailed').data('value');
        var reportInactiveProductDetailed = $('#reportInactiveProductDetailed').data('value');

        // chart 1
        const ctx = document.getElementById('chart-1-1').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Active',
                    'InActive'
                ],
                datasets: [{
                    label: 'Policies',
                    data: [reportActiveProductDetailed, reportInactiveProductDetailed],
                    backgroundColor: [
                        '#0E5299',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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
        const ctx2 = document.getElementById('chart-1-2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [
                    @foreach($income_array_product as $income)
                        {
                            label: "{{ $income['product'] }}",
                            data: [
                                @foreach($income['data'] as $in)
                                    "{{ $in }}",
                                @endforeach
                            ],
                            backgroundColor: "{{ $income['backgroundColor'] }}",
                            borderColor: "{{ $income['borderColor'] }}",
                            hoverOffset: 4
                        },
                    @endforeach
                ]
                // borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: false
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });



        var detailedReportActiveCompanies = $('#detailedReportActiveCompanies').data('value');
        var detailedReportInactiveCompanies = $('#detailedReportInactiveCompanies').data('value');
        // chart 2-1
        const ctx_2_1 = document.getElementById('chart-2-1').getContext('2d');
        const myChart_2_1 = new Chart(ctx_2_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Active',
                    'InActive'
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedReportActiveCompanies, detailedReportInactiveCompanies],
                    backgroundColor: [
                        '#0E5299',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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

        // chart 2-2
        const ctx_2_2 = document.getElementById('chart-2-2').getContext('2d');
        const myChart2_2 = new Chart(ctx_2_2, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Users Activities',
                    data: [
                        @foreach($chart_active_companies as $income)
                            @foreach($income['data'] as $data)
                                "{{ $data }}",
                            @endforeach
                        @endforeach

                    ],
                    backgroundColor: "#0E5299",
                    borderColor: "#0E5299",
                    hoverOffset: 4
                }],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: false
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });

        // chart 2-3
        const ctx_2_3 = document.getElementById('chart-2-3').getContext('2d');
        const chart_2_3 = new Chart(ctx_2_3, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($last_active_companies as $month)
                        "{{ $month->month }}",
                    @endforeach
                ],
                datasets: [{
                    maxBarThickness: 10,
                    label: 'Company',
                    data: [
                        @foreach($last_active_companies as $client)
                            {{ $client->client }},
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



        var detailedReportActiveLicenses = $('#detailedReportActiveLicenses').data('value');
        var detailedReportInactiveLicenses = $('#detailedReportInactiveLicenses').data('value');
        var detailedReportExpiredLicenses = $('#detailedReportExpiredLicenses').data('value');
        // chart 4-1
        const ctx_4_1 = document.getElementById('chart-4-1').getContext('2d');
        const myChart_4_1 = new Chart(ctx_4_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Active',
                    'InActive',
                    'Expired',
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedReportActiveLicenses, detailedReportInactiveLicenses, detailedReportExpiredLicenses],
                    backgroundColor: [
                        '#0E5299',
                        '#ffcc5a',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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

        // chart 4-2
        const ctx_4_2 = document.getElementById('chart-4-2').getContext('2d');
        const myChart_4_2 = new Chart(ctx_4_2, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [
                @foreach($income_array as $income)
                    {
                        label: '{{ $income["product"] }}',
                        data: [
                            @foreach($income['data'] as $data)
                                "{{ $data }}",
                            @endforeach
                        ],
                        backgroundColor: "{{ $income['backgroundColor'] }}",
                        borderColor: "{{ $income['borderColor'] }}",
                        hoverOffset: 4
                    },
                @endforeach
                ],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: false
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });


        var detailedSuccessActivation = $('#detailedSuccessActivation').data('value'),
            detailedFailedActivation = $('#detailedFailedActivation').data('value'),
            detailedSuccessDeactivation = $('#detailedSuccessDeactivation').data('value'),
            detailedFailedDeactivation = $('#detailedFailedDeactivation').data('value'),

            detailedTotalNotifications = $('#detailedTotalNotifications').data('value'),
            detailedTodayNotifications = $('#detailedTodayNotifications').data('value');


        // chart-5-1
        const ctx_5_1 = document.getElementById('chart-5-1').getContext('2d');
        const myChart_5_1 = new Chart(ctx_5_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Success Activation',
                    'Failed Activation',
                    'Success Deactivation',
                    'Failed Deactivation',
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedSuccessActivation, detailedFailedActivation, detailedSuccessDeactivation, detailedFailedDeactivation],
                    backgroundColor: [
                        '#0E5299',
                        'rgba(255, 204, 90, 1)',
                        '#E6E9F4',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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

        // chart 5-2
        const ctx_5_2 = document.getElementById('chart-5-2').getContext('2d');
        const myChart5_2 = new Chart(ctx_5_2, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Users Activities',
                    data: [
                        @foreach($monthly_activations_chart as $activation)
                            @foreach($activation['data'] as $data)
                                "{{ $data }}",
                            @endforeach
                        @endforeach
                    ],
                    backgroundColor: "#0058FF",
                    borderColor: "#0058FF",
                    hoverOffset: 4
                }],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: true
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: true
                        },
                    }
                }
            },
        });

        // chart 5-2
        const ctx_5_3 = document.getElementById('chart-5-3').getContext('2d');
        const myChart5_3 = new Chart(ctx_5_3, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Notifications Activities',
                    data: [
                        @foreach($monthly_notifications_chart as $activation)
                            @foreach($activation['data'] as $data)
                            "{{ $data }}",
                        @endforeach
                        @endforeach
                    ],
                    backgroundColor: "#0058FF",
                    borderColor: "#0058FF",
                    hoverOffset: 4
                }],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: true
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: true
                        },
                    }
                }
            },
        });

        // chart-5-4
        const ctx_5_4 = document.getElementById('chart-5-4').getContext('2d');
        const myChart_5_4 = new Chart(ctx_5_4, {
            type: 'doughnut',
            data: {
                labels: [
                    'Total Notifications',
                    'Today Notifications'
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedTotalNotifications, detailedTodayNotifications],
                    backgroundColor: [
                        '#0E5299',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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


        var detailedSuccessDownloads = $('#detailedSuccessDownloads').data('value'),
            detailedFailedDownloads = $('#detailedFailedDownloads').data('value');
        // chart-6-1
        const ctx_6_1 = document.getElementById('chart-6-1').getContext('2d');
        const myChart_6_1 = new Chart(ctx_6_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Success API Calls',
                    'Failed API Calls'
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedSuccessDownloads, detailedFailedDownloads],
                    backgroundColor: [
                        '#0E5299',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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

        // chart 6-2
        const ctx_6_2 = document.getElementById('chart-6-2').getContext('2d');
        const myChart6_2 = new Chart(ctx_6_2, {
            type: 'line',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'
                ],
                datasets: [
                {
                        label: 'Downloads',
                        data: [
                            @foreach( $chart_downloads_array as $download )
                                @foreach($download['data'] as $data)
                                    {{ $data }},
                                @endforeach
                            @endforeach
                        ],
                        backgroundColor: "#0058FF",
                        borderColor: "#0058FF",
                        hoverOffset: 4
                    },
                ],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: true
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: true
                        },
                    }
                }
            },
        });

        // chart-6-3
        const ctx_6_3 = document.getElementById('chart-6-3').getContext('2d');
        const myChart_6_3 = new Chart(ctx_6_3, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($download_products_array as $product)
                        "{{ $product['product'] }}",
                    @endforeach
                ],
                datasets: [{
                    label: [
                        @if($download_products_array > 0)
                            @foreach($download_products_array as $product)
                                "{{ $product['product'] }}",
                            @endforeach
                        @else
                            'No Data',
                        @endif
                    ],
                    data: [
                        @if($download_products_array > 0)
                            @foreach($download_products_array as $product)
                                 @foreach($product['data'] as $data)
                                    "{{ $data }}",
                                @endforeach
                            @endforeach
                        @else
                            0,
                        @endif
                    ],
                    backgroundColor: [
                        @if($download_products_array > 0)
                            @foreach($download_products_array as $product)
                                "{{ $product['backgroundColor'] }}",
                            @endforeach
                        @else
                            '#0E5299',
                        @endif

                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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



        var detailedSuccessApiCalls = $('#detailedSuccessApiCalls').data('value'),
            detailedFailedApiCalls  = $('#detailedFailedApiCalls').data('value');
        // chart-7-1
        const ctx_7_1 = document.getElementById('chart-7-1').getContext('2d');
        const myChart_7_1 = new Chart(ctx_7_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Success API Calls',
                    'Failed API Calls'
                ],
                datasets: [{
                    label: 'Policies',
                    data: [detailedSuccessApiCalls, detailedFailedApiCalls],
                    backgroundColor: [
                        '#0E5299',
                        '#E6E9F4',
                    ],
                    hoverOffset: 4
                }],
                borderWidth: 4
            },
            options: {
                cutout: "80%",
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

        // chart 7-2
        const ctx_7_2 = document.getElementById('chart-7-2').getContext('2d');
        const myChart7_2 = new Chart(ctx_7_2, {
            type: 'line',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'
                ],
                datasets: [{
                    label: 'Api Call Activities',
                    data: [
                        @foreach($chart_api_calls as $api_call)
                            @foreach($api_call['data'] as $data)
                                "{{ $data }}",
                            @endforeach
                        @endforeach
                    ],
                    backgroundColor: "#0058FF",
                    borderColor: "#0058FF",
                    hoverOffset: 4
                }],
                borderWidth: 6
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
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
                        beginAtZero: false,
                        grid: {
                            display: true
                        },
                    },
                    x: {
                        beginAtZero: false,
                        display: true,
                        grid: {
                            display: true
                        },
                    }
                }
            },
        });


</script>
</body>
</html>
