@extends('site.layout')
@section('title') @if($page) {{$page->title}} @endif @endsection
@section('content')
		<section class="section-auth">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-9 col-md-9">
						<div class="card mb-4">
							<div class="section-title text-center mb-4">
								<div class="logo">
									<a href="{{URL::to('/')}}">
										<img src="/admin-assets/assets/cyberx.png" height="28" class="img-fluid" alt="">
									</a>
								</div>
								<h1 class="title">{{$page->title ?? '-'}}</h1>
							</div> 
                            <div class="details">
                                {!! $page->details ?? '' !!}
                            </div>
							
						</div>
						<div class="copyright text-center">
							© {{date('Y')}} {{$setting->name}} 
						</div>
					
					</div>
				</div>
			</div>
		</section> 
		@endsection
		