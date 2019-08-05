@extends('layouts.app')

@section('content')
<div class="container">	 
	<div class="row">
		@include('flash::message')
		<!--{!! Auth::user()->permissions()->where('page', 'like', '%index')->pluck('page') !!}-->

		<div id="chart1"></div>

		{!! $chart1 !!}
	</div>
</div>
@endsection
