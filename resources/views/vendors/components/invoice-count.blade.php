<span class="badge badge-circle bg-success me-2">
    <a href="{{route('vendors.show',$row->id.'?Active=invoices')}}" data-turbo="false"
       class="text-decoration-none text-white">{{ $row->invoices_count ?? 0 }}</a>
</span>
