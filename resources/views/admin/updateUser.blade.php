@extends('mainLayout')

@section('title', 'Edit User Role')

@section('page-content')
<div class="container">
    <div class="header bg-primary text-white mx-auto" style="border-radius:10px 10px 0px 0px; padding: 5px;">
        <h1>Edit User Role</h1>
    </div>
    <div class="form">
        <form action="{{ route('update', $user->id) }}" method="POST">
        @csrf
            <div>
                <table class="table table-hover">
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-Mail</th>
                        <th>Role</th>

                    </tr>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->userInfo->user_firstname}}</td>
                        <td>{{ $user->userInfo->user_lastname}}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        <select name="role_id" class="form-control form-control-sm border border-dark">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->contains($role->id)}}>
                                    {{  $role->name }}
                                </option>
                            @endforeach
                        </select>
                            @error('role_id')
                                <span>{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                </table>                
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('usertool') }}" style="padding: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z"/>
                    </svg>
                </a>
                <button type="submit" class="btn btn-danger  ">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection