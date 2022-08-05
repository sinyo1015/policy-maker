@extends("layouts.base")


@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Peta Kemungkinan
@endsection

@section("title")
Peta Kemungkinan
@endsection

@section("current_page")
Peta Kemungkinan
@endsection

@section("contents")
<div class="card border-light shadow-sm components-section">
    <div class="card-body">
        <div class="p-3">
            <canvas class="w-100" id="chart">

            </canvas>
        </div>
    </div>
</div>
@endsection

@push("script")
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.2/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('chart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Pendukung", "Netral", "Oposisi"],
            datasets: [{
                label: 'Jumlah Keseluruhan',
                data: ["{{$data->support->position_sum}}", "{{$data->neutral->position_sum}}", "{{$data->oposition->position_sum}}"],
                backgroundColor: [
                    'rgba(13, 209, 42, 0.7)',
                    'rgba(192, 242, 245, 0.7)',
                    'rgba(242, 14, 10, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush