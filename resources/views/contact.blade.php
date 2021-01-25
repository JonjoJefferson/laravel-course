@extends('layouts.app')

@section('content')

<h1>Contacsdt Page</h1>

@if (count($people))

@foreach($people as $person)

<li>{{ $person }}</li>



@endforeach
@endif



@section('footer')



@stop
