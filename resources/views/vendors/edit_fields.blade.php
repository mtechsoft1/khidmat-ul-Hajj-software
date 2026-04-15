<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('first_name', __('messages.vendor.first_name') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::text('first_name', $vendor->user->first_name, ['class' => 'form-control', 'placeholder' => __('messages.vendor.first_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('last_name', __('messages.vendor.last_name') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::text('last_name', $vendor->user->last_name, ['class' => 'form-control', 'placeholder' => __('messages.vendor.last_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('email', __('messages.vendor.email') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::email('email', $vendor->user->email, ['class' => 'form-control', 'placeholder' => __('messages.vendor.email'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('contact', __('messages.vendor.contact_no') . ':', ['class' => 'form-label mb-3']) }}
            {{ Form::tel('contact', $vendor->user->contact, ['class' => 'form-control', 'placeholder' => '51 234 5678', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'phoneNumber', 'data-initial-country' => 'sa']) }}
            {{ Form::hidden('region_code', $vendor->user->region_code, ['id' => 'prefix_code']) }}
            <span id="valid-msg" class="hide text-success fw-400 fs-small mt-2">?
                {{ __('messages.placeholder.valid_number') }}</span>
            <span id="error-msg" class="hide text-danger fw-400 fs-small mt-2"></span>
            
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        var input = document.querySelector('#phoneNumber');
                        if (input && window.intlTelInput) {
                            var iti = window.intlTelInputGlobals.getInstance(input);
                            if (iti) {
                                iti.setCountry('sa');
                            }
                        }
                    }, 1000);
                });
            </script>
            @endpush
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('country', __('messages.vendor.country') . ':', ['class' => 'form-label mb-3']) }}
            {{ Form::select('country_id', $countries, $vendor->country_id, ['id' => 'countryId', 'class' => 'form-select io-select2 ', 'placeholder' => __('messages.vendor.country'), 'data-control' => 'select2']) }}
        </div>
    </div>
</div>
<div class="float-end d-flex mt-5">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
    <a href="{{ route('vendors.index') }}" type="reset"
        class="btn btn-secondary btn-active-light-primary">{{ __('messages.common.discard') }}</a>
</div>
