    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    @extends('layouts.app')

    @section('title', 'Home')

    @section('breadcrumb')
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    @endsection

    @section('content')
        <div class="container-fluid">
            @can('show_total_stats')
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-primary p-5 mfe-3 rounded-left">
                                <i class="bi bi-bar-chart font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-primary"><h3><strong>{{ format_currency($revenue) }}</div></h3></strong>
                                <h3><div class="text-muted text-uppercase font-weight-bold small">Revenue</div></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-warning p-5 mfe-3 rounded-left">
                                <i class="bi bi-arrow-return-left font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-warning"><h3><strong>{{ format_currency($sale_returns) }}</div></h3></strong>
                                <h3><div class="text-muted text-uppercase font-weight-bold small">Sales Return</div></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-success p-5 mfe-3 rounded-left">
                                <i class="bi bi-arrow-return-right font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-success"><h3><strong>{{ format_currency($purchase_returns) }}</div></h3></strong>
                                <h3> <div class="text-muted text-uppercase font-weight-bold small">Purchases Return</div></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-info p-5 mfe-3 rounded-left">
                                <i class="bi bi-trophy font-2xl"></i>
                            </div>
                            <div>
                            <strong> <div class="text-value text-info"><h3><strong>{{ format_currency($profit) }}</div></h3></strong>
                            <h3> <div class="text-muted text-uppercase font-weight-bold small">Profit</div></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('show_weekly_sales_purchases|show_month_overview')
            <div class="row mb-4">
                @can('show_weekly_sales_purchases')
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header">
                        <h4><p class="text-light">Sales & Purchases of Last 7 Days</p></h4>
                        </div>
                        <div class="card-body">
                            <canvas id="salesPurchasesChart"></canvas>
                        </div>
                    </div>
                </div>
                @endcan
                @can('show_month_overview')
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header">
                        <h4><p class="text-light"> Overview of {{ now()->format('F, Y') }}</p></h4>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-container" style="position: relative; height:auto; width:280px">
                                <canvas id="currentMonthChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            @endcan

            @can('show_monthly_cashflow')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                        <h4><p class="text-light">Monthly Cash Flow (Payment Sent & Received)</p></h4>
                        </div>
                        <div class="card-body">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            <!-- layout.blade.php or your main blade file -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
@if(Session::has('success') && !auth()->user()->userAlerts->contains('user_id', auth()->id()))
    <!-- SweetAlert to display the success message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ Session::get('success') }}",
            }).then(() => {
                // Save the user alert in the database to indicate that it has been shown to the current user
                fetch("{{ route('user.alerts.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({}),
                });
            });
        });
    </script>
@endif
        </div>
    @endsection

    @section('third_party_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
                integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endsection

    @push('page_scripts')
        <script src="{{ mix('js/chart-config.js') }}"></script>
    @endpush
