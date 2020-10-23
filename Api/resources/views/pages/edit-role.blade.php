@extends('layouts.template')

@section('title', 'View all role')

@section('content')
    <h3>Edit role</h3>
    @if(!empty($role))
        <form action="{{ route('roles.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" name="id" id="id" class="form-control" readonly value="{{ $role->id }}">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
            </div>
{{--            {{ dd($permissions) }}--}}
            <div class="form-group">
                <label>Permissions</label>
                <div class="input-group">
                    <select class="custom-select" multiple id="inputGroupSelect04" name="permissions[]">
                        @foreach($permissions as $permission)
                            <option
                                @if(in_array($permission, $rolePermissions->toArray()))
                                    selected
                                @endif
                                value="{{ $permission }}">{{ $permission }}
                            </option>
                        @endforeach
                    </select>
                    <div class="col-1">
                        <button class="btn btn-primary" type="submit">Button</button>
                    </div>
                </div>
            </div>
        </form>
        <a href="{{ route('roles.index') }}">Back</a>
    @endif
@endsection
<script>
    import Input from "../../js/Jetstream/Input";
    export default {
        components: {Input}
    }
</script>
