@extends('layouts.app')

@section('content')

<?php $num = 0; ?>

@foreach ($questions as $question)

	@if ($question['type'] == 'singleChoice')

		@if($question['noAnswer'] == 0)

			<?php $name = 'PC'.$num; ?>

			<div id="{{ $name }}"></div>

			{!! \Lava::render('PieChart', $question['label'], $name) !!}

			<?php $num++; ?>

		@else

		<div>
			{{ $question['label'] }}
		</div>

		<div>
			Pas de réponse.
		</div>
		
		@endif

	@endif

@endforeach

@endsection