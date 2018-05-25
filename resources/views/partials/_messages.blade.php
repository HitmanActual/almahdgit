<!--clinic messages-->
@if(Session::has('add_clinic_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('add_clinic_success')}}
</div>

@endif

@if(Session::has('remove_clinic_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('remove_clinic_success')}}
</div>

@endif
<!--end of clinic messages-->

<!--doctors messages-->

@if(Session::has('add_doctor_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('add_doctor_success')}}
</div>

@endif

<!--end of doctor messages-->

<!--doctors messages-->

@if(Session::has('update_doctor_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('update_doctor_success')}}
</div>

@endif

<!--end of doctor messages-->

<!--patient messages-->

@if(Session::has('add_patient_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('add_patient_success')}}
</div>

@endif

@if(Session::has('remove_patient_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('remove_patient_success')}}
</div>

@endif

<!--end of patient messages-->

<!--visit messages-->

@if(Session::has('add_visit_success'))

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{Session::get('add_visit_success')}}
</div>

@endif

<!--end of visit messages-->



@if(count($errors)>0)

<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors!</strong>
    <ul>
    @foreach ($errors as $error )
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div>


@endif