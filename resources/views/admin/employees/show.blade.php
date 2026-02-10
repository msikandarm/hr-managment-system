@extends('admin.layouts.app')

@section('content')
  <x-section-container column="col-xl-9 col-lg-10 col-md-10">
    <x-slot name="title">
      {{ $title }}
    </x-slot>

    <x-slot name="breadcrumbs">
      <x-breadcrumbs url="{{ route('admin.dashboard') }}">
        <x-breadcrumb-item class="active" label="{{ $title }}" />
      </x-breadcrumbs>
    </x-slot>

    <x-slot name="buttons">
      <x-button-back href="{{ route('admin.employees.index') }}" />
    </x-slot>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ __('Name') }}</h5>
        <p class="card-text">{{ $row->name }}</p>
        <h5 class="card-title">{{ __('Email') }}</h5>
        <p class="card-text">{{ $row->email }}</p>
        <h5 class="card-title">{{ __('Department') }}</h5>
        <p class="card-text">{{ $row->department->title }}</p>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">{{ __('Position') }}</h5>
        <p class="card-text">{{ $row->position }}</p>
        <h5 class="card-title">{{ __('Hire Date') }}</h5>
        <p class="card-text">{{ $row->hire_date }}</p>
      </div>
    </div>
  </x-section-container>
@endsection