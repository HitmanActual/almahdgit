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

    </div>

    <div class="col-md-4 mx-auto">
        <div class="card card-body bg-light">
           
            <div class="row">
                    <div class="col-md-12">
                        
                        @if($patient->image)
                        <a href="/docs/{{$patient->id}}" class="btn btn-outline-dark btn-block">Download Previous Patient's File</a>
                        @else
                        <p>Nothing to be downloaded</p>
                        @endif
                    </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                <a href="{{route('add_basic_info',$patient->id)}}" class="btn btn-success btn-block"><span class="fa fa-medkit"></span> Add Basic Information</a>
                </div>
                

            </div>
        </div>
    </div>
    
</div>


@endsection