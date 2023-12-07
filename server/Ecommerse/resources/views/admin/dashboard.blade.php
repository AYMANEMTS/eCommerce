@extends('layouts.app')
@section('title','Home Page')
@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('dashboardCards.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-cherry">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title text-light mb-0">Orders Of The Week </h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex text-light align-items-center mb-0">
                                    {{ $ordersOfTheWeek->count() }}
                                </h2>
                            </div>
                        </div>
                        @php
                            $totalOrders = 100;
                            $ordersCount = $ordersOfTheWeek->count();

                            // Calculate the percentage of completion
                            $percentage = ($ordersCount / $totalOrders) * 100;
                        @endphp

                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%;"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title text-white mb-0">Payment Of The Week
                            </h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex text-white align-items-center mb-0">
                                    {{ $paymentOfTheWeek->count() }}
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title text-white mb-0">Revenue of payment
                            </h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex text-white align-items-center mb-0">
                                    ${{ $revenuOfPayment }}
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title text-white mb-0">Revenue Orders of The week</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex text-white align-items-center mb-0">
                                    ${{ $revenueOfOrders }}
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-widget">
            <div class="card-body">
                <h5 class="text-muted">Order Overview </h5>
                <h2 class="mt-4">${{ $revenueOfOrders + $revenuOfPayment }}</h2>
                <span>Total Revenue</span>
                <div class="mt-4">
                    <h4>{{ $paymentOfTheWeek->count() }}</h4>
                    <h6>Online Order <span class="pull-right">{{ $paymentOfTheWeek->count() }}%</span></h6>
                    <div class="progress mb-3" style="height: 9px">
                        <div class="progress-bar bg-primary" style="width: {{ $paymentOfTheWeek->count() }}%;" role="progressbar"><span class="sr-only">30% Order</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4>{{ $checkedOrdersOfTheWeek->count() }}</h4>
                    <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">{{ $checkedOrdersOfTheWeek->count() }}%</span></h6>
                    <div class="progress mb-3" style="height: 9px">
                        <div class="progress-bar bg-warning" style="width: {{ $checkedOrdersOfTheWeek->count() }}%;" role="progressbar"><span class="sr-only">20% Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
