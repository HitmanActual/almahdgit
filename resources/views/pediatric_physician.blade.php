@extends('layouts.physicians')
@section('stylesheets')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endsection

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
                                <th>Created at</th>
                                <th>Clinic</th>
                                <th>Patient</th>
                                               
                                <th>نوع الكشف</th>  
                                                                              
                                
                                <th>Medical History</th>
                                
                                
                            </thead>
                            <tbody>
                                

                                @foreach ($visits as $visit)
                                    <tr>
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td> 
                                    <td>{{$visit->clinics->clinicName}}</td>
                                    <td><a href="{{route('pediatric_patient.show',$visit->patients->id)}}"}> {{$visit->patients->patientName}}</a></td>
                                    <td>{{$visit->visitTypes->visitName}}</td>
                                    <td>

                                        @if($visit->patients->image)
                                        <a href="/docs/{{$visit->patients->id}}" class="btn btn-outline-dark btn-block">Download Previous Patient's File</a>
                                        @else
                                        <a href="{{route('add_basic_info',$visit->patients->id)}}" class="btn btn-success btn-block"><span class="fa fa-medkit"></span> Add Basic Information</a>

                                        @endif
                                    </td>
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


