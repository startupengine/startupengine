@extends('layouts.app')

@section('css')
	<style>
		header {
			background: #222 !important;
			border-bottom:1px solid rgba(255,255,255,0.2);
		}
		#help_header {
			padding:50px 0px;background: #2b2b2b;
			box-shadow:0px 0px 50px rgba(0,0,0,0.35) !important;
		}
		#help_header h1, #help_header h4{
			padding:0px;margin:0px 0px 10px 0px;
			color:#fff;
		}
		#site-title {
			background: transparent !important;
			color: #fff !important;
		}
		.equal {
			display: -webkit-flex;
			display: flex;
		}
		.row.equal  panel {
			width:33% !important;
		}
		.col-container {
			display: table; /* Make the container element behave like a table */
			width: 100%; /* Set full-width to expand the whole page */
		}

		.col {
			display: block;
			width:calc(33% - 30px);
			float:left;
		}
		@media only screen and (max-width: 600px) {
			.col {
				display: block;
				width: 100%;
			}
		}
		@media only screen and (max-width: 1000px) and (min-width: 600px) {
			.col {
				width: 50%;
				float:left;
			}
		}
	</style>
@endsection

@section('content')

	<div id="help_header">
		<div class="container">
			<a class="back_btn" href="/help"><i class="chatter-back"></i></a>
			<h1 align="center">How can we help?</h1>
		</div>
		<div class="row" align="center" style="margin-top:10px;padding:15px;">
			<div class="col-md-4 col-md-offset-4">
				<div class="input-group input-group-lg">
					<input type="text" class="form-control" placeholder="Type something..." style="border-radius:25px 0px 0px 25px;padding-left:25px;">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" style="border-left:1px solid #ddd;border-radius:0px 25px 25px 0px;padding-right:25px;padding-left:20px;">Search</button>
				  </span>
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
	</div>
	<div id="help_categories" >
		<div class="col-container" style="padding:20px 10px 10px 10px;">
			<h4 align="center" style="margin-bottom:30px;">Categories</h4>
			<?php $count = 0; foreach($categories as $category) { $count = $count + 1; ?>
				<a href="/category/{{ $category->slug }}" style="margin:0px 10px; width:calc(50% - 20px) !important; float:left;">
					<div class="panel panel-default" style="padding:10px 25px;">
						<h5 align="center">{{ $category->name }}</h5>
					</div>
				</a>
			<?php } ?>
		</div>

	</div>
@endsection
