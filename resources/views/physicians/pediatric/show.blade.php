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
        @if($patient->pediatric_basic_infos != null)
        <h4 class="text-center text-info">Family History</h4>
        <h5><u>Parents</u></h5>   
        <p><strong>consanguinity : </strong>{{$patient->pediatric_basic_infos->consanguinity}}</p>
        <p><strong>occupation : </strong>{{$patient->pediatric_basic_infos->occupation}}</p>

        <h5><u>Siblings</u></h5>
        <p><strong>Number : </strong>{{$patient->pediatric_basic_infos->numberOfSiblings}}</p>
        <p><strong>Age : </strong>{{$patient->pediatric_basic_infos->age}}</p>
        <p><strong>Sex : </strong>{{$patient->pediatric_basic_infos->sex}}</p>
        <p><strong>Similar Condition : </strong>{{$patient->pediatric_basic_infos->similarCondition}}</p>

        <h5><u>Significant event at the family</u></h5>
        <p><strong>Congenital Anomalies : </strong>{{$patient->pediatric_basic_infos->congenitalAnomalies}}</p>
        <p><strong>D.M : </strong>{{$patient->pediatric_basic_infos->dm}}</p>
        <p><strong>Allergy : </strong>{{$patient->pediatric_basic_infos->allergy}}</p>
        <hr>
        <h4 class="text-center text-info">Perinatal History</h4>
        <h5><u>Maternal illness during pregnancy : </u></h5>
        <p><strong>D.M : </strong>{{$patient->pediatric_basic_infos->dmOne}}</p>
        <p><strong>Medications : </strong>{{$patient->pediatric_basic_infos->medications}}</p>
        <p><strong>Type of labor : </strong>{{$patient->pediatric_basic_infos->typeOfLabor}}</p>
        <p><strong>Duration of Pregnancy : </strong>{{$patient->pediatric_basic_infos->durationOfPregnancy}}</p>

        <h5><u>Postnatal H: </u></h5>
        <p><strong>Jaundice : </strong>{{$patient->pediatric_basic_infos->jaundice}}</p>
        <p><strong>R.D : </strong>{{$patient->pediatric_basic_infos->rd}}</p>
        <p><strong>Birth Weight : </strong>{{$patient->pediatric_basic_infos->birthWeight}}</p>
        <hr>
        <h4 class="text-center text-info">past History</h4>
        <h5><u>Disease : </u></h5>

        <p><strong>Allergy : </strong>{{$patient->pediatric_basic_infos->allergyOne}}</p>
        <p><strong>Operation : </strong>{{$patient->pediatric_basic_infos->operation}}</p>
        <p><strong>Chronical illness : </strong>{{$patient->pediatric_basic_infos->chronicalIllness}}</p>
        <p><strong>Truma, Accident : </strong>{{$patient->pediatric_basic_infos->trumaAndAccident}}</p>

        <hr>
        <h4 class="text-center text-info">Nutritional History</h4>
        <p><strong>Type Of Feeding : </strong>{{$patient->pediatric_basic_infos->typeOfFeeding}}</p>
        <p><strong>Iron Sup : </strong>{{$patient->pediatric_basic_infos->ironSup}}</p>
        <p><strong>Nutrittional Disorder : </strong>{{$patient->pediatric_basic_infos->nutrittionalDisorder}}</p>
        <p><strong>Onset Of weaning : </strong>{{$patient->pediatric_basic_infos->onsetOfweaning}}</p>
        <p><strong>Vit D Ca Supp : </strong>{{$patient->pediatric_basic_infos->vitDCaSupp}}</p>

        @endif

    </div>

    <div class="col-md-4 mx-auto">
        <div class="card card-body bg-light">
           
            <div class="row">
                    <div class="col-md-12">
                        
                        @if($patient->image)
                        <a href="/docs/{{$patient->id}}" class="btn btn-outline-dark btn-block">Download Previous Patient's File</a>
                        @elseif($patient->pediatric_basic_infos == null)
                        <a href="{{route('add_basic_info',$patient->id)}}" class="btn btn-success btn-block"><span class="fa fa-medkit"></span> Add Basic Information</a>
                        @endif
                    </div>
            </div>
            
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('pediatric_visit',$patient->id)}}" class="btn btn-primary btn-block"><span class="fa fa-medkit"></span> Add New Visit </a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    @if($patient->pediatric_basic_infos != null)
                        <a href="{{route('edit_basic_info',$patient->pediatric_basic_infos->id)}}" class="btn btn-warning btn-block"><span class="fa fa-edit"></span> Edit Patient's History</a>
                        <hr>
                    @endif
                    <a href="{{route('prescription',$patient->id)}}" class="btn btn-success btn-block"><span class="fa fa-medkit"></span> Add Prescription</a>
                </div>
            </div>

            
        </div>
        <hr>
        <div class="card card-body bg-light">
        <a href="{{route('pediatricPrescription.display',$patient->id)}}" class="btn btn-info btn-block">Display Prescriptions</a>
        </div>
    </div>
    
</div>


@endsection