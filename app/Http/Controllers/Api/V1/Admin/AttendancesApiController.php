<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Amenity;
use App\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendanceRequest;
use App\Http\Requests\StoreAttendantRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\Admin\AttendanceResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendancesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceResource(Attendance::paginate());
    }

    public function store(StoreAttendantRequest $request)
    {
        $attendance = Attendance::create($request->all());
        $attendance->amenities()->sync($request->input('amenities', []));

    return response(null, Response::HTTP_CREATED);
    }

    public function show(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceResource($attendance);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());
        $attendance->amenities()->sync($request->input('amenities', []));
    
        return response(null, Response::HTTP_ACCEPTED);
    }

    public function destroy(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->delete();

        return new AttendanceResource($attendance);
    }
}
