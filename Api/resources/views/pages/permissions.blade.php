@extends('layouts.template')

@section('title', 'View all role')

@section('content')
    <h3>Quản lý quyền truy cập</h3>
    @if(!empty($permissions))
        <div class="my-4">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-4">
                        <input type="text" name="permission" id="permission" placeholder="Name" class="form-control"
                               value="{{ old('permission') }}">
                    </div>
                    <button class="btn btn-info">Create new permission</button>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        @error('permission')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <table class="table stripe hover my-3" id="mytable">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Guard</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>{{ $permission->created_at }}</td>
                    <td><a href="{{ route('permissions.destroy', $permission->id) }}">Xóa</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-2">
            <a href="{{ route('users.index') }}" class="btn btn-info">Quay lại</a>
        </div>
        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
        @endpush

        <script type="text/javascript">
            $('#mytable').dataTable({
                select: true,
                language: {
                    "decimal":        "",
                    "emptyTable":     "Không có dữ liệu để hiển thị",
                    "info":           "Đang hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "infoEmpty":      "",
                    "infoFiltered":   "(filtered from _MAX_ total entries)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Hiển thị _MENU_ mục",
                    "loadingRecords": "Đang tải...",
                    "processing":     "Đang xử lý...",
                    "search":         "Tìm kiếm: ",
                    "zeroRecords":    "Không tìm thấy mục nào",
                    "paginate": {
                        "first":      "Đầu tiên",
                        "last":       "Cuối cùng",
                        "next":       "Tiếp theo",
                        "previous":   "Lùi trang"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            });
        </script>
    @endif
@endsection
