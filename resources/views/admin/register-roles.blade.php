@extends('layouts.master')

@section('title')

Register Roles

@endsection


@section('Register Roles')

active

@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Register Roles</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>
                                Name
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Email
                            </th>

                            <th>
                                Usertype
                            </th>

                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                            <tr>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ $row->phone }}
                                </td>
                                <td>
                                    {{ $row->email }}
                                </td>
                                <td>
                                    {{ $row->usertype }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn" data-target="#editmodal" data-user-id="{{ $row->id }}"  data-route-url="{{ route('fetch.data', $row->id) }}"> EDIT </button>

                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger deletebtn" data-target="#deletemodal" data-user-id="{{ $row->id }}"> DELETE </button>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header">
                <h4 class="card-title"> Table on Plain Background</h4>
                <p class="category"> Here is a subtitle for this table</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>
                                Name
                            </th>
                            <th>
                                Country
                            </th>
                            <th>
                                City
                            </th>
                            <th class="text-right">
                                Salary
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Dakota Rice
                                </td>
                                <td>
                                    Niger
                                </td>
                                <td>
                                    Oud-Turnhout
                                </td>
                                <td class="text-right">
                                    $36,738
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Minerva Hooper
                                </td>
                                <td>
                                    Curaçao
                                </td>
                                <td>
                                    Sinaai-Waas
                                </td>
                                <td class="text-right">
                                    $23,789
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sage Rodriguez
                                </td>
                                <td>
                                    Netherlands
                                </td>
                                <td>
                                    Baileux
                                </td>
                                <td class="text-right">
                                    $56,142
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Philip Chaney
                                </td>
                                <td>
                                    Korea, South
                                </td>
                                <td>
                                    Overland Park
                                </td>
                                <td class="text-right">
                                    $38,735
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Doris Greene
                                </td>
                                <td>
                                    Malawi
                                </td>
                                <td>
                                    Feldkirchen in Kärnten
                                </td>
                                <td class="text-right">
                                    $63,542
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mason Porter
                                </td>
                                <td>
                                    Chile
                                </td>
                                <td>
                                    Gloucester
                                </td>
                                <td class="text-right">
                                    $78,615
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jon Porter
                                </td>
                                <td>
                                    Portugal
                                </td>
                                <td>
                                    Gloucester
                                </td>
                                <td class="text-right">
                                    $98,615
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>

{{-- edit modal pop up --}}
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Users Role </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                    @csrf
                <div class="modal-body">

                        <input type="hidden" id="update_id">

                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" name="email" id="email" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label> Phone </label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                    
                    <div class="form-group">
                    <label>User Role</label>
                    <select name="usertype" id="usertype" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <!-- Add more options as needed -->
                    </select>
                    </div>
                </div>
           

                   
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary updatebtn">Update Data</button>
                    </div>

            </div>
        </div>
</div>

{{-- delete pop up --}}
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete User </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <div class="modal-body">

                        <input type="hidden" id="delete_id">
                        Are you sure you want to  delete this user?
                    </div>
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deletedata" class="btn btn-primary deleteuser">Delete</button>
                    </div>

            </div>
        </div>
</div>


@endsection


{{-- @section('script')

@endsection --}}