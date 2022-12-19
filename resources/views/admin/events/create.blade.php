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
  <div class="card-header">Create A New Event</div>
  <div class="card-body">
    <form action="{{ route("admin.events.store") }}" method="post" id="form" onsubmit="return checkForm(this);">
        @csrf
      <div class="position-relative form-group">
        <label for="eventName" class="">Event Name</label>
        <input name="event_name" id="eventName" required placeholder="" type="text" class="form-control">
      </div>

      <div class="form-row">
        <div class="col">
            <label for="minGuests" class="">Minimum No Of Guests</label>
            <input name="minimum_guests" id="minimumGuests" required placeholder=""   type="number" min="1" class="form-control">
        </div>
        <div class="col"> 
            <label for="maxGuests" class="">Maximum No Of Guests</label>
            <input name="maximum_guests" id="maximumGuests" required placeholder=""   type="number" min="1" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="eventLocation" class="">Event Location</label>
            <input name="event_location" id="eventLocation" required  type="text" min="1" class="form-control">
        </div>
        <div class="col">
            <label for="venue" class="">Venue</label>
            <input name="venue" id="venue" required  type="text" min="1" class="form-control">
        </div>
      </div>

      <div class="form-row">
        <div class="col">
            <label for="startDate" class="">Start Date</label>
            <input name="start_date" id="startDate" required  type="datetime-local" class="form-control">
        </div>
        <div class="col">
            <label for="endDate" class="">End Date</label>
            <input name="end_date" id="endDate" required  type="datetime-local" class="form-control">
        </div>
      </div>

      <button type="submit" name="submit" id="submit" class="mt-3 btn btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>

@endsection



@section('scripts')
<script>
    function checkForm(form) {
        // Validate form data
        var eventName = form.eventName.value;
        var minGuests = form.minGuests.value;
        var maxGuests = form.maxGuests.value;
        var eventLocation = form.eventLocation.value;
        var venue = form.venue.value;
        var startDate = form.startDate.value;
        var endDate = form.endDate.value;

        if (eventName == "") {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid event name.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (minGuests == "" || minGuests < 1) {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid minimum number of guests.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (maxGuests == "" || maxGuests < 1) {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid maximum number of guests.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (eventLocation == "") {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid event location.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (venue == "") {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid venue.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (startDate == "") {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid start date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (endDate == "") {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a valid end date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        // Submit form
        $("#submit").attr("disabled", true);
        form.submit.value = "Please wait...";

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
