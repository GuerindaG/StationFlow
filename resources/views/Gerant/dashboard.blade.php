<!DOCTYPE html>
<html lang="en">
@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="StationFlow - Gestion" name="author">
    <title></title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/stationflow-favicon.svg')}}">

    <!-- Libs CSS -->
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-M8S4MT3EYG");
    </script>

    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function () {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "kuc8w5o9nt");
    </script>

    <style>
        .faq-section {
            padding: 80px 0;
            background-color: var(--light-bg);
        }

        .accordion-item {
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .accordion-button {
            font-weight: 600;
            padding: 20px;
            background-color: white;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: white;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            padding: 20px;
            background-color: white;
        }

        .invoice-card-row .custom-card {
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .invoice-card-row .custom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            background-color: #f5f5f5;
        }

        .invoice-card-row .custom-card:hover .card-title {
            color: #007bff;
        }

        .invoice-card-row .custom-card:hover .card-subtitle {
            color: #888;
        }
    </style>

</head>

<body>
    @include('Gerant.navbar')
    <div class="main-wrapper">
        @include('Gerant.verticalNav')
        <main class="main-content-wrapper">
            <div class="container">
                @include('Gerant.card')
                <div class="row">

                    <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="mb-1 fs-5">Chiffre d'affaire</h3>
                                        <small>
                                            @php
                                                $totalEvolution = 0;
                                                foreach ($revenueChartData['evolutionByPayment'] as $payment) {
                                                    $totalEvolution += $payment['evolution'];
                                                }
                                                $avgEvolution = count($revenueChartData['evolutionByPayment']) > 0
                                                    ? $totalEvolution / count($revenueChartData['evolutionByPayment'])
                                                    : 0;
                                            @endphp
                                            ({{ $avgEvolution >= 0 ? '+' : '' }}{{ number_format($avgEvolution, 2) }}%)
                                            par rapport à {{ $revenueChartData['previousYear'] }}
                                        </small>
                                    </div>
                                    <div>
                                        <select class="form-select" id="yearSelector">
                                            @for($i = Carbon::now()->year; $i >= 2021; $i--)
                                                <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div id="revenueChart" class="mt-6"></div>

                                <div class="mt-4">
                                    <h4 class="fs-6 mb-3">Évolution par moyen de paiement (vs
                                        {{ $revenueChartData['previousYear'] }})
                                    </h4>
                                    <div class="row">
                                        @foreach($revenueChartData['evolutionByPayment'] as $payment)
                                            <div class="col-md-4 mb-3">
                                                <div class="card border-0 shadow-sm">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 mb-6">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <h3 class="mb-0 fs-5">Total ventes</h3>
                                <div id="stationflow-logo" class="mt-6 d-flex justify-content-center"></div>
                            </div>
                        </div>
                    </div>

                </div>
               
            </div>
        </main>
    </div>

    <script>
        document.getElementById('customFilterBtn').addEventListener('click', function () {
            const dateRangeDiv = document.getElementById('customDateRange');
            dateRangeDiv.style.display = dateRangeDiv.style.display === 'none' ? 'block' : 'none';

            // Définir les dates par défaut
            if (!document.querySelector('input[name="start_date"]').value) {
                const today = new Date().toISOString().split('T')[0];
                document.querySelector('input[name="start_date"]').value = today;
                document.querySelector('input[name="end_date"]').value = today;
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Données préparées par le contrôleur
            const chartData = @json($categoriesChartData);

            // Options du graphique
            const options = {
                series: chartData.series,
                chart: {
                    type: 'donut',
                    height: 300
                },
                labels: chartData.labels,
                colors: chartData.colors,
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString() + ' FCFA';
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            // Initialisation du graphique
            const chart = new ApexCharts(document.querySelector("#stationflow-logo"), options);
            chart.render();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const revenueData = @json($revenueChartData);

            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: { show: false }
                },
                series: revenueData.series,
                colors: revenueData.colors,
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                markers: {
                    size: 6,
                    strokeWidth: 0,
                    hover: { size: 8 }
                },
                xaxis: {
                    categories: revenueData.labels,
                    labels: { style: { colors: '#6c757d' } }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return new Intl.NumberFormat('fr-FR', {
                                style: 'currency',
                                currency: 'XOF'
                            }).format(value);
                        },
                        style: { colors: '#6c757d' }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return new Intl.NumberFormat('fr-FR', {
                                style: 'currency',
                                currency: 'XOF'
                            }).format(value);
                        }
                    }
                },
                grid: { borderColor: '#f1f1f1' },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };

            const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialisation du graphique
            const revenueData = @json($revenueChartData);

            const chartOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 1000
                        }
                    }
                },
                series: revenueData.series,
                colors: revenueData.colors,
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                markers: {
                    size: 6,
                    strokeWidth: 0,
                    hover: { size: 9 }
                },
                xaxis: {
                    categories: revenueData.labels,
                    labels: {
                        style: {
                            colors: '#6c757d',
                            fontSize: '12px'
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: '#e9ecef'
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return new Intl.NumberFormat('fr-FR', {
                                style: 'currency',
                                currency: 'XOF',
                                minimumFractionDigits: 0
                            }).format(value);
                        },
                        style: {
                            colors: '#6c757d',
                            fontSize: '12px'
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: '#e9ecef'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return new Intl.NumberFormat('fr-FR', {
                                style: 'currency',
                                currency: 'XOF',
                                minimumFractionDigits: 0
                            }).format(value);
                        }
                    },
                    shared: true,
                    intersect: false
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    markers: {
                        radius: 12
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 5
                    }
                },
                dataLabels: {
                    enabled: false
                }
            };

            const chart = new ApexCharts(document.querySelector("#revenueChart"), chartOptions);
            chart.render();

            // Gestion du changement d'année
            document.getElementById('yearSelector').addEventListener('change', function () {
                const year = this.value;
                const url = new URL(window.location.href);
                url.searchParams.set('year', year);
                window.location.href = url.toString();
            });
        });
    </script>

    <!-- Libs JS -->
    <!-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="../assets/js/vendors/chart.js"></script>
</body>

</html>