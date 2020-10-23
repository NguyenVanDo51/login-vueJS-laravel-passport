@extends('layouts.template')

@section('title', 'View all role')

@section('content')
    <h3>Quản lý roles</h3>
    @if(!empty($roles))
        <div>
            <form action="{{ route('roles.create') }}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="role" id="role" placeholder="Name" class="form-control"
                               value="{{ old('role') }}">
                        @error('role')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-info">Tạo role mới</button>
                </div>
            </form>
        </div>
        <div class="my-3">
            <table class="table stripe hover my-3" id="mytable">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên role</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Quyền truy cập</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="rowRole">
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            @foreach($role->permissions()->pluck('name') as $permission)
                                <span>"{{$permission}}"</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('roles.destroy', $role->id) }}">Xóa</a>
                            <a href="{{ route('roles.edit', $role->id) }}">Chỉnh sửa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="my-2">
            <a class="btn btn-info" href="{{ route('users.index') }}">Quay lại</a>
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


