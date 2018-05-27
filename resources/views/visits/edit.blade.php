@extends('main')
@section('title','| Edit Visit')
@section('content')



<div class="row mt-5">
        <h1>Edit Visit</h1>
        <div class="col-md-12"> 
        <p><strong>Patient Name :</strong> {{$visit->Patients->patientName}}</p>
        <p><strong>Clinic :</strong> {{$visit->clinics->clinicName}}</p>
        <p><strong>Doctor :</strong> {{$visit->doctors->doctorName}}</p>

        {{Form::model($visit,['route'=>['visits.update',$visit->id],'method'=>'PUT'])}}

        <div class="form-group">
        {{Form::select('visitType_id',$visitTypes,null,['class'=>'form-control','id'=>'visitTypes'])}}  
        </div>
                
        <div class="form-group">
        {{Form::label('price', 'Price EGP',['id'=>'priceLabel'])}}
        {{ Form::text('price',null, ['class' => 'form-control', 'id'=>'price']) }}
    
        </div>

        {{Form::submit('Update Visit',['class'=>'btn btn-success btn-lg btn-block'])}}

        {{Form::close()}}
                
        </div>
</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{!!Html::script('js/parsley.min.js')!!}
<script>
$(document).ready(function(){
            
            $(document).on('change','#visitTypes',function(){
       
                   var visitType_id = $(this).val();
                   
                   if(visitType_id == 3){ 
       
            $('#price').val(0);
           }
   });
});
</script>
@endsection