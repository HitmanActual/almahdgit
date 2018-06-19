@extends('physician_main')
@section('title','| doctors')

@section('content')

<div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <h1>Add Basic Information</h1>
            <hr>
        <p><strong> Name : </strong>{{$patient->patientName}}</p>
        <p><strong> Date of Birth : </strong>{{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y')}}</p>
        <p><strong>Age:</strong><span> {{\Carbon\Carbon::parse($patient->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></p>
        <p><strong>Sex:</strong> {{$patient->patientSex}}</p>

            <hr>
            <h4 class="text-center">Family History</h4>
            <!--the basic pediatric info form-->

            {!! Form::open(['route' => ['add_basic_info.store',$patient->id],'data-parsley-validate'=>'']) !!}
            <h5 class="bg-light text-dark">Parents</h5>
            <div class="form-group">
                    {{Form::label('consanguinity', 'Consanguinity')}}
                    {{ Form::text('consanguinity',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('occupation', 'occupation',['id'=>'occupation'])}}
                    {{ Form::text('occupation',null, ['class' => 'form-control']) }}
            </div>

            <h5 class="bg-light text-dark">Siblings</h5>

            <div class="form-group">
                    {{Form::label('numberOfSiblings', 'Number ')}}
                    {{ Form::text('numberOfSiblings',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('age', 'Age ')}}
                    {{ Form::text('age',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('sex', 'sex ')}}
                    {{ Form::text('sex',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('similarCondition', 'Similar Condition ')}}
                    {{ Form::text('similarCondition',null, ['class' => 'form-control']) }}
            </div>

            <h6><u>Significant event at the family :</u></h6>

            <div class="form-group">
                    {{Form::label('congenitalAnomalies', 'congenital anomalies ')}}
                    {{ Form::text('congenitalAnomalies',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('allergy', 'Allergy')}}
                    {{ Form::text('allergy',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('dm', 'D.M')}}
                    {{ Form::text('dm',null, ['class' => 'form-control']) }}
            </div>

            <hr>

            <h5 class="bg-light text-dark">Perinatal History</h5>
            <div class="form-group">
                    {{Form::label('dmOne', 'D.M')}}
                    {{ Form::text('dmOne',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('typeOfLabor', 'Type Of Labor')}}
                    {{ Form::text('typeOfLabor',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('medications', 'Medications ')}}
                    {{ Form::text('medications',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('durationOfPregnancy', 'Duration Of Pregnancy ')}}
                    {{ Form::text('durationOfPregnancy',null, ['class' => 'form-control']) }}
            </div>

            <h6><u>Postnatal H :</u></h6>

            <div class="form-group">
                    {{Form::label('jaundice', 'Jaundice')}}
                    {{ Form::text('jaundice',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('rd', 'R.D')}}
                    {{ Form::text('rd',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('birthWeight', 'Birth Weight')}}
                    {{ Form::text('birthWeight',null, ['class' => 'form-control']) }}
            </div>

            <h5 class="bg-light text-dark">Past History</h5>
            <h6><u>Disease :</u></h6>

            <div class="form-group">
                    {{Form::label('allergyOne', 'Allergy')}}
                    {{ Form::text('allergyOne',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('operation', 'Operation')}}
                    {{ Form::text('operation',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('chronicalIllness', 'Chronical illness')}}
                    {{ Form::text('chronicalIllness',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('trumaAndAccident', 'truma, accident')}}
                    {{ Form::text('trumaAndAccident',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                    {{Form::label('infection', 'infection')}}
                    {{ Form::text('infection',null, ['class' => 'form-control']) }}
            </div>

            <h5 class="bg-light text-dark">Nutritional History</h5>

            <div class="form-group">
                {{Form::label('typeOfFeeding', 'Type Of Feeding')}}
                {{ Form::text('typeOfFeeding',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{Form::label('ironSup', 'Iron Sup')}}
                {{ Form::text('ironSup',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{Form::label('nutrittionalDisorder', 'Nutrittional Disorder')}}
                {{ Form::text('nutrittionalDisorder',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{Form::label('onsetOfweaning', 'Onset Of weaning')}}
                {{ Form::text('onsetOfweaning',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{Form::label('vitDCaSupp', 'Vit D Ca Supp')}}
                {{ Form::text('vitDCaSupp',null, ['class' => 'form-control']) }}
            </div>
        

            {{Form::submit('Save Basic Information',['class'=>'btn btn-success btn-lg btn-block'])}}

            {{Form::close()}}



@endsection