 @extends('layouts.admin')

 @section('content')
     <h1 class="mt-4">
         Order</h1>
     <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Order</li>
     </ol>
   
     <div class="card mb-4">
         <div class="card-header">
             <i class="fa fa-shopping-cart"></i>
             Order
         </div>
         @if (session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
         <div class="card-body">
             <table id="datatablesSimple">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Tên</th>
                         <th>Email</th>
                         <th>Điện thoại</th>
                         <th>Trạng thái</th>
                         <th>Ngày mua</th>
                         <th>Hành động</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Ngày mua</th>
                        <th>Hành động</th>
                     </tr>
                 </tfoot>
                 <tbody>
                     @foreach ($listOrder as $item)
                         <tr>
                             <td>{{ $item->id }}</td>
                             <td>{{ $item->name }}</td>
                             <td>{{ $item->email }}</td>
                             <td>{{ $item->phone }}</td>
                             <td
                                 class="badge rounded-lg rounded-pill py-3 px-4 mb-0 border-0 text-capitalize fs-12">
                                 @if ($item->status == 0)
                                     <span class="badge rounded-lg rounded-pill alert alert-warning">Chưa xác nhận</span>
                                 @elseif ($item->status == 1)
                                     <span class="badge rounded-lg rounded-pill alert alert-success">Đã xác nhận</span>
                                 @elseif ($item->status == 2)
                                     <span class="badge rounded-lg rounded-pill alert alert-success">Đã thanh toán</span>
                                 @else
                                     <span class="badge rounded-lg rounded-pill alert alert-danger">Đã Hủy</span>
                                 @endif
                             </td>
                             <td>{{ $item->created_at->format('d/m/Y') }}</td>
                             <td>
                                 <a href="{{ route('order.show', $item->id) }}" class="btn btn-secondary">Detail</a>
                                 <a href="{{ route('order.edit', $item->id) }}" class="btn btn-warning">Đổi trạng thái</a>
                                 <form action="{{ route('order.destroy', $item->id) }}" class="d-inline" method="POST"
                                    onsubmit="return confirm('Bạn có đồng ý xóa hay không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
             <a href="{{ route('order.trash') }}" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Thùng rác</a>
         </div>
     </div>
 @endsection
