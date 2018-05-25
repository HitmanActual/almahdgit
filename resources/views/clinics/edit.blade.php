@extends('main')
@section('title','| Edit a clinic')


@section('stylesheets')

    {!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <h1>Edit a Clinic</h1>
        <hr>
        {!! Form::model($clinic,['route' =>['clinics.update',$clinic->id],'method'=>'PUT','data-parsley-validate'=>'']) !!}

            <div class="form-group">
            {{Form::label('clinicName', 'Clinic Name')}}
            {{Form::text('clinicName',null,['class'=>'form-control','required'=>'','maxlength'=>'255'])}}
            </div>

            <div class="row">
                <div class="col-md-4">
                        {!!Html::linkRoute('clinics.index','Cancel',[$clinic->id],['class'=>'btn btn-info btn-lg btn-block'])!!}
                </div>
                <div class="col-md-4">
                        {{Form::submit('Update Clinic',['class'=>'btn btn-lightdark btn-lg btn-block'])}}
                </div>

                <div class="col-md-4">
                        {!!Form::open(['route'=>['clinics.destroy',$clinic->id],'method'=>'DELETE'])!!}
                        {!!Form::submit('Delete',['class'=>'btn btn-danger btn-lg btn-block'])!!}
                        {!!Form::close()!!}
                </div>
            </div>
            

        {!! Form::close() !!}
    </div>
</div>

<div class="row mt-5">
        <div class="col-md-3 mx-auto">
            
        </div>
</div>

@endsection

@section('scripts')

{!!Html::script('js/parsley.min.js')!!}
@endsection