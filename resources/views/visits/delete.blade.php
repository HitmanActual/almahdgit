@extends('main')
@section('title','| Delete Visit')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h3>Are You Sure You want to delete this visit ?</h3>

        <p>{{$visit->clinics->clinicName}}</p>
        <p>{{$visit->doctors->doctorName}}</p>
        <p>{{$visit->visitTypes->visitName}}</p>
        <p>{{$visit->price}}</p>
        {{Form::open(['route'=>['visits.destroy',$visit->id],'method'=>'DELETE'])}}
        {{Form::submit('Yes Delete This Visit',['class'=>'btn btn-lg btn-block btn-danger'])}}
        {{Form::close()}}
    </div>
</div>

@endsection