@extends('main')
@section('title','| add a doctor')


@section('stylesheets')

    {!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light">
        <h1>Add a Doctor</h1>
        <hr>
        {!! Form::open(['route' => 'doctors.store','data-parsley-validate'=>'']) !!}
    
            <div class="form-group">
            {{Form::label('doctorName', 'Doctor Name')}}
            {{Form::text('doctorName',null,['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
            </div>

            <div class="form-group">
                    {{Form::label('clinic_id', 'Clinic')}}
                    <select class="form-control" name="clinic_id" id="">
                            <option value="" selected disabled>Select Clinic</option>
                        @foreach ($clinics as $clinic)
                            <option value="{{$clinic->id}}">{{$clinic->clinicName}}</option>   
                        @endforeach
                        
                    </select>
            </div>


            <div class="form-group">
                {{Form::label('level_id', 'Level')}}
                <select class="form-control" name="level_id" id="">
                        
                    @foreach ($levels as $level)
                        <option value="{{$level->id}}">{{$level->levelName}}</option>   
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
                    {{Form::label('notes', 'Notes')}}
                    {{Form::textarea('notes',null,['class'=>'form-control'])}}
            </div>


            {{Form::submit('Add Doctor',['class'=>'btn btn-success btn-lg btn-block'])}}
    
        {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')

{!!Html::script('js/parsley.min.js')!!}
@endsection