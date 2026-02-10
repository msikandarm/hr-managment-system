<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\LeaveRequest;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $pendingLeaveRequests = LeaveRequest::where('status', 'pending')->count();
        $approvedLeaveRequests = LeaveRequest::where('status', 'approved')->count();
        $rejectedLeaveRequests = LeaveRequest::where('status', 'rejected')->count();
        $upcomingHolidays = Holiday::where('date', '>=', now())->where('status', true)->count();
        
        // Get leave requests for calendar
        $leaveRequests = LeaveRequest::with(['employee', 'leaveType'])
            ->get()
            ->map(function ($request) {
                $color = match($request->status) {
                    'approved' => '#28a745',
                    'rejected' => '#dc3545',
                    default => '#ffc107',
                };
                return [
                    'id' => $request->id,
                    'title' => $request->employee->name . ' - ' . $request->leaveType->title,
                    'start' => $request->start_date->format('Y-m-d'),
                    'end' => $request->end_date->addDay()->format('Y-m-d'),
                    'color' => $color,
                    'url' => route('admin.leave-requests.show', $request->id),
                ];
            });

        // Get holidays for calendar
        $holidays = Holiday::where('status', true)
            ->get()
            ->map(function ($holiday) {
                return [
                    'id' => 'holiday-' . $holiday->id,
                    'title' => $holiday->title,
                    'start' => $holiday->date->format('Y-m-d'),
                    'color' => '#17a2b8',
                    'allDay' => true,
                ];
            });

        $calendarEvents = $leaveRequests->merge($holidays);

        return view('admin.dashboard', [
            'title' => __('Dashboard'),
            'totalEmployees' => $totalEmployees,
            'totalDepartments' => $totalDepartments,
            'pendingLeaveRequests' => $pendingLeaveRequests,
            'approvedLeaveRequests' => $approvedLeaveRequests,
            'rejectedLeaveRequests' => $rejectedLeaveRequests,
            'upcomingHolidays' => $upcomingHolidays,
            'calendarEvents' => $calendarEvents,
        ]);
    }
}
