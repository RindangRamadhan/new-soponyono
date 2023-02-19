<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>User Name</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="user_name" class="form-control  @error('user_name') is-invalid @enderror" placeholder="User Name" required data-validation-required-message="This user_name field is required" value="{{isset($user) ? $user->user_name : old('user_name')}}">
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
      <label>Kode RBM</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="rbm_code" class="form-control  @error('rbm_code') is-invalid @enderror" placeholder="Kode RBM" required data-validation-required-message="This rbm_code field is required" value="{{isset($user) ? $user->rbm_code : old('rbm_code')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('rbm_code')
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
      <label>Tipe</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="type" name="type" class="select2 form-control @error('type') is-invalid @enderror" required data-validation-required-message="This work unit field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('type')
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
        <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="No. Hp" value="{{isset($user) ? $user->phone : old('phone')}}">
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
      <label>Jabatan</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="position" class="form-control  @error('position') is-invalid @enderror" placeholder="Jabatan" value="{{isset($user) ? $user->position : old('position')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('position')
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
      <label>UP3</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="up3_id" name="up3_id" class="select2 form-control @error('up3_id') is-invalid @enderror" required data-validation-required-message="This work unit field is required">
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
      <label>ULP</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="ulp_id" name="ulp_id" class="select2 form-control">
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
      <label>Hak Akses</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="role_id" name="role_id" class="select2 form-control @error('role_id') is-invalid @enderror" required data-validation-required-message="This work unit field is required">
          <option></option>
        </select>
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('role_id')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>

  @if (!isset($user))

  <div class="col-sm-6">
    <div class="form-group">
      <label>Password</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" required data-validation-required-message="This password field is required" value="{{isset($user) ? $user->password : old('password')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('password')
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
      <label>Konfirmasi Password</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" required data-validation-required-message="This password confirmation field is required" value="{{isset($user) ? $user->password_confirmation : old('password_confirmation')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('password_confirmation')
        <div class="help-block">
          <ul role="alert">
            <li>{{ $message }}</li>
          </ul>
        </div>
        @enderror
      </div>
    </div>
  </div>

  @endif
</div>