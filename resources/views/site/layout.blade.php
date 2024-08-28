<!doctype html>
<html lang="ar" dir="ltr" data-dir="ltr">
    <head> 
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<meta name="description" content="{{$setting->name}}">
		<meta name="keyword" content="{{$setting->name}}">
		<meta name="author" content="{{$setting->name}}">
		<meta name="robots" content="index, follow">
		
		<meta name="geo.position" content="">
		<meta name="geo.placename" content="">
		<meta name="geo.region" content="">
		
		<meta property="og:type" content="" />
		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" /> 
		<meta property="og:url" content="" /> 
		<meta property="og:site_name" content="" />
		
		<meta name="twitter:title" content=""> 
		<meta name="twitter:description" content=""> 
		<meta name="twitter:image" content=""> 
		<meta name="twitter:site" content=""> 
		<meta name="twitter:creator" content="">

		<link rel="canonical" href=""/>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" id="bs_dir">
		<style>
			
			/*------------------------------------------
				Section Auth
			------------------------------------------*/
			
			@import "https://use.fontawesome.com/releases/v5.8.1/css/all.css";
			@import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');

			:root {
				--main-color: #005272;
				--main-color-2: 0, 82, 114;
				--second-color: #0394CB;
				--second-color-2: 3, 148, 203;
				--dark-color: rgb(32, 32, 32);
				--dark-color-2: 32, 32, 32;
				--normal-color: #3F3F3F;
				--light-color: #BDBDBD;

				--black-color: rgba(28, 28, 28, 1);
				--green-color: #70D274;
				--blue-color: #00AFF0;
				--red-color: #FE5273;
				--yellow-color: #FDB44D;
				--purple-color: rgba(141, 39, 221, 1);
				--white-color: rgba(255, 255, 255, 1);
				--gray-color: rgb(249, 249, 249);
 
				--shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
				--shadow-hover: 0 .5rem 1rem rgba(0, 0, 0, .15);
				--radius-sm: 3px;
				--radius-md: 10px;
				--radius-lg: 20px; 
			} 
			
			h1, h2, h3, h4, h5, h6 {
				font-weight: 800;
				font-family: 'Almarai', sans-serif;
			}

			body {
				font-family: 'Almarai', sans-serif;
				font-weight: 400;
				font-size: 16px;
				color: var(--normal-color);
				background-color: #f5f6fa;
			}

			.section-auth {
				padding: 70px 0;
				display: flex;
				height: 100vh;
				align-items: center;
			}

			.section-auth .btn {
				position: relative;
				overflow: hidden;
				padding: 0 2rem;
				height: 40px;
				line-height: 40px;
				font-size: 14px;
				font-weight: 700;
				box-shadow: 0px 15px 15px rgba(var(--main-color-2), 0.2);
				border-radius: 5px;
				transition: all ease-in-out .5s;
				outline: none !important;
				box-shadow: none !important;
			}

			.section-auth .btn::after {
				content: "";
				display: block;
				position: absolute;
				top: 0;
				left: 25%;
				height: 100%;
				width: 50%;
				background-color: #fff;
				border-radius: 50%;
				opacity: 0;
				pointer-events: none;
				transition: all ease-in-out 0.5s;
				transform: scale(5, 5);
			}

			.section-auth .btn:active::after {
				padding: 0;
				margin: 0;
				opacity: .2;
				transition: 0s;
				transform: scale(0, 0);
			}

			.section-auth .btn-theme {
				background-color: var(--main-color);
				border-color: var(--main-color);
				color: var(--white-color) !important;
			}

			.section-auth .btn-theme:hover,
			.section-auth btn-theme:focus {
				background-color: rgb(var(--main-color-2), .8);
			}

			.section-auth .card {
				padding: 3%;
				background-color: var(--white-color);
				border-radius: var(--radius-sm);
				box-shadow: var(--shadow);
				border: none;
                width: 100%;
				max-width: 100%;
				margin: auto;
			}

			.section-auth .section-title .logo {
				max-width: 130px;
				margin: 0 auto 2.5rem;
			}

			.section-auth .section-title .title {
				color: #475057;
				font-size: 18px;
				font-weight: 700;
				margin-bottom: 1rem;
			}

			.section-auth .section-title .sub-title {
				color: var(--dark-color);
				font-size: 16px;
				font-weight: 400;
				margin-bottom: 1rem;
			}

			.section-auth .section-title .info {
				color: var(--dark-color);
				font-size: 16px;
				font-weight: 400;
				margin-bottom: 1rem;
			}

			.section-auth .section-auth .btn {
				border-radius: 5px;
			}

			.section-auth .disabled {
				pointer-events: none;
				opacity: .85
			}
			.section-auth .form .form-label {
				font-size: 14px;
				font-weight: 400;
				color: var(--dark-color);
			}

			.section-auth .form .forget-password {
				color: var(--main-color);
			}

			.section-auth .form .form-control {
				min-height: 40px;
				border-color: #c5c5c5;
				border-radius: 5px;
				padding: 0;
				padding-left: 1rem;
				padding-right: 1rem;
				font-size: .8125rem;
				background-image: none
			}
			.section-auth .form-control.is-invalid,
			.section-auth .was-validated .form-control:invalid {
				border-color: #dc3545;
			}
			.section-auth .form .form-control::placeholder {
				color: #BDBDBD;
			}
			
			.section-auth .password-box {
				position: relative;
			}

			.section-auth .password-box .form-control {
				padding-inline-end: 80px;
			}

			.section-auth .password-box .show-hide-password {
				position: absolute;
				top: 0;
				left: 0;
				width: 60px;
				height: 50px;
				line-height: 44px;
				cursor: pointer;
				text-align: center;
			}

			[dir="ltr"] .section-auth .password-box .show-hide-password {
				left: auto;
				right: 0;
			}

			[dir="rtl"] .section-auth .password-box .show-hide-password {
				left: 0;
				right: auto;
			}

			input::-ms-reveal,
			input::-ms-clear {
				display: none;
			}
		</style>

		<link rel="shortcut icon" href="{{ URL::to('/') }}/admin-assets/assets/soft.svg" />
        <title> @yield('title') </title>
    </head>
    <body>
		@yield('content')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
    </body>
</html>