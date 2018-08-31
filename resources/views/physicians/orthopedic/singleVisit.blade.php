@extends('physician_main')
@section('title','| patients')
@section('stylesheets')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="mt-5"></div>
<h3 class="text-center">Visit Details</h3>
<p> <strong>C/O : </strong></p>
<p>{{$visit->co}}</p>

<p><strong>Clinical Finding : </strong></p>
<p>{{$visit->clinical_finding}}</p>

<p><strong>Investigations : </strong></p>
<p>{{$visit->investigations}}</p>

<p><strong>Treatment : </strong></p>
<p>{{$visit->treatment}}</p>

<p><strong>Diagnosis : </strong></p>
<p>{{$visit->diagnosis}}</p>

<hr>

<p class="text-right"><small><strong> by {{$test}}<strong></small></p>
<p class="text-right"><small>{{$visit->created_at->diffForHumans()}}</small></p>

@endsection