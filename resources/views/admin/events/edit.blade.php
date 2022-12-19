@extends('layouts.admin')
@section('content')


<div class="app-page-title app-page-title-simple">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div>
        <div class="page-title-head center-elem">
          <span class="d-inline-block pr-2">
            <i class="lnr-apartment opacity-6"></i>
          </span>
          <span class="d-inline-block">Magniva Events</span>
        </div>


        
      </div>
    </div>
    
  </div>
</div>


<div class="main-card mb-3 card">
  <div class="card-header">Edit Event</div>
  <div class="card-body">
    
        <form action="{{ route('admin.events.update', ['id' => $event->id]) }}" method="post" id="form" onsubmit="return checkForm(this);">
    @csrf

      <div class="position-relative form-group">
        <label for="eventName" class="">Event Name</label>
        <input name="event_name" value="{{$event->event_name}}" id="eventName" required placeholder="" type="text" class="form-control">
      </div>
      

      <div class="form-row">
        <div class="col">
            <label for="minGuests" class="">Minimum No Of Guests</label>
            <input name="minimum_guests" value="{{$event->minimum_guests}}" id="minimumGuests" required  type="number" min="1" class="form-control">
        </div>
        <div class="col">
            <label for="maxGuests" class="">Maximum No Of Guests</label>
            <input name="maximum_guests" value="{{$event->maximum_guests}}" id="maximumGuests" required  type="number" min="1" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="eventLocation" class="">Event Location</label>
            <input name="event_location" value="{{$event->event_location}}" id="eventLocation" required  type="text" min="1" class="form-control">
        </div>
        <div class="col">
            <label for="venue" class="">Venue</label>
            <input name="venue" id="venue" value="{{$event->venue}}" required  type="text" min="1" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="eventLocation" class="">Start Date</label>
            <input name="start_date" value="{{$event->start_date}}" id="eventLocation" required  type="datetime-local" class="form-control">
        </div>
        <div class="col">
            <label for="venue" class="">End Date</label>
            <input name="end_date" value="{{$event->end_date}}" id="venue" required  type="datetime-local" class="form-control">
        </div>
      </div>

      <button type="submit" name="mybtn" id="submit" class="mt-3 btn btn-primary">Update</button>
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