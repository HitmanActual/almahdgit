@extends('main')
@section('title','| doctors')

@section('content')

<div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <h1>Edit a Visit</h1>
            <hr>
            <!--the visit form-->

            {!! Form::model(['route' => ['visits.store',$visit->id],'method'=>'PUT','data-parsley-validate'=>'']) !!}
            <div class="form-group">
                <select class="form-control" name="clinic_id" id="clinics"> 
                    <option value="" disabled selected>please select the clinic</option>                  
                    @foreach($clinics as $clinic)
                        <option value="{{$clinic->id}}">{{$clinic->clinicName}}</option>
                    @endForeach               
                </select>
            </div>

            <div class="form-group mt-5">
                <select class="form-control" name="doctor_id" id="doctors"> 
                    <option value="" disabled selected>select doctor</option>                  
                                 
                </select>
            </div>

            <div class="form-group mt-5">
                    <select class="form-control" name="visitType_id" id="visitTypes"> 
                        <option value="" disabled selected>نوع الزيارة</option>                  
                        @foreach($visitTypes as $type)
                        <option value="{{$type->id}}">{{$type->visitName}}</option>
                        @endForeach               
                    </select>
            </div>

            <div class="form-group">
                    {{Form::label('price', 'Price EGP',['id'=>'priceLabel'])}}
                    {{ Form::text('price',0, ['class' => 'form-control', 'id'=>'price']) }}

            </div>


            {{Form::submit('Add Visit & Send to Doctor',['class'=>'btn btn-success btn-lg btn-block'])}}
    
                       
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

        //--dynamic drop down
        $(document).on('change','#clinics',function(){

            var clinic_id = $(this).val();
            var op = " ";
            $.ajax({
                type:'get',
                url:'/clinicDoctors',
                data:{'id':clinic_id},
                success:function(data){

                    //console.log(data)
                    op+='<option value="0" selected disabled>Choose the Doctor</option>';

                    for(var i=0;i<data.length;i++){

                        op+='<option value ="'+data[i].id+'">'+data[i].doctorName+'</option>';
                    }
                    $('#doctors').html(" ");
                    $('#doctors').append(op);
                },
                error:function(){
                    console.log('err');
                }
            });

        });

    })
</script>
@endsection
