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

        
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Visits</h3>

        
                @foreach ($orthoVisits as $visit)
                <div class="card card-body bg-light mb-2">                   
                    <p>{{$visit->created_at->diffForHumans()}}</p>
                    <p>{!!Html::linkRoute('orthopedic_visit.show','Details',[$visit->id],['class'=>'btn btn-outline-info btn-block'])!!}</p>
                </div>
                @endforeach

    </div>
    
</div>



    </div>

    <div class="col-md-4 mx-auto">
            <div class="card card-body bg-light">
               
                <div class="row">
                        <div class="col-md-12">
                            @if($patient->image)
                            <a href="{{route('docxxx',$patient->id)}}" class="btn btn-outline-dark btn-block">Download Previous Patient's File</a>
                            @endif
                                <a href="{{route('orthopedic_visit',$patient->id)}}" class="btn btn-primary btn-block"><span class="fa fa-medkit"></span> Add New Visit </a>
                        </div>
                </div>
            </div>
        </div>
</div>
@endsection