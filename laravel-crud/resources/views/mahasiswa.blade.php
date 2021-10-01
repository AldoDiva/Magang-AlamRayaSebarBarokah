<!doctype html>
<html lang="en">
<head>
 <title>Laravel 8 CRUD - Menggunakan API Firebase</title>
 <style>
    html, body {
    width: 100%;
    height:100%;
    }

    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
 </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<body>
 <div class="container">
 <div class="row">
 <div class="col-md-12" style="padding-top: 5%">
 <div class="card card-default">
 <div class="card-header">
 <div class="row">
 <div class="col-md-10">
 <strong style="color: deepskyblue">Tambah Data Project</strong>
 </div>
 </div>
 </div>
 <div class="card-body">
 <form id="addUser" class="" method="POST" action="">
 {{-- Grup Inputan --}}
 {{-- Nama --}}
 <div class="form-group">
 <label for="nama" class="col-md-12 col-form-label">Nama Developer</label>
 
 <div class="col-md-12">
 <input id="nama" type="text" class="form-control" name="nama" value="" required autofocus>
 </div>

 <div class="form-group">
 <label for="no_telp" class="col-md-12 col-form-label">No Telepon</label>
 
 <div class="col-md-12">
 <input id="no_telp" type="text" class="form-control" name="no_telp" value="" required autofocus>
 </div>
 
 <div class="form-group">
 <label for="nama_project" class="col-md-12 col-form-label">Nama Project</label>
 
 <div class="col-md-12">
 <input id="nama_project" type="text" class="form-control" name="nama_project" value="" required autofocus>
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

 <div class="form-group">
 <label for="progress" class="col-md-12 col-form-label">Progress</label>
       
 <div class="col-md-12">
 <input id="progress" type="text" class="form-control" name="progress" value="" required autofocus>
 </div>
 </div>
 <div class="form-group">
 <label for="waktu" class="col-md-12 col-form-label">Waktu</label>
       
 <div class="col-md-12">
 <input id="waktu" type="text" class="form-control" name="waktu" value="" required autofocus>
 </div>
