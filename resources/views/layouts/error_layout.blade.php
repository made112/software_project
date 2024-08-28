<!doctype html>
<html lang="en">
<head>
    <title>
        @yield('error_title')
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body{
            background-color: #f5f5f5;
        }
        .error-section{
            display: flex;
            text-align: center;
            min-height: 100vh;
        }
        .error-section .error-card{

            background-color: #fff;
            max-width: 1320px;
            width: 100%;
            height: 100vh;
            margin: auto;
            max-height: 800px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        .error-section .error-card .pic{
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            margin-bottom: 60px;
        }
        .error-section .error-card .pic img{
            width: 100%;
        }
        .error-section .error-card .content .title{
            font-weight: 700;
            font-size: 32px;
            color: #000000;
            margin-bottom: 24px;
        }
        .error-section .error-card .content .info{
            font-weight: 400;
            font-size: 16px;
            color: #000000;
            margin-bottom: 40px;
        }
        .error-section .error-card .content .option{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .error-section .error-card .content .option .btn{
            max-width: 200px;
            width: 100%;
            height: 45px;
            line-height: 40px;
            text-align: center;
            padding: 0 1rem;
            box-shadow: none;
            border-radius: 10px;
            transition: all .3s ease;
        }
        .error-section .error-card .content .option .btn-theme{
            background-color: #43425D;
            border-color: #43425D;
            color: #fff;
        }
        .error-section .error-card .content .option .btn-outline-theme{
            background-color: #fff;
            border-color: #43425D;
            color: #43425D;
        }

        /*
            Figma Link
            https://www.figma.com/file/n323nGeEcEf2FsIvkGeySb/Software?node-id=513%3A4279
        */
    </style>
</head>
    <body>

        @yield('error_content')

    </body>
</html>
