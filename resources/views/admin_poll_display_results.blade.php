@extends('layouts.app')

@section('content')

<div id="test"></div>

{!! \Lava::render('PieChart', 'Age', 'test') !!}

@endsection