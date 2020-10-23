@extends('layouts.template')

@section('title', 'View all role')

@push('scripts')

    <style>
        .first-letter:first-letter {
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    <h3>Cấp quyền cho user: {{ $user->name }}</h3>
    @if(!empty($user))
        <p> ID: {{ $user->id }} </p>
        <p> Tên: {{ $user->name }} </p>
        <p> Email: {{ $user->email }} </p>
        <p> Vai trò:
            @if(!empty($permissions))
                @foreach($permissions as $permission)
                    <span>"{{ $permission }}"</span>
                @endforeach
            @endif
        </p>

        <form action="{{ route('users.permissions.edit', $user->id) }}" method="post">
            @csrf

            @foreach($data as $key => $value)
                <div class="row">
                    <div class="col-12">
                        @if (count($value) > 0)
                        <h3 class="first-letter">{{ $key }}</h3>
                        @endif
                        <input type="hidden" name="user" value="{{ $user->id }}">
                    </div>
                </div>
                <div class="row">
                    @foreach($value as $item)
                        <div class="col-3 col-md-2 mb-4">
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" name="{{ $item }}"
                                       @if(in_array($item, $permissions->toArray())) checked
                                       @endif aria-label="Checkbox for following text input">
                                <label class="form-check-label">{{ $item }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="btn btn-info mr-3">Cập nhật</button>
            <a href="{{ route('users.index') }}">Hủy</a>

        </form>
    @endif
@endsection
