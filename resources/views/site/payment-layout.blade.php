<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .payment-section{
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-image: url({{asset('site-assets/img/payment-bg.png')}});
            background-size: cover;
            background-position: center;
        }
        .payment-section .payment-status{
            text-align: center;
            max-width: 540px;
            padding: 1rem;
            margin: auto;
        }
        .payment-section .payment-status .title{
            font-size: 50px;
            font-weight: 800;
            color: #222222;
            margin-bottom: 18px;
        }
        .payment-section .payment-status .info{
            font-size: 16px;
            color: #707070;
            margin-bottom: 18px;
        }
        .payment-section .payment-status .btn{
            border-radius: 10px;
            background-color: #407CCA;
            border-color: #407CCA;
            color: #fff;
            height: 50px;
            line-height: 50px;
            max-width: 356px;
            width: 100%;
            padding-top: 0;
            padding-bottom: 0;
        }
        .payment-section .payment-status .btn:hover{
            opacity: .9;
        }
        @media (max-width: 1024px){
            .payment-section .payment-pic{
                max-width: 420px;
                margin: auto;
            }
            .payment-section .payment-status .title{
                font-size: 32px;
            }
        }
        @media (max-width: 787px){
            
            .payment-section .payment-status{
                max-width: 100%;
                margin-bottom: 24px;
            }
            .payment-section .payment-status .title{
                font-size: 28px;
            }
            .payment-section .payment-status .info{
                font-size: 14px;
            }
        }
    </style>
  </head>
  <body>
        <main>
            @yield('content')

        </main>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      </body>
    </html>