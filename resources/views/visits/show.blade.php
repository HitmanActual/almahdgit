@extends('main')
@section('title','| patients')
@section('stylesheets')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
    <h3>Name: {{$visit->patients->patientName}}</h3>
    <p><strong> Date of Birth : </strong>{{ \Carbon\Carbon::parse($visit->patients->dob)->format('d/m/Y')}}</p>
    <p><strong>Age:</strong><span> {{\Carbon\Carbon::parse($visit->patients->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></p>
    <p><strong>Sex:</strong> {{$visit->patients->patientSex}}</p>
    <hr>
    <p><strong>Clinic: </strong>{{$visit->clinics->clinicName}}</p>
    <p><strong>Doctor: </strong>{{$visit->doctors->doctorName}}</p>
    <p><strong>Visit Type: </strong>{{$visit->visitTypes->visitName}}</p>
    <p><strong>Price: </strong>{{$visit->price}}</p>


    </div>
    <div class="col-md-4 mx-auto">
        <div class="card card-body bg-light">
            <hr>
            <dl class="dl-horizontal">
                <dt>Created at:</dt>
                <dd>{{$visit->created_at->diffForHumans()}}</dd>
            </dl>

            <dl class="dl-horizontal">
                    <dt>Updated at:</dt>
            <dd>{{$visit->updated_at->diffForHumans()}}</dd>
            </dl>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    {!!Html::linkRoute('visits.edit','Edit',[$visit->id],['class'=>'btn btn-warning btn-block'])!!}
                </div>
                <div class="col-md-6">
                    {!!Form::open(['route'=>['visits.destroy',$visit->id],'method'=>'DELETE'])!!}
                    {!!Form::submit('Delete',['class'=>'btn btn-danger btn-block'])!!}
                    {!!Form::close()!!}
                </div>
                
            </div>
            <hr>
            <div class="row">
                    <div class="col-md-12">
                        
                        @if($visit->image)
                        <a href="/visit_doc/{{$visit->id}}" class="btn btn-outline-dark btn-block">Download Visit docs</a>
                        @else
                        <p>Nothing to be downloaded</p>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection