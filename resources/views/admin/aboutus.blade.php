@extends('layouts.master')

@section('title')

Aboutus

@endsection


@section('Aboutus')

active

@endsection





@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-blue float-right" data-toggle="modal" data-target="#exampleModal">Add</button>
                <h4 class="card-title"> Aboutus Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class=" text-primary">

                            <th>
                                Id
                            </th>

                            <th>
                                Title
                            </th>
                            <th>
                                Subtitle
                            </th>
                            <th>
                                Description
                            </th>

                            <th>
                               Edit
                            </th>

                            <th>
                                Delete
                             </th>
                            
                        </thead>

                        @php
                        $cn = 1;
                        @endphp

                        @foreach($data as $value)
                        <tbody>
                            
                            <tr>

                                <td>
                                    {{$cn++}}
                                </td>

                                <td>
                                    {{$value->title}}
                                </td>

                                <td>
                                    {{$value->subtitle}}
                                </td>

                                <td>
                                   {{$value->description}}
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success abouts_editbtn" data-target="#aboutuseditmodal" data-user-id="{{ $value->id }}"  data-route-url="{{ route('about.data', $value->id) }}"> EDIT </button>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger aboutusdeletebtn" data-target="#aboutusdeletemodal" data-user-id="{{ $value->id }}"> DELETE </button>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- aboutus modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Aboutus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">


            <div class="form-group">
              <label for="title" class="col-form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="subtitle" class="col-form-label">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" required>
            </div>

            <div class="form-group">
              <label for="description" class="col-form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary about" data-url={{route('aboutus.store')}}>Save</button>
        </div>

      </div>
    </div>
</div>


{{-- edit modal pop up --}}
<div class="modal fade" id="aboutuseditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Aboutus </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="aboutsupdate_id">

                    <div class="form-group">
                      <label for="title" class="col-form-label">Title</label>
                      <input type="text" class="form-control" id="title1" name="title">
                    </div>
        
                    <div class="form-group">
                        <label for="subtitle" class="col-form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle1" name="subtitle">
                    </div>
        
                    <div class="form-group">
                      <label for="description" class="col-form-label">Description</label>
                      <textarea class="form-control" id="description1" name="description"></textarea>
                    </div>
                    
                </div>
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary aboutsupdatebtn">Update Data</button>
                    </div>

            </div>
        </div>
</div>

{{-- aboutus delete modal --}}
{{-- delete pop up --}}
<div class="modal fade" id="aboutusdeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <input type="hidden" id="aboutus_delete_id">
                        Are you sure you want to  delete this user?
                    </div>
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deletedata" class="btn btn-primary aboutusdelete">Delete</button>
                    </div>

            </div>
        </div>
</div>


@endsection
