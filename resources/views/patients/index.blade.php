@extends('main')
@section('title','| Patients')

@section('content')

<div class="row mt-5">
    <div class="col-md-9">
        <h1>All Patients</h1>
    </div>

    <div class="col-md-3">
    <a href="{{route('patients.create')}}" class="btn btn-outline-info btn-block btn-lg">Add a New Patient</a>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Sex</th>
                <th>Address</th>                
                <th>Phone One</th>
                <th>Phone Two</th>
                <th>Date of Birth</th>
                <th>Details</th>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                    <td>{{$patient->patientName}}</td>
                    <td>{{$patient->patientSex}}</td>
                    <td>{{$patient->patientAddress}}</td>
                    <td>{{$patient->phoneOne}}</td>
                    <td>{{$patient->phoneTwo}}</td>
                    <td>{{$patient->dob}}</td>
                    <td>{!!Html::linkRoute('patients.show','Details',[$patient->id],['class'=>'btn btn-outline-dark btn-block'])!!}</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>


<div class="row">
    <div class="mx-auto">
            {!!$patients->links();!!}
    </div>
        
</div>

@endsection