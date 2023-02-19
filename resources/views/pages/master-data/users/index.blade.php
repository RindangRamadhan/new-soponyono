@extends('layouts.app')
{{-- page title --}}
@section('title','Pengguna')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">

<style>
  .DTFC_Cloned thead {
    background: white;
  }

  .DTFC_Cloned tbody {
    background: white;
  }

</style>
@endsection

@section('content')
<!-- Pengguna start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="onshowbtn" data-target="#modal">
          <i class="bx bx-upload"></i>
          <span>Unggah Pengguna</span>
        </button>
        <a href="{{ url('/master-data/users/export') }}" class="btn btn-warning">
          <i class="bx bx-download"></i>
          <span>Unduh Pengguna</span>
        </a>

        <div class="table-responsive">
          <table class="table table-sm table-ssr nowrap">
            <tfoot style="display: table-row-group">
              <th>Id</th>
              <th>Username</th>
              <th>Kode RBM</th>
              <th>Nama</th>
              <th>Tipe</th>
              <th>UID</th>
              <th>UP3</th>
              <th>ULP</th>
              <th>Hak Akses</th>
              <th>Action</th>
            </tfoot>
            <thead>
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Kode RBM</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>UID</th>
                <th>UP3</th>
                <th>ULP</th>
                <th>Hak Akses</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title white" id="myModalLabel160">Unggah Pengguna</h5>
          <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="form" enctype="multipart/form-data">

            <div class="custom-file">
              <input type="file" name="file" class="custom-file-input" id="fileExcel">
              <label class="custom-file-label" for="fileExcel">Unggah Dokumen Excel</label>
            </div>

            <div class="text-center mt-1" id="spinner" style="display: none">
              <div class="spinner-border spinner-border-lg text-primary" role="status">
                <span class="sr-only"> ...</span>
              </div>
            </div>

            <div class="progress progress-bar-primary mt-1" id="progress" style="height: 15px; display: none">
              <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">0%</div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light-secondary mr-auto btn-close" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <a href="{{ url('/master-data/users/download-template') }}" id="btnDownload" class="btn btn-sm btn-success">
            Unduh Template
          </a>
          <button class="btn btn-sm btn-primary ml-1" id="btnUpload" type="button">
            <span id="spanUpload">Unggah</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Pengguna ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

@section('page-scripts')
<script>
  @if (Session::get('status') == 200)
    $(document).ready(function(){
      toastr.success('Data has been saved', 'Success', { "progressBar": true, "showDuration": 500, "closeButton": true })
    });
  @endif

  $(document).ready(function () {
    const params = {
      "url": "{{ url('/master-data/users') }}",
      "columns": [
        { "data": "users__id", "visible": false },
        { "data": "user_name" },
        { "data": "rbm_code" },
        { "data": "users__name" },
        { "data": "users__type" },
        { "data": "uid__name" },
        { "data": "up3__name" },
        { "data": "ulp__name" },
        { "data": "r__name" },
        { "data": "action", "searchable": false, "orderable": false }
      ]
    }

    dataTableServerSide(params)
  })

  // Confirmation Delete
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    const params = {
      "name": this.dataset.name,
      "url": "{{ url('/master-data/users/') }}",
      "id": $(this).attr('data-id'),
      "tr": $(this).parent("td").parent('tr')
    }

    confirmDelete(params)
  })

  // Confirmation Delete
  $(document).on('click', '.btn-reset-password', function (e) {
    e.preventDefault();
    const params = {
      "name": this.dataset.name,
      "url": "{{ url('/master-data/users/') }}",
      "id": $(this).attr('data-id'),
      "tr": $(this).parent("td").parent('tr')
    }

    confirmResetPassword(params)
  })

  // On Upload
  $('#btnUpload').on('click', function () {
    let progress = 0;
    let interval = setInterval(fakeProgress, 25);
    
    const form = $('#form');
    const data = new FormData(form[0]);

    $("#spanUpload").remove()
    $(".btn-close").attr("disabled", true)
    $("#fileExcel").attr("disabled", true)
    $(this).attr("disabled", true)
    $(this).append("<span id='spanLoading' class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Memuat ...")

    $("#spinner").show()
    
    // Send to server after progress bar show
    $("#progress").slideDown('fast', () => {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        xhr: function() {
          const xhr = new window.XMLHttpRequest();

          xhr.upload.addEventListener("progress", function(e) {
            if (e.lengthComputable) {
              const percent = parseInt((e.loaded / e.total) * 100);
              
              $("#progressbar").attr('aria-valuenow', percent);
              $("#progressbar").css('width', `${percent}%`);
              $("#progressbar").html(`${percent}%`)
            }
          }, false);

          return xhr;
        },
        url: "{{ route('users.upload') }}",
        type: 'POST',
        processData: false,
        contentType: false,
        data: data,
        success: function (resp){
          $("#btnUpload").empty()
          $("#btnUpload").attr("disabled", false)
          $("#btnUpload").append("<span id='spanUpload'>Unggah</span>")
          $(".btn-close").attr("disabled", false)
          $("#progressbar").attr('aria-valuenow', 100);
          $("#progressbar").css('width', `${100}%`);
          $("#progressbar").html(`${100}%`)

          $('.table-ssr').DataTable().draw();

          clearInterval(interval);
            
          setTimeout(() => {
            $("#modal").modal('hide');
            $("#progressbar").attr('aria-valuenow', 0);
            $("#progressbar").css('width', `${0}%`);
            $("#progressbar").html(`${0}%`)
            $("#progress").slideUp('fast');
            $("#form").trigger('reset');
            $(".custom-file-label").text('Unggah Dokumen Excel');
            $("#spinner").hide()
            $("#fileExcel").attr("disabled", false)
          }, 1000);

          if (resp.user_failed > 0) {
            const message = `${resp.user_upload - resp.user_failed} Pengguna berhasil diunggah. ${resp.user_failed} Pengguna gagal, silahkan unduh dokumen untuk informasi lebih detail.`
            toastr.warning(message, 'Sukses', { "progressBar": true, "showDuration": 3000, "closeButton": true })
          } else {
            toastr.success('Dokumen berhasil di unggah', 'Sukses', { "progressBar": true, "showDuration": 500, "closeButton": true })
          }
        },
        error: function(xhr) {
          const err = JSON.parse(xhr.responseText)

          $("#btnUpload").empty()
          $("#btnUpload").attr("disabled", false)
          $("#btnUpload").append("<span id='spanUpload'>Unggah</span>")

          $(".btn-close").attr("disabled", false)
          $("#progressbar").attr('aria-valuenow', 100);
          $("#progressbar").css('width', `${100}%`);
          $("#progressbar").html(`${100}%`)
          
          clearInterval(interval);
          setTimeout(() => {
            $("#spinner").hide()
            $("#fileExcel").attr("disabled", false)
            $("#modal").modal('hide');
          }, 500);

          if ('message' in err) {
            toastr.error('Dokumen gagal di unggah '+ err.message, 'Gagal', { "progressBar": true, "showDuration": 500, "closeButton": true })
          }
        }
      });
    })

    function fakeProgress() {
      const max = Math.floor(Math.random() * 41) + 50 

      if (progress >= max) {
        clearInterval(interval);
        i = 0;
      } else {
        progress++;
        $("#progressbar").attr('aria-valuenow', progress);
        $("#progressbar").css('width', `${progress}%`);
        $("#progressbar").html(`${progress}%`)
      }
    }
  });
</script>
@endsection