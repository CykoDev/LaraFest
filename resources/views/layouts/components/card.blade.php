<div class="col-xl-3 col-md-6 mb-4">
    @if(isset($link))
    <a href="{{ $link }}" style="text-decoration:none">
    @endif
    <div class="card border-left-{{ $textclass }} shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        <div class="col mr-2">
            <div class="text-xs font-weight-bold text-{{ $textclass }} text-uppercase mb-1">{{ $title }}</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
        </div>
        <div class="col-auto">
            {!! $faIcon !!}
        </div>
        </div>
    </div>
    </div>
    @if(isset($link))
    </a>
    @endif
</div>