</div>
 <div class="form-group">
 <div class="col-md-12 col-md-offset-3">
 <button type="button" class="btn btn-primary btn-block desabled" id="submitUser">
 Tambah
 </button>
 </div>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div> 
 </div>
 </div>
 </div>


 {{-- Tabel Data --}}
 <div class="col-md-12" style="padding-top: 2%">
 <div class="card card-default">
 <div class="card-header">
 <div class="row">
 <div class="col-md-12">
 <strong style="color: deepskyblue">Daftar Semua Project</strong>
 </div>
 </div>
 </div>
 
 <div class="card-body" style="overflow-x:auto;">
 
 <table class="table table-bordered">
 <tr>
 <th>Nama Developer</th>
 <th>No Telepon</th>
 <th>Nama Project</th>
 <th>Tim</th>
 <th>Progress</th>
 <th>Waktu</th>
 <th width="180" class="text-center">Aksi</th>
 </tr>
 <tbody id="tbody">
 
 </tbody> 
 </table>
 </div>
 </div>
 </div>
 </div>
 </div>

 
 <!-- Model untuk Hapus -->
 <form action="" method="POST" class="users-remove-record-model">
 <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog" style="width:55%;">
 <div class="modal-content">
 <div class="modal-header">
 <h4 class="modal-title" id="custom-width-modalLabel">Hapus Data</h4>
 <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
 </div>
 <div class="modal-body">
 <h4>Apakah kamu yakin ingin menghapus data?</h4>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Tutup</button>
 <button type="button" class="btn btn-danger waves-effect waves-light deleteMatchRecord">Hapus</button>
 </div>
 </div>
 </div>
 </div>
 </form>
 
 <!-- Model untuk update -->
 <form action="" method="POST" class="users-update-record-model form-horizontal">
 <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog" style="width:55%;">
 <div class="modal-content" style="overflow: hidden;">
 <div class="modal-header">
 <h4 class="modal-title" id="custom-width-modalLabel">Update Data</h4>
 <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
 </div>
 <div class="modal-body" id="updateBody">
 
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Tutup</button>
 <button type="button" class="btn btn-success waves-effect waves-light updateUserRecord">Update</button>
 </div>
 </div>
 </div>
 </div>
 </form>
 <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-app.js"></script>
 <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-database.js"></script>
 <script>
 // Pengaturan konfigurasi Firebase SDK
 var config = {
 apiKey: "{{ config('services.firebase.api_key') }}",
 authDomain: "{{ config('services.firebase.auth_domain') }}",
 databaseURL: "{{ config('services.firebase.database_url') }}",
 projectId: "{{ config('services.firebase.project_id') }}",
 storageBucket: "{{ config('services.firebase.storage_bucket') }}",
 messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
 appId: "{{ config('services.firebase.app_id') }}",
 measurementId: "{{ config('services.firebase.measurement_id') }}"
 };
 // Inisialisasi Firebase
 firebase.initializeApp(config);
 
 var database = firebase.database();
 
 var lastIndex = 0;
 
 // Mendapatkan Data
 firebase.database().ref('users/').on('value', function(snapshot) { 
 var value = snapshot.val();
 var htmls = [];
 $.each(value, function(index, value){
 if(value) {
 htmls.push('<tr>\
 <td>'+ value.nama +'</td>\
 <td>'+ value.no_telp +'</td>\
 <td>'+ value.nama_project +'</td>\
 <td>'+ value.tim +'</td>\
 <td>'+ value.progress +'</td>\
 <td>'+ value.waktu +'</td>\
 <td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+index+'">Update</a>\
 <a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="'+index+'">Hapus</a></td>\
 </tr>');
 }    	
 lastIndex = index;
 });
 $('#tbody').html(htmls);
 $("#submitUser").removeClass('desabled');
 });
 
 
 // Menambah Data
 $('#submitUser').on('click', function(){
 var values = $("#addUser").serializeArray();
 var nama = values[0].value;
 var no_telp = values[1].value;
 var nama_project= values[2].value;
 var tim = values[3].value;
 var progress = values[4].value;
 var waktu = values[5].value;
 var userID = lastIndex+1;
 
 firebase.database().ref('users/' + userID).set({ 
 nama: nama, //penamaan kolom di database
 no_telp: no_telp,
 nama_project: nama_project,
 tim: tim,
 progress: progress,
 waktu: waktu,
 });
 
 // Nilai id
 lastIndex = userID;
 $("#addUser input").val("");
 });
 
 // Update Data
 var updateID = 0;
 $('body').on('click', '.updateData', function() {
 updateID = $(this).attr('data-id');
 firebase.database().ref('users/' + updateID).on('value', function(snapshot) { 
 var values = snapshot.val();
 // perbarui data
 var updateData = '<div class="form-group">\
 <label for="nama" class="col-md-12 col-form-label">Nama Developer</label>\
 <div class="col-md-12">\
 <input id="nama" type="text" class="form-control" name="nama" value="'+values.nama+'" required autofocus>\
 </div>\
 </div>\
 <div class="form-group">\
 <label for="no_telp" class="col-md-12 col-form-label">No Telepon</label>\
 <div class="col-md-12">\
 <input id="no_telp" type="text" class="form-control" name="no_telp" value="'+values.no_telp+'" required autofocus>\
 </div>\
 </div>\
 <div class="form-group">\
 <label for="nama_project" class="col-md-12 col-form-label">Nama Project</label>\
 <div class="col-md-12">\
 <input id="nama_project" type="text" class="form-control" name="nama_project" value="'+values.nama_project+'" required autofocus>\
 </div>\
 </div>\
 <div class="form-group">\
 <label for="tim" class="col-md-12 col-form-label">TIM</label>\
 <div class="col-md-12">\
 <input id="tim" type="text" class="form-control" name="tim" value="'+values.tim+'" required autofocus>\
 </div>\
 </div>\
 <div class="form-group">\
 <label for="progress" class="col-md-12 col-form-label">Progress</label>\
 <div class="col-md-12">\
 <input id="progress" type="text" class="form-control" name="progress" value="'+values.progress+'" required autofocus>\
 </div>\
 </div>';
 
 $('#updateBody').html(updateData);
 });
 });
 
 $('.updateUserRecord').on('click', function() {
 var values = $(".users-update-record-model").serializeArray();
 var postData = {
 nama : values[0].value,
 no_telp : values[1].value,
 nama_project : values[2].value,
 tim : values[3].value,
 progress : values[4].value,
 waktu : values[5].value,
 };
 
 var updates = {};
 updates['/users/' + updateID] = postData; 
 
 firebase.database().ref().update(updates);
 
 $("#update-modal").modal('hide');
 });
 
 
 // Hapus Data
 $("body").on('click', '.removeData', function() {
 var id = $(this).attr('data-id');
 $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
 });
 
 $('.deleteMatchRecord').on('click', function(){
 var values = $(".users-remove-record-model").serializeArray();
 var id = values[0].value;
 firebase.database().ref('users/' + id).remove();
 $('body').find('.users-remove-record-model').find( "input" ).remove();
 $("#remove-modal").modal('hide');
 });
 $('.remove-data-from-delete-form').click(function() {
 $('body').find('.users-remove-record-model').find( "input" ).remove();
 });
 </script>
</body>
</html>