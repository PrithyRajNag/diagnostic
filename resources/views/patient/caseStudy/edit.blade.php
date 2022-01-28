@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Patient Case Study Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('patient-case-study.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('patient-case-study.update', 1)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="patient_id" class="mb-2">Patient ID</label>
                                                <input type="text" class="form-control" id="patient_id" name="patient_id" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="food_allergies" class="mb-2">Food Allergies</label>
                                                <input type="text" class="form-control" id="food_allergies" name="food_allergies" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('food_allergies'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="tendency_bleed" class="mb-2">Tendency Bleed</label>
                                                <input type="text" class="form-control" id="tendency_bleed" name="tendency_bleed" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('tendency_bleed'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="heart_disease" class="mb-2">Heart Disease</label>
                                                <input type="text" class="form-control" id="heart_disease" name="heart_disease" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('heart_disease'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="high_blood_pressure" class="mb-2">High Blood Pressure</label>
                                                <input type="text" class="form-control" id="high_blood_pressure" name="high_blood_pressure" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('high_blood_pressure'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="diabetic" class="mb-2">Diabetic</label>
                                                <input type="text" class="form-control" id="diabetic" name="diabetic" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('diabetic'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="surgery" class="mb-2">Surgery</label>
                                                <input type="text" class="form-control" id="surgery" name="surgery" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('surgery'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="accident" class="mb-2">Accident</label>
                                                <input type="text" class="form-control" id="accident" name="accident" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('accident'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="other" class="mb-2">Others</label>
                                                <input type="text" class="form-control" id="other" name="other" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('other'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="family_medical_history" class="mb-2">Family Medical History</label>
                                                <input type="text" class="form-control" id="family_medical_history" name="family_medical_history" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('family_medical_history'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="current_medication" class="mb-2">Current Medication</label>
                                                <input type="text" class="form-control" id="current_medication" name="current_medication" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('current_medication'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="female_pregnancy" class="mb-2">Female Pregnancy</label>
                                                <input type="text" class="form-control" id="female_pregnancy" name="female_pregnancy" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('female_pregnancy'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="breast_feeding" class="mb-2">Breast Feeding</label>
                                                <input type="text" class="form-control" id="breast_feeding" name="breast_feeding" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('breast_feeding'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="health_insurance" class="mb-2">Health Insurance</label>
                                                <input type="text" class="form-control" id="health_insurance" name="health_insurance" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('high_blood_pressure'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="low_income" class="mb-2">Low Income</label>
                                                <input type="text" class="form-control" id="low_income" name="low_income" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('low_income'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="reference" class="mb-2">Reference</label>
                                                <input type="text" class="form-control" id="reference" name="reference" value=""
                                                >
                                            </div>
                                            <span class="text-danger">@error('reference'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')

<script>
    // function formatState (state) {
    //     if (!state.id) {
    //         return state.text;
    //     }
    //
    //     var $state = $(
    //         '<span><img class="img-flag" /> <span></span></span>'
    //     );
    //
    //     // Use .text() instead of HTML string concatenation to avoid script injection issues
    //     $state.find("span").text(state.text);
    //     $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");
    //
    //     return $state;
    // }

    $('#checkAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });

    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }



</script>
@endpush

