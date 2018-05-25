@extends('main')
@section('title','| add a clinic')


@section('stylesheets')

    {!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

<div class="row mt-5">
<div class="col-md-4 mx-auto">
    <div class="card card-body bg-light">
    <h1>Add a Clinic</h1>
    <hr>
    {!! Form::open(['route' => 'clinics.store','data-parsley-validate'=>'']) !!}

        <div class="form-group">
        {{Form::label('clinicName', 'Clinic Name')}}
        {{Form::text('clinicName',null,['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
        </div>
        {{Form::submit('Add Clinic',['class'=>'btn btn-success btn-lg btn-block'])}}

    {!! Form::close() !!}
    </div>
</div>


<div class="col-md-6 mx-auto">

    @if($clinics)
    <table class=table>
        <thead>
            <th>#</th>
            <th>العيادات</th>
            <th>Action</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($clinics as $clinic )
                <tr>
                    <td>{{$clinic->id}}</td>
                    <td>{{$clinic->clinicName}}</td>
                    <td>{!!Html::linkRoute('clinics.edit','Edit',[$clinic->id],['class'=>'btn btn-warning btn-block'])!!}</td>
                <td><a href="{{route('clinic_doctors',$clinic->id)}}" class = "btn btn-outline-dark btn-block">View Doctors <span class="badge badge-dark">{{$clinic->doctor->count()}}</span></a></td>
                <td><a href="{{route('clinic_patients',$clinic->id)}}" class = "btn btn-outline-info btn-block">View Patients <span class="badge badge-info">{{$clinic->patients->count()}}</span></a></td>
                
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>

@endsection

@section('scripts')

{!!Html::script('js/parsley.min.js')!!}
@endsection

