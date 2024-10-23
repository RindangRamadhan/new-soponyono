<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
      <label>Nama</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama"
          required data-validation-required-message="This name field is required"
          value="{{isset($role) ? $role->name : old('name')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('name')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>

    <div class="tree-view"></div>
    <input type="hidden" id="permission" name="permission">
  </div>
</div>


<style>
  .treejs>.treejs-nodes {
    padding-left: 0px !important;
  }

  .treejs>.treejs-nodes~.treejs-nodes {
    padding-left: 20px !important;
  }
</style>