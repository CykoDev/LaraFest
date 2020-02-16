<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ $heading }}</h6>
          <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
              </div>
          </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
              <canvas id="{{ $id }}"></canvas>
          </div>
          @if($items)
              <div class="mt-4 text-center small">
                  @php ($colors = ['primary','success', 'info', 'default', 'light', 'warning'])
                  @for($i=0; $i < sizeOf($items); $i++)
                      @if($i % 3 == 0)
                          <br>
                      @endif
                      <span class="mx-1">
                          <i class="fas fa-circle text-{{ $colors[$i] }}"></i> {{ $items[$i] }}
                      </span>
                  @endfor
              </div>
          @endif

          </div>
    </div>
  </div>

  @push('scripts')
  <script src='{{ asset('js/components/chart-pie.js') }}'></script>
  @endpush
