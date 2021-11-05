@extends('menu.header')
@extends('menu.sidebar')


@section('extra_styles')
<style type="text/css">
    .card-top {
        height: 40px;
    }
</style>
@endsection

@section('content')
<br><br>
<div id="main">
    <div class="container">
        
        <div class="col 30">
            <div class="row">
                @foreach ($projects as $project)
                <div class="col-4 pb-5">
                    
                    <div class="card" style="height: 15rem;">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="float-right pr-2">
                                <h5 class="float-right pr-2">TIM: {{ $project->tim  }}</h5>
                            </div>
                        <div class="card-body">
                        
                            <div class="card-top">
                                
                            <table>
                                
                                <input type="hidden" id="project_id">
                                <h4 class="card-title">{{ $project->nama_project }}</h4>
                                
                            
                            <br>

                            <tr><td>
                            <p class="card-text">{{ substr($project->nama, 0, 100) }}</p>
                            </td></tr>
                            </table>
                            </div>
                            
                        </div>


                        <hr>

                        <div class="d-flex align-items-center justify-content-between px-2">
                            <button type="button" class="btn btn-success float-right mb-1" data-toggle="modal"
                                onclick="showModal('{{$project->id}}')">Detail</button>





                            <div class="float-right pr-2">
                                <p class="mb-0">Progress: {{ $project->totalskor  }}</p>
                            </div>

                        </div>
                        <div class="position-relative">
                            <div class="position-absolute bottom-0 start-0">
                                <td>
                                    <br>
                            
                                    <p style="color: red;">DEADLINE : {{ $project->deadline  }}</p>
                                </td>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    <br>

                </div>
                @endforeach
            </div>
            <br><br>
            {!! $projects->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>



    <div class="modal fade" id="ajaxTaskModel" tabindex="-1" aria-labelledby="ajaxTaskModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajaxTaskModel">List Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <div><button type="button" class="btn btn-success float-right mb-1" data-toggle="modal"
                        data-target="#ajax_task_model">Add</button>
                </div>
                <div><button type="button" class="btn btn-danger delete float-right mb-1" id="btn-delete" onclick="deletetask()">Delete</button>
            </div>
                
                
                <form id="form-task">@csrf

                <ul class="" style="padding: 10px" id="tasklist">

                    <hr>
                </ul>
                </form>


                <div class="d-flex align-items-center justify-content-between px-2">
                    <button type="button" class="btn btn-primary save float-right mb-1" onclick="savetask()">Save</button>
                </div>

            </div>
            <div class="modal fade" id="ajax_task_model" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="ajax-task-model">Add Task</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="javascript:void(0)" id="addEditTaskForm" name="addEditTaskForm"
                                class="form-horizontal" method="POST">
                                <input type="hidden" name="project_id" id="project_id">

                                <br>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Task</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="task" name="task"
                                            placeholder="Enter Your Task" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-5 control-label">Skor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="skor" name="skor"
                                            placeholder="Enter This Task Score" value="" maxlength="50" required="">
                                    </div>
                                </div>


                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save" value="">Save
                                        changes
                                    </button>
                                </div>
                                <br><br><br>
                                <div class="modal-body">

                                </div>
                        </div>
                    </div>
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            });
            $('#addNewTask').click(function () {
                $('#addEditTaskForm').trigger("reset");
                $('#ajaxTaskModel').modal("Add Task");
                $('#ajax-task-model').modal('show');
            });

           

            $('body').on('click', '#delete', function () {
                if (confirm("Delete Record?") == true) {
                    var id = $("#id");

                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete-task') }}",
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
                var project_id = $("#project_id").val();
                var task = $("#task").val();
                var skor = $("#skor").val();

                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);

                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('add-update-task') }}",
                    data: {
                        id: id,
                        project_id: project_id,
                        task: task,
                        skor: skor,


                    },
                    dataType: 'json',
                    success: function (res) {
                        window.location.reload();
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled",
                            false);
                    }
                });
            });





        });

        function showModal(id) {

            $('#project_id').val(id);

            $.ajax({
                type: "GET",
                url: "{{ url('show-project') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    console.log(res);

                    let tasklist = '';

                    $.each(res.data.tasks, function (key, task) {
                        if(task.status){
                            tasklist += '<li><h4><input type="checkbox" name="task[]" style="height: 20px; width: 20px;" value="'+task.id+'" checked>'  + task.task +
                            ' </h4><br></li>';
                        }else{
                            tasklist += '<li><h4><input type="checkbox" name="task[]" style="height: 20px; width: 20px;" value="'+task.id+'" >'  + task.task +
                            ' </h4><br></li>';
                        }

                       
                    });

                    $("#tasklist").html(
                        '<ul class="" style="padding: 20px; list-style-type:none!important;" id="tasklist">' +
                        tasklist + '</ul>');




                }
            });
            $('#ajaxTaskModel').modal('show');


        }
        function deletetask() {
            $.ajax({
                    type: "POST",
                    url: "{{ url('delete-task') }}",
                   data:$("#form-task").serialize(),
                    dataType: 'json',
                    success: function (res) {
                       $(".modal").modal("hide");
                    }
                });
        }

        function savetask(){
            $.ajax({
                type: "POST",
                url:"{{ url('status') }}",
                 data:$("#form-task").serialize(),
                    dataType: 'json',
                    success: function (res) {
                window.location.reload()
                    }


            })
        }
    </script>
    @endsection
