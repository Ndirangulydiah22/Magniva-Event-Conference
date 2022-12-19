@extends('layouts.admin')

@section('content')



@can('attendance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.events.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.events.title_singular') }}
            </a>
        </div>
    </div>
@endcan


<div class="card">
    <div class="card-header">
        {{ trans('cruds.events.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Price">

        <thead>



          <tr>
          <th width="10">
            </th>
            <th>ID</th>
            <th>Event Name</th>
            <th>Minimum Guests</th>
            <th>Maximum Guests</th>
            <th>Event Location</th>
            <th>Venue</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created On</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach($events as $event)
          <tr data-entry-id="{{ $event->first()->id }}">
          <td></td>
            <th>{{ $event->id ?? '' }}</th>
            <td>{{$event->event_name}}</td>
            <td>{{$event->minimum_guests}}</td>
            <td>{{$event->maximum_guests}}</td>
            <td>{{$event->event_location}}</td>
            <td>{{$event->venue}}</td>
            <td>{{date('M jS'.', '.'Y H:i A', strtotime($event->start_date))}}</td>
            <td>{{date('M jS'.', '.'Y H:i A', strtotime($event->end_date))}}</td>
            <td>{{date('M jS'.', '.'Y H:i A', strtotime($event->created_at))}}</td>
            <td>
    
           

            @can('event_edit')
                <a class="btn btn-xs btn-info"  title="Edit Event" href="{{ route('admin.events.edit', $event->id) }}">
                    {{ trans('global.edit') }}
                </a>
            @endcan
            
            @can('event_delete')
                <form action="{{ route('admin.events.delete', ['id' => $event->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-delete"></i> {{ trans('global.delete') }}</button>
                </form>
            @endcan
       


          </tr>
          @endforeach
      
      </table>

      <form method="POST" action="{{ route('admin.events.import') }}" enctype="multipart/form-data">
  @csrf
  <input type="file" name="file" accept=".csv">
  <button type="submit" class="btn btn-primary">Import CSV</button>
</form>


      
    </div>
  </div>
</div>
</div>

@endsection

@section('scripts')
<script>
   
  function deleteEvent(id){

    var url = "/events/delete/"+id;

    Swal.fire({
            title: ' Would you like to proceed with deletion?',
            text: "Please note that this process is not reversible!",
            icon: 'warning',
            showCancelButton: true,
            backdrop: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
                
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Deleting',
                        html: 'Please wait...',
                        timer: 3000,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        
                    });

                    window.location.href = url;

                }

            })

     return false;
    
  }

</script>

<script>
  $(document).ready(function() {
      $('.datatable').DataTable();
  });
</script>


@endsection