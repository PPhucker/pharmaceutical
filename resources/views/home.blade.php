@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center m-3">
        <div class="w-100">
            <div class="row mb-2">
                <div class="col-12">
                    <form action="{{route('/')}}"
                          method="GET"
                          class="mb-0 p-0">
                        <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                                      toDate="{{$toDate}}"/>
                        <button type="submit"
                                class="btn btn-sm btn-primary">
                            {{__('datatable.filter')}}
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-primary border-start border-5 border-top-0 border-end-0 border-bottom-0 shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs text-primary text-uppercase mb-1">
                                        {{__('charts.contractors.number')}}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{$countContractors}}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-check-fill fs-1 text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2"
                    style="border:solid 5px; border-color:#036280; border-top: 0; border-right: 0; border-bottom: 0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <span style="color: #036280">{{__('charts.organizations.number')}}</span>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{$countOrganizations}}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-house-check-fill fs-1 text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2"
                         style="border:solid 5px; border-color:#378BA4; border-top: 0; border-right: 0; border-bottom: 0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span style="color: #378BA4">{{__('charts.users.number')}}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{$countUsers}}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill fs-1 text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2"
                         style="border:solid 5px; border-color:#81BECE; border-top: 0; border-right: 0; border-bottom: 0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <span style="color:#81BECE;">{{__('charts.products.number')}}</span>
                                    </div>
                                    <div class="h5 mb-0 text-gray-800">
                                        {{$countProducts}}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cart-fill fs-1 text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="max-height: 80%">
                @foreach($charts as $chart)
                    <div class="col-xl-6 col-md-6 col-xs-12 col-sm-12 mb-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-body border-0">
                                {!! $chart->container() !!}
                                {{ $chart->script() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@foreach($charts as $chart)
    <script src="{{ $chart->cdn() }}"></script>
@endforeach

