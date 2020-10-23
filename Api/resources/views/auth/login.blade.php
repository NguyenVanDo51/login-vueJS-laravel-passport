@extends('layouts.template')

@section('title', 'Đăng nhập')

@section('content')
    <div class="w-50 mx-auto mt-5">
        <div class="mb-4 font-medium text-sm text-green-600">
            <h3>Trang đăng nhập</h3>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="mt-4">
                <label for="password">Mật khẩu</label>
                <input class="form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center justify-content-between">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ghi nhớ</span>
                </label>
            </div>

            <div class="flex items-center justify-end my-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

                <button type="submit" class="btn btn-info">
                    Đăng nhập
                </button>
        </form>
    </div>


@endsection

<script>
    import Label from "../../js/Jetstream/Label";
    import Input from "../../js/Jetstream/Input";
    export default {
        components: {Input, Label}
    }
</script>
