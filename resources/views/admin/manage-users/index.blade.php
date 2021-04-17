@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>รายการ ผู้ใช้</h1>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            @if (!str_contains($user->getRoleNames() , 'Admin') && $user->getRoleNames() != "[]")
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td> --}}
                    <td>
                        <a class="btn btn-info" href="{{ route('admin.users.show', $user->id) }}">Show</a>
                        {{-- <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a> --}}
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr> 
            @endif
        @endforeach
    </table>


    {{-- {!! $data->render() !!} --}}

@endsection
