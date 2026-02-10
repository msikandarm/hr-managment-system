@extends('admin.layouts.app')

@section('content')
  <x-section-container column="col-xl-6 col-lg-7 col-md-8">
    <x-slot name="title">
      {{ $title }}
    </x-slot>

    <x-slot name="breadcrumbs">
      <x-breadcrumbs url="{{ route('admin.dashboard') }}">
        <x-breadcrumb-item url="{{ route('admin.leave-requests.index') }}" label="{{ $section_title }}" />
        <x-breadcrumb-item class="active" label="{{ $title }}" />
      </x-breadcrumbs>
    </x-slot>

    <x-slot name="buttons">
      <x-button-back href="{{ route('admin.leave-requests.index') }}" />
    </x-slot>

    <x-form action="{{ route('admin.leave-requests.store') }}" method="post">
      <x-form-group label="{{ __('Employee') }}" inputId="employee">
        <x-select name="employee" required>
          <option value="" disabled selected>{{ __('Select Employee') }}</option>
          @foreach (employees() as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
          @endforeach
        </x-select>
      </x-form-group>

      <x-form-group label="{{ __('Leave Type') }}" inputId="leave_type">
        <x-select name="leave_type" required>
          <option value="" disabled selected>{{ __('Select Leave Type') }}</option>
          @foreach (leaveTypes() as $leaveType)
            <option value="{{ $leaveType->id }}">{{ $leaveType->title }} ({{ $leaveType->days_allowed }} days)</option>
          @endforeach
        </x-select>
      </x-form-group>

      <x-form-group label="{{ __('Start Date') }}" inputId="start_date">
        <x-date-picker name="start_date" :minDate="null" required />
      </x-form-group>

      <x-form-group label="{{ __('End Date') }}" inputId="end_date">
        <x-date-picker name="end_date" :minDate="null" required />
      </x-form-group>

      <x-form-group label="{{ __('Total Days') }}" inputId="total_days">
        <x-input name="total_days" type="number" min="1" required />
      </x-form-group>

      <x-form-group label="{{ __('Reason') }}" inputId="reason">
        <x-textarea name="reason" rows="3" />
      </x-form-group>

      <x-button-publish />
    </x-form>
  </x-section-container>
@endsection
