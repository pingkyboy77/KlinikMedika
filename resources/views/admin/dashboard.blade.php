@extends('admin.layouts.app') 
@section('title', 'Clinic Reports')  

@section('content') 
<div class="container-fluid m-0 p-0">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Dashboard</h3>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('beranda.export.pdf') }}" class="btn btn-danger">Export PDF</a>
        @endif
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header"><h5 class="card-title">Monthly Visits</h5></div>
                <div class="card-body"><div id="visitsChart"></div></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header"><h5 class="card-title">Top Services</h5></div>
                <div class="card-body"><div id="servicesChart"></div></div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card card-warning">
                <div class="card-header"><h5 class="card-title">Most Prescribed Drugs</h5></div>
                <div class="card-body"><div id="drugsChart"></div></div>
            </div>
        </div>
    </div>
</div>
@endsection  

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch("{{ route('beranda.data') }}")
        .then(res => res.json())
        .then(data => {
            console.log(data);
            
            // Visits Chart
            const visitsOptions = {
                chart: { 
                    type: 'bar', 
                    height: 350,
                    fontFamily: 'inherit',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Visits',
                    data: data.visitsPerMonth.map(v => v?.count ?? 0)
                }],
                xaxis: {
                    categories: data.visitsPerMonth.map(v => v?.month ?? '-')
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                }
            };
            
            const visitsChart = new ApexCharts(
                document.querySelector("#visitsChart"), 
                visitsOptions
            );
            visitsChart.render();
            
            // Services Chart
            const servicesOptions = {
                chart: { 
                    type: 'bar', 
                    height: 350,
                    fontFamily: 'inherit',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Total',
                    data: data.topServices.map(s => s?.total ?? 0)
                }],
                xaxis: {
                    categories: data.topServices.map(s => s?.service?.ServiceName ?? 'Unknown')
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 2
                    },
                }
            };
            
            const servicesChart = new ApexCharts(
                document.querySelector("#servicesChart"), 
                servicesOptions
            );
            servicesChart.render();
            
            // Drugs Chart
            const drugsOptions = {
                chart: { 
                    type: 'bar', 
                    height: 350,
                    fontFamily: 'inherit',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Qty',
                    data: data.topDrugs.map(d => d?.total ?? 0)
                }],
                xaxis: {
                    categories: data.topDrugs.map(d => d?.drug?.DrugName ?? 'Unknown')
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 2
                    },
                }
            };
            
            const drugsChart = new ApexCharts(
                document.querySelector("#drugsChart"), 
                drugsOptions
            );
            drugsChart.render();
        })
        .catch(err => console.error("Chart render error:", err));
});
</script>
@endsection