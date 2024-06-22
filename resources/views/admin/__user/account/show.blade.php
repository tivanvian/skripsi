@extends('layouts.simple.master')

@section('title', $pages['show']['title'] ?? '-' )

@push('css')
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['show']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['show']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="user-profile">
		<div class="row">
			<div class="col-sm-12 m-t-30">
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 m-t-50">
				<div class="card hovercard text-center">
					{{-- <div class="cardheader"></div> --}}
					<div class="user-image">
						<div class="avatar">
							<img alt=""  src="{{ ShowFile(RenderJson(Auth::user()->profile, "photo"), 'uploads/avatar/', 
        'image', Auth::user()->name) }}">
						</div>
						<a href="{{ route('user.account_edit', $data->username) }}">
							<div class="icon-wrapper">
								<i class="icofont icofont-pencil-alt-5"></i>
							</div>
						</a>
					</div>

					<div class="info">
						<div class="row text-center">
							<div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">&nbsp;</div>
							<div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
								<div class="user-designation">
									<div class="title"><a target="_blank" href="">{{ $data->name }}</a></div>
									<div class="desc">{{ $data->role->name }}</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">&nbsp;</div>
						</div>
						<hr>
						{{-- <div class="social-media">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div> --}}
						<div class="follow">
							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Email</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ $data->email }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Username</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ $data->username }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Position</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ RenderJson($data->profile, "jabatan") }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Handphone/Whatsapp</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ RenderJson($data->profile, "no_hp") }}</div>
								</div>
							</div>

						</div>
					</div>

					<br>

					<div class="text-end">
						<a class="btn btn-warning m-10" href="{{ route($pages['dashboard']) }}">Back</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('script')

@endpush
