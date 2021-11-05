@extends('menu.header')
@extends('menu.sidebar')

@section('content')
<div class="modal fade" id="ajax-project-model" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxProjectModel"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="addEditProjectForm" name="addEditProjectForm"
                    class="form-horizontal" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Your Name"
                                value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">No Telepon</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                placeholder="Enter Your Telephone Number" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Nama Project</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama_project" name="nama_project"
                                placeholder="Enter Project Name" value="" required="">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="formGroupExampleInput" class="form-label">TIM</label>
                        <select id="tim" name="tim" class="form-control">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row">
                            <label class="col-sm-2 mt-2 control-label">Deadline</label>
                            <div class='col-sm-8'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='date' id="deadline" name="deadline" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>

            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewProject">Save changes
                </button>
            </div>
            </form>
        </div>
        

        </div>
    </div>
</div>


<!-- End Navbar -->

<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Project Table</h4>
            </div>
            <div class="content">
    <div class="col-md-10 mt-1 mb-2"><button type="button" id="addNewProject" class="btn btn-success">Add</button>
    </div>
</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">

                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">TIM</th>
                                        <th scope="col">Start</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Progress</th>
                                        <th scope="col">Total Waktu</th>
                                        <th scope="col">Sisa Waktu</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->nama }}</td>
                                        <td>{{ $project->no_telp }}</td>
                                        <td>{{ $project->nama_project }}</td>
                                        <td>{{ $project->tim }}</td>
                                        <td>{{ $project->start }}</td>
                                        <td>{{ $project->deadline }}</td>
                                        <td>{{ round((1-now()->startOfDay()->diffInDays(now()->parse($project->deadline)->startOfDay(),false) / now()->parse($project->created_at)->startOfDay()->diffInDays(now()->parse($project->deadline)->startOfDay(),false))*100,0) }}%
                                        </td>
                                        <td>{{ now()->parse($project->created_at)->startOfDay()->diffInDays(now()->parse($project->deadline)->startOfDay(),false) }}
                                            hari</td>
                                        <td>{{ now()->startOfDay()->diffInDays(now()->parse($project->deadline)->startOfDay(),false)}}
                                            hari</td>
                                        <td>{{ $project->created_at }}</td>

                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary edit"
                                                data-id="{{ $project->id }}">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger delete"
                                                data-id="{{ $project->id }}">Delete</a>
                                            <a href="javascript:void(0)" class="btn btn-success  mulai"
                                                data-id="{{ $project->id }}">Start</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $projects->links('vendor.pagination.bootstrap-4') !!}
                        </div>


                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection


    @section('extra_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({ 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#addNewProject').click(function () {
                $('#addEditProjectForm').trigger("reset");
                $('#ajaxProjectModel').html("Add Project");
                $('#ajax-project-model').modal('show');
            });



            $('body').on('click', '.edit', function () {
                var id = $(this).data('id');

                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit-project') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#ajaxProjectModel').html("Edit Project");
                        $('#ajax-project-model').modal('show');
                        $('#id').val(res.id);
                        $('#nama').val(res.nama);
                        $('#no_telp').val(res.no_telp);
                        $('#nama_project').val(res.nama_project);
                        $('#tim').val(res.tim);
                        $('#deadline').val(res.deadline);
                        $('#progress').val(res.progress);
                        $('#waktu').val(res.waktu);


                    }
                });
            });
            $('body').on('click', '.delete', function () {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');

                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete-project') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (res) {
                            window.location.reload();
                        }
                    });
                }
            });

            $('body').on('click', '.mulai', function () {
                if (confirm("Start Record?") == true) {
                    var id = $(this).data('id');

                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('start-project') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (res) {
                            window.location.reload();
                        }
                    });
                }
            });

            $('body').on('click', '#btn-save', function (event) {
                var id = $("#id").val();
                var nama = $("#nama").val();
                var no_telp = $("#no_telp").val();
                var nama_project = $("#nama_project").val();
                var tim = $("#tim").val();
                var deadline = $("#deadline").val();
                var progress = $("#progress").val();
                var waktu = $("#waktu").val();
                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);

                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('add-update-project') }}",
                    data: {
                        id: id,
                        nama: nama,
                        no_telp: no_telp,
                        nama_project: nama_project,
                        tim: tim,
                        deadline: deadline,
                        progress: progress,
                        waktu: waktu,


                    },
                    dataType: 'json',
                    success: function (res) {
                        window.location.reload();
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                    }
                });
            });
        });

        
    </script>
    @endsection