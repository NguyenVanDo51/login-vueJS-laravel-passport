@extends('layouts.template')

@section('title', 'User manager')

@section('content')

    <h3>Quản lý tài khoản</h3>
    <div class="my-4">
        <a href="{{ route('roles.index') }}" alt="" class="btn btn-info">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-info">Quyền truy cập</a>
    </div>

    @if(!empty($users))
        <table class="table hover row-border stripe my-3" id="mytable">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles()->pluck('name') as $role)
                                <span>"{{ $role }}"</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('users.show', $user->id) }}">Chi tiết</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
