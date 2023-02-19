<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Kode</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" id="id" name="id" class="form-control  @error('id') is-invalid @enderror" placeholder="Kode" required data-validation-required-message="This kode field is required" value="{{isset($uid) ? $uid->id : old('id')}}">
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
      <label>Name</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Name" required data-validation-required-message="This name field is required" value="{{isset($uid) ? $uid->name : old('name')}}">
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
  <div class="col-sm-12">
    <div class="form-group">
      <label>No Telp</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="phone_number" class="form-control " placeholder="No Telp" value="{{isset($uid) ? $uid->phone_number : old('phone_number')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="form-group">
      <label>Alamat</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <textarea class="form-control editors" name="address" rows="10" cols="30" placeholder="Alamat">{{isset($uid) ? $uid->address : old('address')}}</textarea>
          
          <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>Latitude</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="latitude" class="form-control " placeholder="Latitude" value="{{isset($uid) ? $uid->latitude : old('latitude')}}">
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
        <input type="text" name="longitude" class="form-control " placeholder="Longitude"  value="{{isset($uid) ? $uid->longitude : old('longitude')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
       
      </div>
    </div>
  </div>
  

</div>