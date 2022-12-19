@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.registrations.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Registration">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.registrations.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrations.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrations.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrations.fields.subject') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrations.fields.message') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registration as $key => $registration)
                        <tr data-entry-id="{{ $registration->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $registration->id ?? '' }}
                            </td>
                            <td>
                                {{ $registration->name ?? '' }}
                            </td>
                            <td>
                                {{ $registration->email ?? '' }}
                            </td>
                            <td>
                                {{ $registration->subject ?? '' }}
                            </td>
                            <td>
                                {{ $registration->message ?? '' }}
                            </td>
                            <td>
                                @can('registration_show')
                                    <!-- <a class="btn btn-xs btn-primary" href="{{ route('admin.registrations.show', $registration->id) }}"> -->
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('registration_edit')
                                    <!-- <a class="btn btn-xs btn-info" href="{{ route('admin.registrations.edit', $registration->id) }}"> -->
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('registration_delete')
                                    <!-- <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan -->
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('registration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.registrations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
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
  $('.datatable-Registration:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
