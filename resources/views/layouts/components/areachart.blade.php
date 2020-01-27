<div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ $heading }}</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        @if(isset($hasdropdown))

        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">{{ $dropdownHeading }}</div>

            @foreach($links as $key=>$value)

                <a class="dropdown-item" href="{{ $value }}">{{ $key }}</a>

            @endforeach

            {{-- <div class="dropdown-divider"></div> --}}
        </div>

        @endif
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart"></canvas>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="{{ asset('js/components/chart-area.js') }}"></script>
@endpush
