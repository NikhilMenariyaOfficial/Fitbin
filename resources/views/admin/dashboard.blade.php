<x-layouts.admin>
    <x-breadcrumb :title="''"></x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <section class=" mb-5 card ps-3 pe-3 pt-3 bg-transparent border-0">
        <section class="row">
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-warning shadow h-100 py-2 shadow-lg">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" mb-0 font-weight-bold text-gray-800 h6">{{ $dateTime }} </div>
                                <div class=" mb-0 font-weight-bold text-gray-800 h5 mt-2"><strong> {{ $time }}
                                    </strong>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings
                                    (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₹
                                    {{ number_format($totalEarningCurrentMonth, 2, '.', ',') }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt fa-2x text-gray-300   "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Total)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₹
                                    {{ number_format($totalEarning, 2, '.', ',') }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt fa-2x text-gray-300   "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Members
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $totalMembers }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Joined This Month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $joinedThisMonth }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-link fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Enquiry
                                    <small>(This Month, count)</small>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $totalEnquiries }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Unpaid
                                    member<br /><small>(total count of unpaid members)</small></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $unpaidMembers }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expired
                                    Membership<br /><small> (Count)</small></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $expiredMemberships }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4"><div class="card border-left-primary shadow h-100 py-2 shadow-lg"">
                <div class="card-body"><div class="row no-gutters align-items-center">
                    <div class="text-center">
                        <h1 class="text-xl font-bold">Share Registration URL</h1>
                        <p class="text-gray-500">Click the button to copy the URL to the clipboard.</p>
                        <button id="shareButton" class="btn btn-block btn-sm btn-gray-800 ps-5 pe-5">
                            Copy URL
                        </button>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-share fa-2x text-gray-300"></i>
                    </div>
                </div></div>
            </div></div>

            <div class="col-12 mb-4">
                <div class="card border-0 shadow-lg" style="background-color: #fac0b9">
                    <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                        <div class="d-block mb-3 mb-sm-0">
                            <div class="fs-5 fw-normal mb-2 text-primary">Sales Chart</div>
                            <h2 class="fs-3 fw-extrabold">₹ {{ number_format($totalEarningCurrentMonth, 2, '.', ',') }}
                            </h2>
                            <div class="small mt-2">
                                @if ($chart->currentMonthSales > $chart->lastMonthSales)
                                    @php
                                        $response = empty($chart->lastMonthSales) ? 100 : number_format(($chart->currentMonthSales / $chart->lastMonthSales) * 100, 2);
                                    @endphp
                                    <span class="fw-normal me-2">Last Month</span>
                                    <span class="fas fa-angle-up text-success"></span>
                                    <span class="text-success fw-bold">{{ $response }}%</span>
                                @elseif ($chart->currentMonthSales < $chart->lastMonthSales)
                                    @php
                                        $response = number_format((($chart->lastMonthSales - $chart->currentMonthSales) / $chart->lastMonthSales) * 100, 2);
                                    @endphp
                                    <span class="fw-normal me-2">Last Month</span>
                                    <span class="fas fa-angle-down text-danger"></span>
                                    <span class="text-danger fw-bold">{{ $response }}%</span>
                                @else
                                    <div class="text-primary fw-bold">Current month sales are equal to last month</div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="d-flex ms-auto">
                    <a href="#" class="btn btn-secondary btn-sm me-2">Month</a>
                    <a href="#" class="btn btn-sm me-3">Week</a>
                </div> --}}
                    </div>
                    <div class="card-body p-2">
                        <section class="ct-chart-sales-chart ct-double-octave ct-series-g"></section>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <script>
        try {

            var sales = @json($chart->sales);

            const data = sales.map(({
                total
            }) => total);
            const labels = sales.map(({
                month
            }) => month);

            console.clear();
            console.log(data);
            console.log(sales)

            if (document.querySelector('.ct-chart-sales-chart')) {
                new Chartist.Line('.ct-chart-sales-chart', {
                    labels: [...labels],
                    series: [
                        [...data]
                    ]
                }, {
                    low: 0,
                    showArea: true,
                    fullWidth: true,
                    plugins: [
                        Chartist.plugins.tooltip()
                    ],
                    axisX: {
                        position: 'end',
                        showGrid: true
                    },
                    axisY: {
                        showGrid: true,
                        showLabel: false,
                        labelInterpolationFnc: function(value) {
                            return '₹' + (value / 1) + 'k';
                        }
                    }
                });
            }

        } catch (error) {
            console.clear();
            console.log(error.message);
        }
    </script>
    <script>
        document.querySelector('#shareButton').addEventListener('click', async () => {
            const registrationUrl = "{{ route('membership-request.index') }}";
            await navigator.clipboard.writeText(registrationUrl);
        });
    </script>
</x-layouts.admin>
