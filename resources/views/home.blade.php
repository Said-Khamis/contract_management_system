@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            dashboard
        @endslot
    @endcomponent


    <div class="col mt-0">
        <div class="col-sm-12 col-md-12 col-lg-12  col-12">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="card card-animate">
                        <div class="card-body p-3">
                            <div id="draft_and_signed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4`">
                    <div class="card card-animate">
                        <div class="card-body p-3">
                            <div id="internal_and_external"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="card card-animate">
                        <div class="card-body p-3">
                            <div id="five_best"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-12 mt-0">
            <div class="card card-animate">
                <div class="card-body p-3">
                    <div id="sectors"></div>
                </div>
            </div>
        </div>
        {{-- <div class="row g-1">
           <div class="col-xl-6">
               <div class="card card-animate">
                   <div class="card-header border-0 align-items-center d-flex">
                       <h4 class="card-title mb-0 flex-grow-1">Externally Originated Agreements</h4>
                       <div>
                       </div>
                   </div>
                   <div class="card-header p-0 border-0 bg-soft-light">
                       <div class="row g-0 text-center">
                           <div class="col-6 col-sm-6">
                               <div class="p-3 border border-dashed border-start-0">
                                   <h3 class="text-success"><i class="ri-check-double-fill fs-36"></i></h3>
                                   <h5 class="mb-1">
                                       <span class="counter-value" data-target="{{ $externallySigned }}">{{$externallySigned}}</span>
                                       <span class="text-success ms-1 fs-12">49%
                                        <i class="ri-arrow-right-up-line ms-1 align-middle"></i>
                                    </span>
                                   </h5>
                                   <p class="text-muted mb-0">Signed</p>
                               </div>
                           </div>
                           <div class="col-6 col-sm-6">
                               <div class="p-3 border border-dashed border-start-0">
                                   <h3 class="text-warning"><i class="ri-time-line fs-36"></i></h3>
                                   <h5 class="mb-1">
                                       <span class="counter-value" data-target="{{ $externallyUnSigned }}">{{$externallyUnSigned}}</span>
                                       <span class="text-warning ms-1 fs-12">60%
                                        <i class="ri-arrow-right-up-line ms-1 align-middle"></i>
                                    </span>
                                   </h5>
                                   <p class="text-muted mb-0">Draft</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="card-body p-0 pb-2">
                       <div>
                           <div id="account_registration_charts"
                                data-colors='["--vz-success", "--vz-gray-300"]'
                                data-series='30' class="apex-charts"
                                dir="ltr"></div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-xl-6">
               <div class="card card-animate">
                   <div class="card-header border-0 align-items-center d-flex">
                       <h4 class="card-title mb-0 flex-grow-1">Internally Originated Agreements</h4>
                       <div>

                       </div>
                   </div>
                   <div class="card-header p-0 border-0 bg-soft-light">
                       <div class="row g-0 text-center">
                           <div class="col-6 col-sm-6">
                               <div class="p-3 border border-dashed border-start-0">
                                   <h3 class="text-success"><i class="ri-check-double-fill fs-36"></i></h3>
                                   <h5 class="mb-1">
                                       <span class="counter-value" data-target="{{ $internallySigned }}">{{$internallySigned}}</span>
                                       <span class="text-success ms-1 fs-12">49%
                                        <i class="ri-arrow-right-up-line ms-1 align-middle"></i>
                                    </span>
                                   </h5>
                                   <p class="text-muted mb-0">Signed</p>
                               </div>
                           </div>
                           <div class="col-6 col-sm-6">
                               <div class="p-3 border border-dashed border-start-0">
                                   <h3 class="text-warning"><i class="ri-time-line fs-36"></i></h3>
                                   <h5 class="mb-1">
                                       <span class="counter-value" data-target="{{ $internallyUnSigned }}">{{$internallyUnSigned}}</span>
                                       <span class="text-warning ms-1 fs-12">60%
                                        <i class="ri-arrow-right-up-line ms-1 align-middle"></i>
                                    </span>
                                   </h5>
                                   <p class="text-muted mb-0">Draft</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="card-body p-0 pb-2">
                       <div>
                           <div id="paralegal_registration_charts"
                                data-colors='["--vz-primary", "--vz-gray-300"]'
                                data-series='20' class="apex-charts"
                                dir="ltr"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>--}}
        {{--<div class="col-sm-12 col-md-12 col-lg-12 mt-0">
            <div class="card card-animate">
                <div class="card-header">
                    <h3 class="card-title">Recently Signed</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-sm table-borderless table-striped table-nowrap align-middle mb-0">
                            <thead class="table-light">
                            <tr class="text-muted">
                                <th class="text-center"> #</th>
                                <th class="w-1"> Reg. No.</th>
                                <th>Title</th>
                                <th class="w-1">Signed Date</th>
                                <th class="w-1">Singed At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recent as $contract)
                                <tr>
                                    <td class="text-center">{{$loop->index+1}}</td>
                                    <td><span class="text-muted" >{{$contract->reference_no}}</span></td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $contract->title }}">{{ Str::words($contract->title, 2) }}</td>
                                    <td>{{date('d M Y', strtotime($contract->signed_at))}}</td>
                                    <td>{{$contract->signedLocation->settlement}}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No records</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="col-sm-12 col-md-12 col-lg-12 col-12 nb-0">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card card-animate">
                        <div class="card-body p-3">
                           <div id="chart"></div>
                        </div>
                        {{--<div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1 text-dark">Information on Agreement (s) </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="bg-soft-light border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex flex-wrap gap-4 align-items-center">
                                            <div id="total">
                                                <h3 class="fs-19 counter-value" data-target=""></h3>
                                                <p class="text-muted text-uppercase fw-medium mb-0">Total Agreement (s)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                                                <div class="pe-3" id="bilateral">
                                                    <h6 class="mb-2 text-muted">Bilateral</h6>
                                                    <h5 class="text-success mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                                <div class="pe-3" id="mou">
                                                    <h6 class="mb-2 text-muted">MoU</h6>
                                                    <h5 class="text-success mb-0 counter-value" data-target="">=</h5>
                                                </div>
                                                <div class="pe-3" id="regional">
                                                    <h6 class="mb-2 text-muted">Regional</h6>
                                                    <h5 class="text-danger mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                                <div class="pe-3" id="multilateral">
                                                    <h6 class="mb-2 text-muted">Multilateral</h6>
                                                    <h5 class="text-danger mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 mx-3 my-2">
                            <div id="agreements_chart" dir="ltr"></div>
                        </div>--}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card card-animate">
                        <div class="card-body p-3 text-dark">
                            <div id="agreements_chart"></div>
                        </div>
                        {{--<div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1 text-dark">Information on Agreement (s) </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="bg-soft-light border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex flex-wrap gap-4 align-items-center">
                                            <div id="total">
                                                <h3 class="fs-19 counter-value" data-target=""></h3>
                                                <p class="text-muted text-uppercase fw-medium mb-0">Total Agreement (s)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                                                <div class="pe-3" id="bilateral">
                                                    <h6 class="mb-2 text-muted">Bilateral</h6>
                                                    <h5 class="text-success mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                                <div class="pe-3" id="mou">
                                                    <h6 class="mb-2 text-muted">MoU</h6>
                                                    <h5 class="text-success mb-0 counter-value" data-target="">=</h5>
                                                </div>
                                                <div class="pe-3" id="regional">
                                                    <h6 class="mb-2 text-muted">Regional</h6>
                                                    <h5 class="text-danger mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                                <div class="pe-3" id="multilateral">
                                                    <h6 class="mb-2 text-muted">Multilateral</h6>
                                                    <h5 class="text-danger mb-0 counter-value" data-target="">0</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 mx-3 my-2">
                            <div id="agreements_chart" dir="ltr"></div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
       {{-- <div class="row g-1">
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="card card-animate">
                    <div class="card-header align-items-center d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1"> 5 Best Performer (s)</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table id="five_best_performer" class="table table-borderless table-hover table-nowrap align-middle mb-0" style="width: 100%">
                                <thead class="table-light">
                                  <tr class="text-muted">
                                    <th style="width: 5%;">Reg #</th>
                                    <th style="width: 10%;">Title</th>
                                    <th style="width: 20%;">Signed Date</th>
                                    <th style="width: 16%;">Duration</th>
                                    <th style="width: 12%;">Percent(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                  --}}{{-- FIVE BESTS ---}}{{--
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="card card-animate">
                    <div class="card-header align-items-center d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1"> With No Implementation (s)</h4>
                        <span>5000</span>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table id="no_implementation" class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                <tr class="text-muted">
                                    <th scope="col">Reg #</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" style="width: 20%;">Signed Date</th>
                                    <th scope="col" style="width: 16%;">Duration</th>
                                    <th scope="col" style="width: 12%;">Percent(%)</th>
                                </tr>
                                </thead>

                                <tbody>
                                  --}}{{-- NO IMPLEMENTATION    --}}{{--
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(function (){

            let chartSectors , chartDraftSigned , chartInternalAndExternal,
                chartImplemented, chartFiveBests = " ";

            sectors();
            implementations();
            signedAndNotSigned();
            internalAndExternal();
            fiveBest();

            function fiveBest(){
                const options = {
                    series: [{
                        name: 'Percent(s)',
                        data: []
                    }],
                    annotations: {
                        points: [{
                            x: '',
                            seriesIndex: 0,
                            label: {
                                borderColor: '#775DD0',
                                offsetY: 0,
                                style: {
                                    color: '#fff',
                                    background: '#775DD0',
                                },
                                text: '',
                            }
                        }]
                    },
                    chart: {
                        height: 350,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2
                    },
                    xaxis: {
                        categories: [],
                        tickPlacement: 'on',
                        labels: {
                            rotate: -45, // Set the rotation angle
                            rotateAlways: true, // Rotate the labels always, not just when they overlap
                            style: {
                                colors: ['#000000'],
                                fontSize: '12px'
                            }
                        },
                    },
                    yaxis: {
                        title: {
                            text: '',
                        },
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 0.85,
                            opacityTo: 0.85,
                            stops: [50, 0, 100]
                        },
                    },
                    title: {
                        text: '5 Best Agreement (s)',
                        floating: false,
                        offsetY: -2,
                        align: 'left',
                        style: {
                            color: '#000000',
                            fontWeight: 'bold',
                            fontSize: '15px'
                        }
                    },
                    colors: ["#0000FF"]
                };
                chartFiveBests = new ApexCharts(document.querySelector("#five_best"), options);
                chartFiveBests.render();
            }

            function internalAndExternal(){

                const options = {
                    chart: {
                        height: 350,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    series: [{
                          data: []
                         }],
                    colors: ["#00A36C"],
                    grid: {
                        borderColor: '#f1f1f1',
                    },
                    xaxis: {
                        categories: ['Total Agreements','Internal Contracts', 'External Contracts'],
                    },
                    title: {
                        text: 'Internal and External Originated',
                        align: 'left',
                        floating: true
                    }
                };

                chartInternalAndExternal = new ApexCharts(document.querySelector("#internal_and_external"), options);
                chartInternalAndExternal.render();
            }

            function signedAndNotSigned() {
                const options = {
                    chart: {
                        height: 350,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        },
                        theme: {
                            mode: 'light'
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '45%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    series: [],
                    colors: ["#00A36C", "#006400"],
                    xaxis: {
                        categories: ['Signed', 'Draft'],
                    },
                    yaxis: {
                        title: {
                            text: 'Agreement (s)'
                        }
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + " Agreement (s)"
                            }
                        }
                    },
                    title: {
                        text: 'Signed and Draft Agreement (s)',
                        align: 'left',
                        floating: true
                    }
                };

                chartDraftSigned = new ApexCharts(document.querySelector("#draft_and_signed"), options);
                chartDraftSigned.render();
            }

            function sectors(){
                const options = {
                    series: [{
                        name: 'Agreement(s)',
                        data: []
                    }],
                    annotations: {
                        points: [{
                            x: '',
                            seriesIndex: 0,
                            label: {
                                borderColor: '#775DD0',
                                offsetY: 0,
                                style: {
                                    color: '#fff',
                                    background: '#775DD0',
                                },
                                text: '',
                            }
                        }]
                    },
                    chart: {
                        height: 370,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2
                    },
                    xaxis: {
                        categories: [],
                        tickPlacement: 'on',
                        labels: {
                            rotate: -45, // Set the rotation angle
                            rotateAlways: true, // Rotate the labels always, not just when they overlap
                            style: {
                                colors: ['#000000'],
                                fontSize: '12px'
                            }
                        },
                    },
                    yaxis: {
                        title: {
                            text: '',
                        },
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 0.85,
                            opacityTo: 0.85,
                            stops: [50, 0, 100]
                        },
                    },
                    title: {
                        text: 'Agreement (s) based on Sector(s)',
                        align: 'left',
                        floating: true
                    },
                    colors: ["#FFA500"]
                };

                chartSectors = new ApexCharts(document.querySelector("#sectors"), options);
                chartSectors.render();
            }

            function implementations(){
                const options = {
                    series: [],
                    chart: {
                        type: 'donut',
                    },
                    labels: ["Implemented","Not implemented"],
                    plotOptions: {
                        pie: {
                            donut:{
                                labels : {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: function (w){
                                            return w.globals.seriesTotals.reduce((a,b) => a+ b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                show: true
                            }
                        }
                    }],
                    legend: {
                        position: 'bottom',
                        offsetY: 0
                    },
                    title: {
                        text: 'Implementation Status',
                        floating: false,
                        offsetY: -2,
                        align: 'left',
                        style: {
                            color: '#000000',
                            fontWeight: 'bold',
                            fontSize: '20px'
                        }
                    },
                    colors: ["#00FF00","#FF0000"]

                };
                chartImplemented = new ApexCharts(document.querySelector("#chart"), options);
                chartImplemented.render();
            }

            function agreementsTotal(data){
                const options = {
                    series: data.series,
                    chart: {
                        type: 'donut',
                    },
                    labels: data.labels,
                    plotOptions: {
                        pie: {
                            donut:{
                                labels : {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: function (w){
                                            return w.globals.seriesTotals.reduce((a,b) => a+ b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                show: true
                            }
                        }
                    }],
                    legend: {
                        position: 'bottom',
                        offsetY: 0
                    },
                    title: {
                        text: 'Information on Agreement (s)',
                        floating: false,
                        offsetY: -2,
                        align: 'left',
                        style: {
                            color: '#000000',
                            fontWeight: 'bold',
                            fontSize: '20px'
                        }
                    },
                    colors: ["#00FF00","#0000FF","#FF0000","#FFA500"]

                };
                const chart = new ApexCharts(document.querySelector("#agreements_chart"), options);
                chart.render();
            }

            $("body").tooltip({ selector: '[data-toggle=tooltip]' });

            $.get("{{ route("internalAndExternal") }}")
                .done(function(response) {
                    if (response.results !== null){
                        const series = response.results;
                        console.log(series);
                        chartInternalAndExternal.updateSeries([{
                            data: series
                        }]);

                    }
                })
                .fail(function(error) {
                }).always(function() {});

            $.get("{{ route("contractPerformancesGraph") }}")
                .done(function(response) {
                    if (response.results !== null){
                        const data = response.results;
                        console.log("contractPerformancesGraph");
                        console.log(data);
                        chartFiveBests.updateSeries([{
                            data: data.series
                        }]);
                        chartFiveBests.updateOptions({
                            xaxis: {
                                categories: data.categories
                            }
                        });
                    }
                })
                .fail(function(error) {
                }).always(function() {});

            $.get("{{ route("implementedAndNot") }}")
                .done(function(response) {
                    if (response.results !== null){
                        const data = response.results;
                        console.log("implementedAndNot");
                        console.log(data);
                        chartImplemented.updateSeries(data.series);
                    }
                })
                .fail(function(error) {
                }).always(function() {});

            $.get("{{ route("countingSectorsContract") }}")
                .done(function(response) {
                    if (response.results !== null){
                        const data = response.results;
                        chartSectors.updateSeries([{
                            data: data.series
                        }]);
                        chartSectors.updateOptions({
                            xaxis: {
                                categories: data.categories
                            }
                        });
                    }
                })
                .fail(function(error) {
                }).always(function() {});

            $.get("{{ route("countingDraftSigned") }}")
                .done(function(response) {
                    if (response.results !== null){
                        const data = response.results;
                        console.log("chartDraftSigned");
                        console.log(data);

                        chartDraftSigned.updateSeries(data);
                        //chartDraftSigned.update(data);
                    }
                })
                .fail(function(error) {
                }).always(function() {});

            $.get("{{ route("contractCounting") }}")
                .done(function(response) {
                  if (response.results !== null){
                      const data = response.results;
                      $("#mou h5").html(data.series[0].y).attr("data-target",data.series[0].y);
                      $("#bilateral h5").html(data.series[1].y).attr("data-target",data.series[1].y);
                      $("#regional h5").html(data.series[2].y).attr("data-target",data.series[2].y);
                      $("#multilateral h5").html(data.series[3].y).attr("data-target",data.series[3].y);
                      $("#total h3").html(data.total).attr("data-target",data.total);

                      agreementsTotal(data);
                      //showChart(data);
                  }
            })
                .fail(function(error) {
            }).always(function() {});

            $.get("{{ route("contractPerformances") }}")
                .done(function(response) {
                    if(response.result != null){
                        const best = response.result.five_best;
                        $.each(best , function (key , value){
                            const data = '<tr>' +
                                '<td><a href="">'+value.regNo+'</a></td>' +
                                '<td style="text-overflow: ellipsis">' +
                                  '<a data-bs-toggle="tooltip" data-bs-placement="top" title="'+value.name+'">'+value.name.substring(0,15)+'..</a>' +
                                '</td>' +
                                '<td>'+value.signedDate+'</td> ' +
                                '<td>'+value.duration+'</td>' +
                                ' <td> ' +
                                   '<span class="badge badge-soft-success badge-border">'+value.percent+'</span>' +
                                '</td> ' +
                                '</tr>';
                            $("#five_best_performer").append(data);
                        });

                        const noStatus = response.result.no_implementation;
                        $.each(noStatus.data, function (key , value){
                            const data = '<tr>' +
                                '<td><a href="">'+value.regNo+'</a></td>' +
                                '<td style="text-overflow: ellipsis; cursor: pointer;">' +
                                  '<a data-bs-toggle="tooltip" data-bs-placement="top" title="'+value.name+'">'+value.name.substring(0,15)+'..</a>' +
                                '</td>' +
                                '<td>'+value.signedDate+'</td> ' +
                                '<td>'+value.duration+'</td>' +
                                ' <td> ' +
                                '<span class="badge badge-soft-danger badge-border">'+value.percent+'</span>' +
                                '</td> ' +
                                '</tr>';
                            $("#no_implementation").append(data);
                        });
                    }
                 console.log("Responses");
                 console.log(response);
            }).fail(function(error) {
            }).always(function() {});

        })
    </script>
@endpush
