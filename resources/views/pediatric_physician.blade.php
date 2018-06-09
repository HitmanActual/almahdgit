@extends('layouts.physicians')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Physician Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Pediatric Physician!
                    
                </div>

                <div class="row">
                    <div class="col-md-12 mt-5">
                        <table class="table table-hover">
                            <thead>
                                <th>Clinic</th>
                                <th>Patient</th>
                                <th>Doctor</th>                
                                <th>نوع الكشف</th>  
                                <th>Price</th>                                              
                                <th>Created at</th>
                                <th>Details</th>
                                
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                    <td>{{$visit->clinics->clinicName}}</td>
                                    <td><a href="{{route('pediatric_patient.show',$visit->patients->id)}}"}> {{$visit->patients->patientName}}</a></td>
                                    <td> <a href="{{route('doctors.show',$visit->doctors->id)}}">{{$visit->doctors->doctorName}}</a></td>
                                    <td>{{$visit->visitTypes->visitName}}</td>
                                    <td>{{$visit->price}}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td> 
                                    <td><a href="{{route('visits.show',$visit->id)}}" class="btn btn-xs btn-outline-dark"><span class="fa fa-eye"></span></a></td>                       
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
