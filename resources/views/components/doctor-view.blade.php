<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="first_name" class="mb-2"><span class="required">*</span>
            First Name</label>
        <input type="text" class="form-control" id="first_name"
               name="first_name" value="{{ old('first_name') }}"
               placeholder="First Name" required>
    </div>
    <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="last_name" class="mb-2"><span class="required">*</span> Last
            Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name"
               value="{{ old('last_name') }}"
               placeholder="Last Name" required>
    </div>
    <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="designation" class="mb-2"><span class="required">*</span>
            Designation</label>
        <input type="text" class="form-control" id="designation"
               name="designation" value="{{ old('designation') }}"
               placeholder="Designation" required>
    </div>
    <span
        class="text-danger">@error('designation'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <fieldset
        class="form-group">
        <label for="user_type" class="mb-2 d-flex align-items-center">Doctor Type</label>
        <select name="user_type" class="form-control select2" style="width: 100%" required>
            <option hidden value=""></option>
            <option value="INDOOR"
                    @if (old('user_type') == 'INDOOR') selected="selected" @endif>
                Indoor
            </option>
            <option value="OUTDOOR"
                    @if (old('user_type') == 'OUTDOOR') selected="selected" @endif>
                Outdoor
            </option>
        </select>
    </fieldset>
    <span
        class="text-danger">@error('user_type'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="phone_number" class="mb-2"><span class="required">*</span>
            Phone Number</label>
        <input type="text" class="form-control" id="phone_number"
               name="phone_number" value="{{ old('phone_number') }}"
               placeholder="Phone Number" required>
    </div>
    <span
        class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="dob" class="mb-2"><span class="required">*</span> Date of
            Birth</label>
        <input type="date" class="form-control" id="dob" name="dob"
               value="{{ old('dob') }}" required>
    </div>
    <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="gender" class="mb-2 d-flex align-items-center"><span class="required">*</span> Gender</label>
        <select name="gender" class="form-control select2" style="width: 100%" required>
            <option hidden value=""></option>
            <option value="male"
                    @if (old('gender') == 'male') selected="selected" @endif>
                Male
            </option>
            <option value="female"
                    @if (old('gender') == 'female') selected="selected" @endif>
                Female
            </option>
            <option value="other"
                    @if (old('gender') == 'other') selected="selected" @endif>
                Other
            </option>
        </select>
    </div>
    <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="blood_group" class="mb-2 d-flex align-items-center"><span class="required">*</span>
            Blood Group</label>
        <select name="blood_group" class="form-control select2" style="width: 100%" required>
            <option hidden value=""></option>
            <option value="a+"
                    @if (old('blood_group') == 'a+') selected="selected" @endif>
                A+
            </option>
            <option value="a-"
                    @if (old('blood_group') == 'a-') selected="selected" @endif>
                A-
            </option>
            <option value="b+"
                    @if (old('blood_group') == 'b+') selected="selected" @endif>
                B+
            </option>
            <option value="b-"
                    @if (old('blood_group') == 'b-') selected="selected" @endif>
                B-
            </option>
            <option value="o+"
                    @if (old('blood_group') == 'o+') selected="selected" @endif>
                O+
            </option>
            <option value="o-"
                    @if (old('blood_group') == 'o-') selected="selected" @endif>
                O-
            </option>
            <option value="ab+"
                    @if (old('blood_group') == 'ab+') selected="selected" @endif>
                AB+
            </option>
            <option value="ab-"
                    @if (old('blood_group') == 'ab-') selected="selected" @endif>
                AB-
            </option>
        </select>
    </div>
    <span
        class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="nid" class="mb-2"><span class="required">*</span> NID</label>
        <input type="text" class="form-control" id="nid" name="nid"
               value="{{ old('nid') }}"
               placeholder="NID Number" required>
    </div>
    <span class="text-danger">@error('nid'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="salary" class="mb-2"><span class="required">*</span> Salary</label>
        <div class="input-group">
            <input type="number" class="form-control" id="salary" name="salary"
                   value="{{ old('salary') }}"
                   placeholder="Salary" required>
            <span class="input-group-text">BDT</span>
        </div>
    </div>
    <span class="text-danger">@error('salary'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="joining_date" class="mb-2">Joining Date</label>
        <input type="date" class="form-control" id="joining_date"
               name="joining_date" value="{{ old('joining_date') }}">
    </div>
    <span
        class="text-danger">@error('joining_date'){{ $message }}@enderror</span>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group mb-3">
        <label for="biography" class="mb-2">Biography</label>
        <textarea class="form-control"
                  name="biography"
                  rows="3">{{ old('biography') }}</textarea>
    </div>
    <span class="text-danger">@error('biography'){{ $message }}@enderror</span>
</div>
<div class="divider">
    <div class="divider-text">Address</div>
</div>
<div class="col- mt-2">
    <label for="present_address" class="mt-2 font-weight-bolder">Present
        Address</label>
    <hr style="margin: 10px 0px">
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address['country']"
               class="mb-2"><span class="required">*</span> Country</label>
        <input type="text" name="present_address[country]"
               id="present_country" class="form-control"
               value="{{old('present_address[country]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address[district]"
               class="mb-2"><span class="required">*</span> District</label>
        <input type="text" name="present_address[district]"
               id="present_district"
               class="form-control"
               value="{{old('present_address[district]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address[upazila]" class="mb-2"><span
                class="required">*</span> Thana/Upazila</label>
        <input type="text" name="present_address[upazila]" id="present_upazila"
               class="form-control"
               value="{{old('present_address[upazila]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address[post_code]" class="mb-2"><span
                class="required">*</span> Post
            Code</label>
        <input type="text" name="present_address[post_code]" id="present_post"
               class="form-control"
               value="{{old('present_address[post_code]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address[address_line1]" class="mb-2"><span
                class="required">*</span> Address
            Line
            1</label>
        <textarea class="form-control"
                  name="present_address[address_line1]" id="present_add1"
                  rows="2"
                  required></textarea>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="present_address[address_line2]" class="mb-2">Address
            Line
            2</label>
        <textarea class="form-control"
                  name="present_address[address_line2]" id="present_add2"
                  rows="2"></textarea>
    </div>
</div>
<div class="col- mt-2">
    <label for="permanent_address" class="mt-2 font-weight-bolder">Permanent
        Address &nbsp; &nbsp;</label>
    <input type="checkbox" id="same_as_present" name="same_as_present">
    <label for="same_as_present">Same as Present</label>
    <hr style="margin: 10px 0px">
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address['country']" class="mb-2"><span
                class="required">*</span> Country</label>
        <input type="text" name="permanent_address[country]"
               id="permanent_country"
               class="form-control"
               value="{{old('permanent_address[country]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address[district]" class="mb-2"><span
                class="required">*</span> District</label>
        <input type="text" name="permanent_address[district]"
               id="permanent_district"
               class="form-control"
               value="{{old('permanent_address[district]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address[upazila]" class="mb-2"><span
                class="required">*</span> Thana/Upozila</label>
        <input type="text" name="permanent_address[upazila]"
               id="permanent_upazila"
               class="form-control"
               value="{{old('permanent_address[upazila]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address[post_code]" class="mb-2"><span
                class="required">*</span> Post
            Code</label>
        <input type="text" name="permanent_address[post_code]"
               id="permanent_post"
               class="form-control"
               value="{{old('permanent_address[post_code]')}}" required>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address[address_line1]" class="mb-2"><span
                class="required">*</span> Address
            Line
            1</label>
        <textarea class="form-control"
                  name="permanent_address[address_line1]" id="permanent_add1"
                  rows="2"
                  required></textarea>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="permanent_address[address_line2]" class="mb-2">Address
            Line
            2</label>
        <textarea class="form-control"
                  name="permanent_address[address_line2]" id="permanent_add2"
                  rows="2"></textarea>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="status"><span class="required">*</span> Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"
                   id="active"
                   value="1" @if( old('status')) == "1" ? 'checked' : '' @endif
            required>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"
                   id="inactive"
                   value="0" @if( old('status')) == "0" ? 'checked' : '' @endif
            required>
            <label class="form-check-label" for="inactive">Inactive</label>
        </div>
        <span class="text-danger">@error('status'){{ $message }}@enderror</span>
    </div>
</div>
