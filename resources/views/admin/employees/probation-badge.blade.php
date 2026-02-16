@php
  $hireDate = \Carbon\Carbon::parse($row->hire_date);
  $today = \Carbon\Carbon::now();
  $monthsEmployed = $hireDate->diffInMonths($today);
  $isProbation = $monthsEmployed < 6;

  // dd($monthsEmployed, $isProbation, $hireDate, $today);
@endphp


<div class="text-center">
  @if($isProbation)
    <span class="badge bg-warning">
      {{ __('Probation') }}
    </span>
    <small class="d-block text-muted mt-1" style="font-size: 0.7rem;">
      {{ $monthsEmployed }} {{ __('months') }}
    </small>
  @else
    <span class="badge bg-success">
     {{ __('Confirmed') }}
    </span>
    <small class="d-block text-muted mt-1" style="font-size: 0.7rem;">
      {{ $monthsEmployed }} {{ __('months') }}
    </small>
  @endif
</div>
