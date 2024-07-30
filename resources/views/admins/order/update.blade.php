@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">
        Order</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Order</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <form action="{{ route('order.update', $orders->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $orders->status == '1' ? 'selected' : '' }} selected >Đã xác nhận</option>
                        <option value="0" {{ $orders->status == '0' ? 'selected' : '' }}>Chưa xác nhận</option>
                        <option value="2" {{ $orders->status == '2' ? 'selected' : '' }}>Đã thanh toán</option>
                        <option value="3" {{ $orders->status == '3' ? 'selected' : '' }}>Hủy</option>
                    </select>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
