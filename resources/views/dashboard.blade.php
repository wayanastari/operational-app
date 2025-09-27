@extends('layouts.app')

@section('title', 'Dashboard - Cleopatra')

@section('content')
    <!-- Stats Cards -->
    @include('partials.stats-cards')
    
    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Congratulations Card -->
        @include('partials.congratulations-card')
        
        <!-- Analytics Cards -->
        @include('partials.analytics-cards')
    </div>

    <!-- Sales Overview -->
    @include('partials.sales-overview')
@endsection

@push('scripts')
<script>
    // Chart initialization
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: [400, 300, 600, 400, 500, 350, 600, 450, 700, 550, 600, 500],
                backgroundColor: '#14b8a6',
                borderRadius: 4,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endpush