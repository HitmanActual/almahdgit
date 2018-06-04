@extends('main')
@section('title','| doctors')
@section('stylesheets')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <h3>الدكتور/{{$doctor->doctorName}}</h3>
        <div class="row">
        <div class="col-md-6"><strong> الدرجة : </strong>{{ $doctor->level->levelName}}</div>
        <div class="col-md-6"><strong> التخصص : </strong>{{ $doctor->clinic->clinicName}}</div>
        </div>
        <hr>
        <p class="lead"><strong>رقم تليفون  :</strong> {{str_pad($doctor->phoneOne,11,'0',STR_PAD_LEFT)}}</p>
        <p class="lead"><strong>رقم تليفون  :</strong> {{$doctor->phoneTwo ? str_pad($doctor->phoneTwo,11,'0',STR_PAD_LEFT) : 'لا يوجد رقم آخر'}}</p>
        <p class="lead"><strong>Notes: </strong>{{$doctor->notes}}</p>

    </div>
    <div class="col-md-4 mx-auto">
        <div class="card card-body bg-light">
            <dl class="dl-horizontal">
                <dt>Created at:</dt>
                <dd>{{$doctor->created_at->diffForHumans()}}</dd>
            </dl>

            <dl class="dl-horizontal">
                    <dt>Updated at:</dt>
            <dd>{{$doctor->updated_at->diffForHumans()}}</dd>
            </dl>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    {!!Html::linkRoute('doctors.edit','Edit',[$doctor->id],['class'=>'btn btn-warning btn-block'])!!}
                </div>
                <div class="col-md-6">
                    {!!Form::open(['route'=>['doctors.destroy',$doctor->id],'method'=>'DELETE'])!!}
                    {!!Form::submit('Delete',['class'=>'btn btn-danger btn-block'])!!}
                    {!!Form::close()!!}
                </div>
                
            </div>
            <hr>
            <div class="row">
                    <div class="col-md-12">
                            <a href="/doctors" class="btn btn-outline-dark btn-block">عرض كل الأطباء</a>
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
                <th>Patient</th>                
                <th>نوع الكشف</th>  
                <th>Price</th>                                              
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                    <td>{{$visit->clinics->clinicName}}</td>
                    <td><a href="{{route('patients.show',$visit->patients->id)}}"> {{$visit->patients->patientName}}</a></td>
                    <td>{{$visit->visitTypes->visitName}}</td>
                    <td>{{$visit->price}}</td>
                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td>
                    <td>
                    <a href="{{route('visits.show',$visit->id)}}" class="btn btn-xs btn-outline-dark"><span class="fa fa-eye"></span></a>
                    <a href="{{route('visits.edit',$visit->id)}}" class="btn btn-xs btn-info"><span class="fa fa-edit"></span></a>
                    <a href="{{route('visits.delete',$visit->id)}}" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span></a>
                    </td>
             
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>

@endsection