@extends('layouts.app')
{{-- page title --}}
@section('title','Customer')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
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
<!-- Uid start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label>UP3</label>
              <div class="controls form-label-group position-relative has-icon-left">
                <select id="up3_id" name="up3_id" class="select2 form-control ">
                  <option></option>
                </select>
                <div class="form-control-position">
                  <i class="bx bx-edit-alt"></i>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>ULP</label>
              <div class="controls form-label-group position-relative has-icon-left">
                <select id="ulp_id" name="ulp_id" class="select2 form-control">
                  <option></option>
                </select>
                <div class="form-control-position">
                  <i class="bx bx-edit-alt"></i>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <br>
              <button class="btn btn-outline-primary mr-1 mb-1" onclick="tampilkan_data()">
                <i class="bx bx-search"></i>
                <span class="align-middle ml-25">Tampilkan</span>
              </button>
            </div>
          </div>

        </div>

        <div class="table-responsive">
          <table class="table table-sm table-ssr nowrap">
            <tfoot style="display: table-row-group">
              <th>Id</th>
              <th>UP3</th>
              <th>ULP</th>
              <th>ID PEL</th>
              <th>Name</th>
              <th>No Telp</th>
              <th>Gardu</th>
              <th>Status</th>
              <th>Action</th>
            </tfoot>
            <thead>
              <tr>
                <th>Id</th>
                <th>UP3</th>
                <th>ULP</th>
                <th>ID PEL</th>
                <th>Name</th>
                <th>No Telp</th>
                <th>Gardu</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- Uid ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script>
  @if (Session::get('status') == 200)
    $(document).ready(function(){
      toastr.success('Data has been saved', 'Success', { "progressBar": true, "showDuration": 500, "closeButton": true })
    });
  @endif

  $(document).ready(function () {
    
    $('#up3_id').select2({
      data: @php echo json_encode($up3s) @endphp,
      placeholder: 'Pilih UP3'
    });
    $('#ulp_id').select2({
      placeholder: 'Pilih ULP'
    });

    const params = {
      "url": "{{ url('/master-data/customers') }}",
      "columns": [
        { "data": "id", "visible": false },
        { "data": "up3__name" },
        { "data": "ulp__name" },
        { "data": "id_pel" },
        { "data": "name" },
        { "data": "phone_number" },
        { "data": "gardu" },
        { "data": "status" },
        { "data": "action", "searchable": false, "orderable": false }
      ]
    }

    dataTableServerSide(params)


  })

  async function tampilkan_data() {
    let id_up3 =$('#up3_id').val()
    let id_ulp =$('#upl_id').val()
    let data =await axios.post(`${api}/master-data/customers/list/${id_up3}/${id_ulp}`)


}

  $(document).on('change', '#up3_id', function (e) {
    const data = $(this).select2('data')[0]
    const ulp = $('#ulp_id');

    ulp.html('').select2({
      data: [{id: '', text: ''}]
    });

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: `${api}/master-data/ulp/list-select`,
      dataType:"json",
      data: { up3_id: data.id },
      success: function(response){
        ulp.select2({
          data: response,
          placeholder: 'Pilih ULP'
        });
      }
    });
  })

  // Confirmation Delete
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    
    const params = {
      "name": this.dataset.name,
      "url": "{{ url('/master-data/customers/') }}",
      "id": $(this).attr('data-id'),
      "tr": $(this).parent("td").parent('tr')
    }
    
    confirmDelete(params)
  })

</script>
@endsection