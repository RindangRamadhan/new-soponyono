<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Kode</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="id" class="form-control  @error('id') is-invalid @enderror" placeholder="Kode" required data-validation-required-message="This kode field is required" value="{{isset($rsdata) ? $rsdata->id : old('id')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('id')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>UP3</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="up3_id" name="up3_id" class="select2 form-control @error('up3_id') is-invalid @enderror" required data-validation-required-message="This main unit field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('up3_id')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>Name</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Name" required data-validation-required-message="This name field is required" value="{{isset($rsdata) ? $rsdata->name : old('name')}}">
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
  </div>
  
  <div class="col-sm-6">
    <div class="form-group">
      <label>Latitude</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="latitude" class="form-control  @error('latitude') is-invalid @enderror" placeholder="Latitude" required data-validation-required-message="This latitude field is required" value="{{isset($rsdata) ? $rsdata->latitude : old('latitude')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('latitude')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>Longitude</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="longitude" class="form-control  @error('longitude') is-invalid @enderror" placeholder="Longitude" required data-validation-required-message="This longitude field is required" value="{{isset($rsdata) ? $rsdata->longitude : old('longitude')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('longitude')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>
  

</div>