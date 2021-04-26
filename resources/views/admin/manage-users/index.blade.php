@extends('admin-layouts.main-ui')

@section('content')
    <div class="col-12">
        <h1>Member List</h1>
        <div class="separator mb-5"></div>
    </div>

    {{-- datatable --}}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('admin.users.show', $user->id) }}">Show</a>
                        {{-- <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a> --}}
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr> 
        @endforeach
    </table>


    {{-- {!! $data->render() !!} --}}

@endsection
