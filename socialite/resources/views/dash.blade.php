@extends('menu.header')
@extends('menu.sidebar')



@section('content')
<br><br>
<div class="container-fluid">
<!-- Content Row -->
                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4 ml-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" style="height: 8rem;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$akun}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ml-5">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body" style="height: 8rem;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Project
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$project}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 ml-5">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

</div>

<br><br><br>
    <div class="container">
    <div class="col 30">
        <div class="row">
            
        <div class="card" style="height: 23rem; width: 33rem;">
            <div class="card-body">
            <h4 class="card-title">Statistik Users</h4>
            <canvas id="mataChart" class="chartjs" width="70" height="42"></canvas>
        </div>
    </div>
    
    <div class="d-flex align-items-center justify-content-between px-4"></div>
        <div class="card" style="height: 23rem; width: 33rem;">
            <div class="card-body">
            <h4 class="card-title">Statistik Project</h4>
            <canvas id="projectChart" class="chartjs" width="70" height="42"></canvas>
        </div>
    
        </div>
    



                    <!-- Content Row -->

</div>
</div>
</div>
</div>
</div>


    



@endsection

@section('extra_script')


<script type="text/javascript">
   
   var labels = {!! json_encode($label) !!};
   var datas = {!! json_encode($jumlah_user) !!};
    var ctx = document.getElementById("mataChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets : [{
                label: 'Statistik User',
                backgroundColor: ' #4e73df',
                borderColor: '#00FA9A',
                data: datas
            }],
            options: {
                animation: {
                    onProgress: function (animation) {
                        progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                    }
                }
            }
        },
    });



    var tulis = {!! json_encode($label) !!};
   var baca = {!! json_encode($jumlah_project) !!};
    var ctx = document.getElementById("projectChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tulis,
            datasets : [{
                label: 'Statistik Project',
                backgroundColor: ' #38c172',
                borderColor: '#93C3D2',
                data: baca
            }],
            options: {
                animation: {
                    onProgress: function (animation) {
                        progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                    }
                }
            }
        },
    });



    
</script>


@endsection