<div class="stats-small stats-small--1 card card-small">
    <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">{{ $statTitle }}</span>
                <h6 class="stats-small__value count my-3">{!! number_format($stats[$key]) !!}</h6>
            </div>
            <div class="stats-small__data">
                @if($oldStats[$key] != 0)
                    @if($oldStats[$key] > $stats[$key])
                        <span class="stats-small__percentage stats-small__percentage--decrease" @if($stats[$key] == 0) style="margin-left:50px;" @endif>@if($stats[$key] != 0){{ $stats[$key]/$oldStats[$key] }}%@endif&nbsp;</span>
                    @elseif($oldStats[$key] < $stats[$key])
                        <span class="stats-small__percentage stats-small__percentage--increase" @if($stats[$key] == 0) style="margin-left:50px;" @endif>{{ $stats[$key]/$oldStats[$key] }}%&nbsp;</span>
                    @else
                        <span class="invisible stats-small__percentage stats-small__percentage--decrease"></span>
                    @endif
                @else
                    @if($oldStats[$key] > $stats[$key])
                        <span class="stats-small__percentage stats-small__percentage--decrease"  style="padding-left:5px;" >&nbsp;</span>
                    @elseif($oldStats[$key] < $stats[$key])
                        <span class="stats-small__percentage stats-small__percentage--increase" style="padding-left:5px;" >&nbsp;</span>
                    @else
                        <span class=" stats-small__percentage dimmed" style="padding-left:0px;"><i class="fa fa-minus fa-sm"></i></span>
                    @endif
                @endif
            </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-2"></canvas>
    </div>
</div>