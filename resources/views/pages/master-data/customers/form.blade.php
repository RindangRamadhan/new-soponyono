<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>UID</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <select id="uid_id" name="uid_id" class="select2 form-control @error('uid_id') is-invalid @enderror" required
          data-validation-required-message="This main unit field is required">
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
        <select id="up3_id" name="up3_id" class="select2 form-control @error('up3_id') is-invalid @enderror" required
          data-validation-required-message="This work unit field is required">
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
      <label>ID PEL</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="id_pel" class="form-control  @error('id_pel') is-invalid @enderror"
          placeholder="ID PEL" required data-validation-required-message="This id_pel field is required"
          value="{{isset($customer) ? $customer->id_pel : old('id_pel')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('id_pel')
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
        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama"
          required data-validation-required-message="This name field is required"
          value="{{isset($customer) ? $customer->name : old('name')}}">
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
      <label>No Telp</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="phone_number" class="form-control  @error('phone_number') is-invalid @enderror" placeholder="No Telp"
          required data-validation-required-message="This No Telp field is required"
          value="{{isset($customer) ? $customer->phone_number : old('phone_number')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('phone_number')
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
      <label>Tarif</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="tarif" class="form-control " placeholder="Tarif"
          value="{{isset($customer) ? $customer->tarif : old('tarif')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>

      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label>Daya</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="daya" class="form-control " placeholder="Daya"
          value="{{isset($customer) ? $customer->daya : old('daya')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>

      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label>Kogol</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="kogol" class="form-control " placeholder="Kogol"
          value="{{isset($customer) ? $customer->kogol : old('kogol')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>

      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label>Gardu</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="gardu" class="form-control " placeholder="Gardu"
          value="{{isset($customer) ? $customer->gardu : old('gardu')}}">
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
        <textarea class="form-control editors" name="address" rows="10" cols="30"
          placeholder="Alamat">{{isset($uid) ? $uid->address : old('address')}}</textarea>

        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>

      </div>
    </div>
  </div>


</div>