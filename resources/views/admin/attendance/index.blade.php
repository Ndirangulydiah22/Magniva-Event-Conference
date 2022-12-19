@extends('layouts.admin')



@section('content')


@can('attendance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.attendance.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.attendance.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.attendance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Price">


                <thead>

  

                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.event_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.designation') }}
                       

                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.organization') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.created_at') }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($attendance as $key => $attendee)
                <tr data-entry-id="{{ $attendee->first()->id }}">
        <td>

        </td>
        <td>
            {{ $attendee->id ?? '' }}
        </td>
        <td>
            {{ $attendee->event_name ?? '' }}
        </td>
        <td>
            {{ $attendee->first_name ?? '' }}
        </td>
        <td>
            {{ $attendee->last_name ?? '' }}
        </td>
        <td>
            {{ $attendee->phone ?? '' }}
        </td>
        <td>
            {{ $attendee->email ?? '' }}
        </td>
        <td>
            {{ $attendee->designation ?? '' }}
        </td>
        <td>
            {{ $attendee->organization ?? '' }}
        </td>
        <td>
            {{ $attendee->city ?? '' }}
        </td>
        <td>
            {{ $attendee->country ?? '' }}
        </td>
        <td>
            {{ $attendee->created_at ?? '' }}
        </td>

        <td>
           

            @can('attendance_edit')
                <a class="btn btn-xs btn-info" href="{{ route('admin.attendance.edit', $attendee->id) }}">
                    {{ trans('global.edit') }}
                </a>
            @endcan

            @can('attendance_delete')
    <form action="{{ route('admin.attendance.delete', ['id' => $attendee->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan


        </td>

    </tr>
@endforeach

                </tbody>
            </table>
            

            
      <form method="POST" action="{{ route('admin.attendance.import') }}" enctype="multipart/form-data">
  @csrf
  <input type="file" name="file" accept=".csv">
  <button type="submit" class="btn btn-primary">Import CSV</button>
</form>
            
        </div>

    </div>
</div>
@endsection


@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.attendance.delete', ['id' => '__id']) }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (attendance) {
          return $(attendance).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url.replace('__id', ids[0]),
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Attendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>

<script>
$(document).ready(function() {
    $('.datatable').DataTable();
});
</script>

@endsection











