<div class="card">
    <div class="card-header">
        <h5 class="modal-title text-primary">{{ __('app.show') }}</h5>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <h3 class="mb-1 text-primary"><strong>{{ $campaign->name }} <span class="text-danger">{{ $campaign->code }}</span></strong></h3>
            <p class="mb-1">({{ $campaign->start_date?->format('d-m-Y') }} - {{ $campaign->end_date?->format('d-m-Y') }})</p>
            <p class="mb-1">{!! renderIsActive($campaign->is_active) !!}</p>
        </div>
        <div class="mb-4">
            <h5 class="text-center title mb-1"><strong>{{ __('app.description') }}</strong></h5>
            {!! $campaign->description !!}
        </div>
        <div class="mb-4">
            <h5 class="text-center title mb-1"><strong>{{ __('app.script') }}</strong></h5>
            {!! $campaign->script !!}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="modal-title text-primary">{{ __('app.report') }}</h5>
    </div>
    <div class="card-body">
        <canvas id="statusChart" class="common-chard" style="height: 400px; width: 100%"></canvas>
    </div>
</div>

<script>
    var chartData = @json($chartData);
    new Chart(document.getElementById('statusChart'), {
        type: 'bar',
        data: {
            labels: chartData.map(i => i.name),
            datasets: [{
                label: '{{ __('app.quantity') }}',
                data: chartData.map(i => i.count),
                backgroundColor: chartData.map(i => i.color)
            }]
        }
    });
</script>
