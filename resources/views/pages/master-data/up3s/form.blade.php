<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Kode</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" id="id" name="id" class="form-control  @error('id') is-invalid @enderror" placeholder="Kode" required data-validation-required-message="This kode field is required" value="{{isset($up3) ? $up3->id : old('id')}}">
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
      <label>UID</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="uid_id" name="uid_id" class="select2 form-control @error('uid_id') is-invalid @enderror" required data-validation-required-message="This main unit field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('uid_id')
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
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Name" required data-validation-required-message="This name field is required" value="{{isset($up3) ? $up3->name : old('name')}}">
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
        <input type="text" name="latitude" class="form-control " placeholder="Latitude" value="{{isset($up3) ? $up3->latitude : old('latitude')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>Longitude</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="longitude" class="form-control " placeholder="Longitude"  value="{{isset($up3) ? $up3->longitude : old('longitude')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
       
      </div>
    </div>
  </div>
  

</div>