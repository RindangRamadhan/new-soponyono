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
        <input type="text" id="id" name="id" class="form-control  @error('id') is-invalid @enderror" placeholder="ID PEL"
          required data-validation-required-message="This id field is required"
          value="{{isset($customer) ? $customer->id : old('id')}}">
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
        <input type="text" name="phone_number" class="form-control "
          placeholder="No Telp" 
          value="{{isset($customer) ? $customer->phone_number : old('phone_number')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label>Tarif</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="tarif" class="form-control  @error('tarif') is-invalid @enderror" placeholder="Tarif"
          required data-validation-required-message="This tarif field is required"
          value="{{isset($customer) ? $customer->tarif : old('tarif')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('tarif')
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
      <label>Daya</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="power" class="form-control  @error('power') is-invalid @enderror" placeholder="Daya"
          required data-validation-required-message="This power field is required"
          value="{{isset($customer) ? $customer->power : old('power')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('power')
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
      <label>Kogol</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="class" class="form-control  @error('class') is-invalid @enderror" placeholder="Kogol"
          required data-validation-required-message="This class field is required"
          value="{{isset($customer) ? $customer->class : old('class')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('class')
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
      <label>Gardu</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <input type="text" name="substation" class="form-control  @error('substation') is-invalid @enderror" placeholder="Gardu"
          required data-validation-required-message="This Gardu field is required"
          value="{{isset($customer) ? $customer->substation : old('substation')}}">
        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>
        <!-- Error Message -->
        @error('substation')
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
      <label>Alamat</label>
      <div class="controls form-label-group position-relative has-icon-left">
        <textarea class="form-control editors" name="address" rows="10" cols="30"
          placeholder="Alamat">{{isset($customer) ? $customer->address : old('address')}}</textarea>

        <div class="form-control-position">
          <i class="bx bx-edit-alt"></i>
        </div>

      </div>
    </div>
  </div>


</div>