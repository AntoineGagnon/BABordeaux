@extends('layouts.app')

@section('content')

<?php $num = 0; ?>

<div style="background-color:white;">

@foreach ($questions as $question)

	@if ($question['type'] == 'singleChoice' || $question['type'] == 'multipleChoice')

		@if($question['noAnswer'] == 0)

			<?php $name = 'PC'.$num; ?>

			<div id="{{ $name }}"></div>

			{!! \Lava::render('PieChart', $question['label'], $name) !!}

			<?php $num++; ?>

		@else

		<div style="background-color:white;">
			<p style="font-weight:bold; margin-left: 110px;">{{ $question['label'] }}
			</br>Pas de réponse.</p>
			</br>
		</div>
		
		@endif

	@elseif ($question['type'] == 'openAnswer')

		@if($question['nbAnswers'] != 0)

			<div style="background-color:white;">
				<p style="font-weight:bold; margin-left: 110px;">
					{{ $question['label'] }}
				</p>

				<div style="background-color:white; margin-left: 110px; margin-right: 110px; border:solid black 0.5px; max-height:300px; overflow-y:scroll;">
				@for ($i = 0; $i < $question['nbAnswers']; $i++)

					<p style="margin-left: 10px;"><em>{{ $question['answers'][$i] }}</em></p>

				@endfor
				</div>
			</div>

		@else

			<div style="background-color:white;">
				<p style="font-weight:bold; margin-left: 110px;">{{ $question['label'] }}
				</br>Pas de réponse.</p>
				</br>
			</div>
		
		@endif

	@endif

@endforeach

<div>

@endsection