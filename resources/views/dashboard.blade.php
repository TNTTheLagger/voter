@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Dashboard</h2>

        @if(session('status'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display User Vote -->
        <p class="text-gray-900 dark:text-gray-100">You voted for: <strong>{{ ucfirst($userVote->color) }}</strong></p>

        <!-- Voting Result Graphic -->
        <div class="mt-8">
            <h3 class="text-lg mb-2 text-gray-900 dark:text-gray-100">Voting Results</h3>
            <canvas id="voteChart" height="100"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('voteChart').getContext('2d');
        var voteChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue'],
                datasets: [{
                    label: 'Votes',
                    data: [{{ $votesForRed }}, {{ $votesForBlue }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
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
@endsection
