@extends('layouts.layout')

@section('page-header')
<h1>Relatório Aluno</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('aluno') }}"> Aluno</a></li>
	<li class="active"> Relatório</li>
</ol>
@endsection

@section('content')

@endsection
