<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>User Name</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="user_name" class="form-control  @error('user_name') is-invalid @enderror" placeholder="User user_name" required data-validation-required-message="This user_name field is required" value="{{isset($user) ? $user->user_name : old('user_name')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('user_name')
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
      <label>Nama</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama" required data-validation-required-message="This name field is required" value="{{isset($user) ? $user->name : old('name')}}">
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
      <label>No. Hp</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="number" name="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="No. Hp" value="{{isset($user) ? $user->phone : old('phone')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('phone')
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
      <label>Foto</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <div class="custom-file">
          <input type="file" name="photo" class="custom-file-input" accept=".png, .jpg, .jpeg">
          <label class="custom-file-label" for="fileExcel">Unggah Foto</label>
        </div>
      </div>
    </div>
  </div>
</div>