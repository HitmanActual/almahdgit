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

                    You are logged in as Derma Physician!
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <table class="table table-hover">
                            <thead>
                                <th>Created at</th>
                                <th>Clinic</th>
                                <th>Patient</th>                                              
                                <th>نوع الكشف</th>  
                                <th>Details</th>                               
                                <th>Archive</th>                               
                            </thead>
                            <tbody>
                                

                                @foreach ($visits as $visit)
                                    <tr>
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td> 
                                    <td>{{$visit->clinics->clinicName}}</td>
                                    <td>{{$visit->patients->patientName}}</td>
                                    <td>{{$visit->visitTypes->visitName}}</td>

                                    <td><a href="{{route('orthopedic_patient.show',$visit->patients->id)}}" class="btn btn-outline-dark btn-block"}>Details</a></td>
                                    <td><a href="{{route('orthopedic_patient.archive',$visit->id)}}" class="btn btn-outline-success btn-block"}>Archive</a></td>
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


