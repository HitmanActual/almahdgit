@extends('main')
@section('title','| doctors')

@section('content')

<div class="row mt-5">
    <div class="col-md-9">
        <h1>All Doctors</h1>
    </div>

    <div class="col-md-3">
    <a href="{{route('doctors.create')}}" class="btn btn-outline-info btn-block btn-lg">Add a New Doctor</a>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Level</th>
                <th>Speciality</th>                
                <th>Phone One</th>
                <th>Phone Two</th>
                <th>Details</th>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                    <td>{{$doctor->doctorName}}</td>
                    <td>{{$doctor->level->levelName}}</td>
                    <td>{{$doctor->clinic->clinicName}}</td>
                    <td>{{$doctor->phoneOne}}</td>
                    <td>{{$doctor->phoneTwo}}</td>
                    <td>{!!Html::linkRoute('doctors.show','Details',[$doctor->id],['class'=>'btn btn-info btn-block'])!!}</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

<div class="row">
        <div class="mx-auto">
                {!!$doctors->links();!!}
        </div>
            
</div>

@endsection