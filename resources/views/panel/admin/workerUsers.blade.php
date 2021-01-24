@extends('app')
@section('panelTitle', 'Lista de Empleados')

@section('panelContent')
    @if(!empty($users))
        {{dump($users)}}
    @endif
@endsection


