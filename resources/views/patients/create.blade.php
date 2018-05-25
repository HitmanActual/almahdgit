@extends('main')

@section('title','| add a doctor')


@section('stylesheets')

    {!!Html::style('css/parsley.css')!!}
    {!!Html::style('//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
    {!!Html::style('css/select2.min.css') !!}
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light">
        <h1>Add a Patient</h1>
        <hr>
        {!! Form::open(['route' => 'patients.store','data-parsley-validate'=>'']) !!}
    
            <div class="form-group">
            {{Form::label('patientName', 'Patient Name')}}
            {{Form::text('patientName',null,['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
            </div>

            <div class="form-group">
                {{Form::label('patientSex', 'Sex :')}}
                {{Form::select('patientSex',[''=>'please select','male'=>'ذكر','female'=>'انثى'],null,['class'=>'form-control','required'=>'','minlength'=>'3','maxlength'=>'4'])}}
            </div>

            <div class="form-group">
                {{Form::label('dob', 'Date of Birth:')}}
                {{Form::text('dob',null,['id'=>'datepicker'],['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
            </div>

            <div class="form-group">
                    {{Form::label('clinics', 'Clinic-(s):')}}
                    <select class="form-control select2-multi" name="clinics[]" multiple = "multiple" required>
                        @foreach($clinics as $clinic)
                    <option value='{{$clinic->id}}'>{{$clinic->clinicName}}</option>
                        @endforeach
                    </select>
            </div>


            <div class="form-group">
                    {{Form::label('phoneOne', 'Mobile No.1')}}
                    {{Form::text('phoneOne',null,['class'=>'form-control','required'=>'','minlength'=>'11','maxlength'=>'11'])}}
            </div>

            <div class="form-group">
                    {{Form::label('phoneTwo', 'Mobile No.2')}}
                    {{Form::text('phoneTwo',null,['class'=>'form-control','minlength'=>'11','maxlength'=>'11','data-parsley-type'=>'integer'])}}
            </div>

            <div class="form-group">
                    {{Form::label('patientAddress', 'Address')}}
                    {{Form::text('patientAddress',null,['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
            </div>

            <div class="form-group">
                    {{Form::label('notes', 'Notes')}}
                    {{Form::textarea('notes',null,['class'=>'form-control'])}}
            </div>


            {{Form::submit('Add Patient',['class'=>'btn btn-success btn-lg btn-block'])}}
    
        {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')

{!!Html::script('js/parsley.min.js')!!}

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  {!!Html::script('js/select2.full.min.js')!!}
  <script>
    //select2
    $(function(){
        $(".select2-multi").select2();
    })
  </script>

  <script>
  
    //datepicker 
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
  </script>
@endsection