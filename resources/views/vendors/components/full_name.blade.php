<div class="d-flex align-items-center">
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-2">
        <a href="{{route('vendors.show', $row->id)}}">
            <div class="image image-circle image-mini me-2">
                <img src="{{ $row->user->profile_image ?? asset('assets/images/avatar.png') }}" alt="" class="user-img" width="50px" height="50px">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{route('vendors.show', $row->id)}}" class="mb-1 text-decoration-none">{{ $row->user->full_name ?? __('messages.common.n/a') }}</a>
        <span>{{ $row->user->email ?? __('messages.common.n/a') }}</span>
    </div>
</div>
