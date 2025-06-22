@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Coupon</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route(admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Code *</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Type *</label>
            <select name="type" class="form-select" required>
                <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed (JD)</option>
                <option value="percent" {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>Percent (%)</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Value *</label>
            <input type="number" name="value" step="0.01" min="0" class="form-control" value="{{ old('value', $coupon->value) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Minimum Order Amount</label>
            <input type="number" name="min_order_amount" step="0.01" min="0" class="form-control" value="{{ old('min_order_amount', $coupon->min_order_amount) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Valid From *</label>
            <input type="date" name="valid_from" class="form-control" value="{{ old('valid_from', $coupon->valid_from) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Valid To *</label>
            <input type="date" name="valid_to" class="form-control" value="{{ old('valid_to', $coupon->valid_to) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Usage Limit</label>
            <input type="number" name="usage_limit" class="form-control" min="1" value="{{ old('usage_limit', $coupon->usage_limit) }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Coupon</button>
        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
