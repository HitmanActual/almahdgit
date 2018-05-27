@extends('main')
@section('title','| daily visits')

@section('stylesheets')

    {!!Html::style('//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
    
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-12">
            <form class="form-inline my-2 my-lg-0 ">
                    <input class="form-control mr-sm-2" id="datepicker" name="keyword" type="search" placeholder="Search By Date" aria-label="Search">
                    <button class="btn btn-outline-info my-2 my-sm-0 mr-2" type="submit">Find</button>
                    <a href="/visits" class="btn btn-outline-dark my-2 my-sm-0">Reset Search</a>
            </form>
           
    </div>

</div>
    <div class="row">
    <div class="col-md-12 mt-5">
        <table class="table table-hover">
            <thead>
                <th>Clinic</th>
                <th>Doctor</th>                
                <th>نوع الكشف</th>  
                <th>Price</th>                                              
                <th>Created at</th>
                
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                    <td>{{$visit->clinics->clinicName}}</td>
                    <td>{{$visit->doctors->doctorName}}</td>
                    <td>{{$visit->visitTypes->visitName}}</td>
                    <td>{{$visit->price}}</td>
                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y')}}</td>                        
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    


<div class="row">
        <div class="mx-auto">
                {!!$visits->links();!!}
        </div>
            
</div>

@endsection

@section('scripts')



<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

  <script>
  
    //datepicker 
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
  </script>
@endsection