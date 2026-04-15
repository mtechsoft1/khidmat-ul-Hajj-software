<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('messages.vendor.vendor_information') }}</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>{{ __('messages.vendor.first_name') }}:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $vendor->user->first_name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>{{ __('messages.vendor.last_name') }}:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $vendor->user->last_name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>{{ __('messages.vendor.email') }}:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $vendor->user->email }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>{{ __('messages.vendor.contact_no') }}:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $vendor->user->contact ? $vendor->user->region_code . ' ' . $vendor->user->contact : 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>{{ __('messages.vendor.country') }}:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $vendor->country->name ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('messages.common.actions') }}</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary">
                        {{ __('messages.common.edit') }}
                    </a>
                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('{{ __('messages.common.are_you_sure') }}')">
                            {{ __('messages.common.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
