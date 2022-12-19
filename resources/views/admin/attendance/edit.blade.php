@extends('layouts.admin')
@section('content')

<div class="main-card mb-3 card">
  <div class="card-header">Edit Attendee</div>
  <div class="card-body">
  <form action="{{ route('admin.attendance.update', ['id' => $attendance->id]) }}" method="post" id="form" onsubmit="return checkForm(this);">
    @csrf

       
     
      <div class="form-row">

      <div class="col">
          <label for="event_name" class="">Update Event</label>
          <input name="event_name" value="{{$attendance->event_name}}" id="event_name" required placeholder="" type="text" class="form-control">
        </div>

        <div class="col">
          <label for="first_name" class="">First Name</label>
          <input name="first_name" value="{{$attendance->first_name}}" id="first_name" required placeholder="" type="text" class="form-control">
        </div>
        <div class="col">
            <label for="last_name" class="">Last Name</label>
            <input name="last_name" value="{{$attendance->last_name}}" id="last_name" required  type="text" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="phone" class="">Phone Number</label>
            <input name="phone" value="{{$attendance->phone}}" id="phone" required  type="number" class="form-control">
        </div>
        <div class="col">
            <label for="email" class="">Email Address</label>
            <input name="email" value="{{$attendance->email}}" id="email" required  type="email" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="designation" class="">Designation</label>
            <input name="designation" value="{{$attendance->designation}}" id="designation" required  type="text" class="form-control">
        </div>
        <div class="col">
            <label for="organization" class="">Organization</label>
            <input name="organization" value="{{$attendance->organization}}" id="organization" required  type="text" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="country" class="">Country</label>
            <input name="country" value="{{$attendance->country}}" id="country" required  class="form-control">
        </div>
        <div class="col">
            <label for="city" class="">City</label>
            <input name="city" value="{{$attendance->city}}" id="city" required  class="form-control">
        </div>
      </div>
      <button type="submit" name="mybtn" id="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>

@endsection

@section('scripts')
<script>
    function checkForm(form) {
        // Submit form
        $("#submit").attr("disabled", true);
        form.mybtn.value = "Please wait...";

        Swal.fire({
            title: 'Submitting',
            html: 'Please wait...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: false,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            },
            
        });

    }
</script>
@endsection