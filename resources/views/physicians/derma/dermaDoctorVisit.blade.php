@extends('physician_main')
@section('title','| patients')
@section('stylesheets')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
    <h3>Name: {{$patient->patientName}}</h3>
    <p><strong> Date of Birth : </strong>{{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y')}}</p>
    <p><strong>Age:</strong><span> {{\Carbon\Carbon::parse($patient->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></p>
    <p><strong>Sex:</strong> {{$patient->patientSex}}</p>
        <div>
            
            <hr>
            <p class="lead"><strong>Phone :</strong> {{str_pad($patient->phoneOne,11,'0',STR_PAD_LEFT)}}</p>
            <p class="lead"><strong>Phone :</strong> {{$patient->phoneTwo ? str_pad($patient->phoneTwo,11,'0',STR_PAD_LEFT) : 'لا يوجد رقم آخر'}}</p>
            <p class="lead"><strong>Address: </strong>{{$patient->patientAddress}}</p>
            <p class="lead"><strong>Notes: </strong>{{$patient->notes}}</p>
        </div>
        <hr>

        {!! Form::open(['route' => ['dermaVisit.store',$patient->id],'data-parsley-validate'=>'']) !!}

        <div class="form-group">
            {{Form::label('allergy', 'Allergy')}}
            {{ Form::text('allergy',null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{Form::label('diagnosis', 'Diagnosis')}}
            {{ Form::textarea('diagnosis',null, ['class' => 'form-control']) }}         
        </div>

        
        {{Form::submit('Save Visit',['class'=>'btn btn-success btn-lg btn-block'])}}



        




        {!!Form::close()!!}

@endsection