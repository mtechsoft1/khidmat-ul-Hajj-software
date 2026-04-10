<div class="row gx-10 mb-5">
    <div class="col-lg-4">

        {{ Form::label('name', __('messages.product.name') . ':', ['class' => 'form-label required mb-3']) }}

        <div class="input-group mb-5">
            {{ Form::text('name', null, ['class' => 'form-control ', 'placeholder' => __('messages.product.name'), 'required', 'onkeypress' => 'return blockSpecialChar(event)']) }}
        </div>

    </div>
        <div class="col-lg-4">
        <div class="mb-5">
            {{ Form::label('category', __('messages.product.category') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::select('category_id', $categories, null, ['id' => 'categoryId', 'class' => 'form-select io-select2 ', 'placeholder' => __('messages.product.category'), 'required', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-5">
            {{ Form::label('unit_price', __('messages.product.unit_price') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::number('unit_price', null, ['id' => 'unitPriceId', 'class' => 'form-control ', 'placeholder' => __('messages.product.unit_price'), 'min' => '0', 'step' => '.01', 'oninput' => "validity.valid||(value=value.replace(/\D+/g, '.'))", 'required']) }}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-5">
            {{ Form::label('description', __('messages.product.description') . ':', ['class' => 'form-label mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control ', 'placeholder' => __('messages.product.description'), 'rows' => '5']) }}
        </div>
    </div>
    <div id="hotelRoomProductFields" class="row d-none">
        <div class="col-12"><h5>Hotel Room Product Details</h5></div>
        <div class="col-lg-4">
            <div class="mb-5">
                {{ Form::label('room_type', 'Room Type:', ['class' => 'form-label mb-3']) }}
                {{ Form::text('room_type', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-5">
                {{ Form::label('default_no_of_pax', 'Default No. of Pax:', ['class' => 'form-label mb-3']) }}
                {{ Form::number('default_no_of_pax', null, ['class' => 'form-control', 'min' => 0]) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-5">
                {{ Form::label('meal_plan', 'Meal Plan:', ['class' => 'form-label mb-3']) }}
                {{ Form::text('meal_plan', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-5">
                {{ Form::label('special_remarks', 'Special Remarks:', ['class' => 'form-label mb-3']) }}
                {{ Form::text('special_remarks', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-4 mb-7">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{ __('messages.product.image') . ':' }}</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="previewImage"
                        {{ $styleCss }}="background-image: url('{{ !empty($product->product_image) ? $product->product_image : asset('images/default-product.jpg') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                        title="Change image">
                        <label>
                            <i class="fa-solid fa-pen" id="productImage"></i>
                            <input type="file" id="productImage" name="image" class="image-upload d-none"
                                accept="image/*" />
                            <input type="hidden" name="image_remove">
                        </label>
                    </span>
                </div>
            </div>
            <div class="form-text">{{ __('messages.flash.allowed_file_types_png_jpg_jpeg') }}</div>
        </div>
    </div> --}}
</div>
<div class="float-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
    <a href="{{ route('products.index') }}" type="reset"
        class="btn btn-secondary btn-active-light-primary">{{ __('messages.common.discard') }}</a>
</div>
