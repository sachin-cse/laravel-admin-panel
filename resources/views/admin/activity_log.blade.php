@extends('layouts.master')

@section('title')

Activity Log

@endsection


@section('ActivityLog')

active

@endsection





@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Activity log table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class=" text-primary">

                            <th>
                                Id
                            </th>

                            <th>
                                Current logged id
                            </th>
                            <th>
                                Ip Address
                            </th>
                            <th>
                                User Type
                            </th>

                            <th>
                               User Name
                            </th>

                            <th>
                                Device Access
                             </th>

                             <th>
                                Download Format
                             </th>
                            
                        </thead>

                        @php
                        $cn = 1;
                        @endphp

                        {{-- @dd($data); --}}
                        <tbody>
                        @foreach($data as $value)
                            
                            <tr>

                                <td>
                                    {{$cn++}}
                                </td>

                                <td>
                                    {{$value->current_logged_id}}
                                </td>

                                <td>
                                    {{$value->ip_address}}
                                </td>

                                <td>
                                    {{$value->user_type}}
                                </td>

                                <td>
                                    {{$value->user_name}}
                                </td>
 
                                <td>
                                    {{$value->device_access}}
                                </td>

                                <td>
                                    <a href="{{route('download.Format', ['format' => 'pdf', 'id' => $value['id']])}}" class="downloadLog" data-url="">PDF</a> | <a href="{{route('download.Format', ['format' => 'excel', 'id' => $value['id']])}}" class="downloadLog" data-url="">Excel</a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
