@extends('main')
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
            <strong>Clinics :</strong>
            @foreach($patient->clinics as $clinic)
            <span class="badge badge-secondary">{{$clinic->clinicName}}</span>
            @endforeach
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
                <a href="{{route('visit',$patient->id)}}" class="btn btn-success btn-block"><span class="fa fa-plus"></span> Add a Visit</a>
                </div>
                

            </div>
            <hr>
            <dl class="dl-horizontal">
                <dt>Created at:</dt>
                <dd>{{$patient->created_at->diffForHumans()}}</dd>
            </dl>

            <dl class="dl-horizontal">
                    <dt>Updated at:</dt>
            <dd>{{$patient->updated_at->diffForHumans()}}</dd>
            </dl>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    {!!Html::linkRoute('patients.edit','Edit',[$patient->id],['class'=>'btn btn-warning btn-block'])!!}
                </div>
                <div class="col-md-6">
                    {!!Form::open(['route'=>['patients.destroy',$patient->id],'method'=>'DELETE'])!!}
                    {!!Form::submit('Delete',['class'=>'btn btn-danger btn-block'])!!}
                    {!!Form::close()!!}
                </div>
                
            </div>
            <hr>
            <div class="row">
                    <div class="col-md-12">
                            <a href="/patients" class="btn btn-outline-dark btn-block">عرض كل المرضى</a>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-md-12">
    <hr>
    <h4>Visits History <span class="badge badge-success">{{$counter}}</span></h4>
        <table class="table table-hover">
            <thead>
                <th>Clinic</th>
                <th>Doctor</th>                
                <th>نوع الكشف</th>  
                <th>Price</th>                                              
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                    <td>{{$visit->clinics->clinicName}}</td>
                    <td>{{$visit->doctors->doctorName}}</td>
                    <td>{{$visit->visitTypes->visitName}}</td>
                    <td>{{$visit->price}}</td>
                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td>
                    <td>
                    <a href="{{route('visits.edit',$visit->id)}}" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                        <a href="#" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span></a>
                    </td>
             
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection