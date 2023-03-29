<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>ULP</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="ulp_id" name="ulp_id" class="select2 form-control @error('ulp_id') is-invalid @enderror" required data-validation-required-message="This ulp field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('ulp_id')
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
      <label>Manager</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="user_id" name="user_id" class="select2 form-control @error('user_id') is-invalid @enderror" required data-validation-required-message="This manager field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('user_id')
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
      <label>Lokasi</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="location" class="form-control  @error('location') is-invalid @enderror" placeholder="Lokasi" required data-validation-required-message="This lokasi field is required" value="{{isset($manager_ulp) ? $manager_ulp->location : old('location')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('location')
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
    <div class="media mb-1 d-flex justify-content-center">
      <a class="mr-1" href="#">
        @if (isset($manager_ulp->tanda_tangan))
        <img src="{{ asset('/images/upload/'.$manager_ulp->tanda_tangan) }}" alt="users view avatar" class="users-avatar-shadow round" height="100" width="100">
        @else
        <img src="https://ui-avatars.com/api/?name=TTD" alt="users view avatar" class="users-avatar-shadow round" height="100" width="100">
        @endif
      </a>
    </div>
    <div class="form-group">
      <label>Tanda Tangan</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <div class="custom-file">
          <input type="file" name="tanda_tangan" class="custom-file-input" accept=".png, .jpg, .jpeg">
          <label class="custom-file-label" for="fileExcel">Unggah Foto</label>
        </div>
      </div>
    </div>
  </div>
  
</div>