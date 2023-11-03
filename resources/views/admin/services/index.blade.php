@extends('layouts.master')

@section('title')

Services

@endsection


@section('Services')

active

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <button type="button" class="btn btn-blue float-right" data-toggle="modal" data-target="#servicesModal">Add Services</button>
                <h4 class="card-title"> Services </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class=" text-primary">

                            <th>
                                Id
                            </th>

                            <th>
                                Services Name
                            </th>
                            <th>
                                Services Description
                            </th>
                            
                            <th>
                               Edit
                            </th>

                            <th>
                                Delete
                             </th>
                            
                        </thead>

                        @foreach($services_data as $services)
                    
                        <tbody>
                            
                            <tr>

                                <td>
                                    {{$services->id}}
                                </td>

                                <td>
                                    {{$services->services_name}}
                                </td>

                                <td>
                                  {{$services->services_description}}
                                </td>


                                <td>
                                    <button type="button" class="btn btn-success services_edit" data-target="#serviceseditModal" data-user-id="{{$services->id}}"  data-route-url="{{route('admin.services.edit', $services->id)}}"> EDIT </button>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger aboutusdeletebtn" data-target="#servicesdeletemodal" data-user-id=""> DELETE </button>
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



{{-- add category form --}}

<div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Services</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">


            <div class="form-group">
              <label for="title" class="col-form-label">Services Category Name</label>
              <input type="text" class="form-control" id="services_name" name="services_name">
            </div>

            <div class="form-group">
              <label for="description" class="col-form-label">Services Description</label>
              <textarea class="form-control" id="services_description" name="services_description"></textarea>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary services" data-url={{route('admin.services.create')}}>Save</button>
        </div>

      </div>
    </div>
</div>

{{-- edit service model --}}
<div class="modal fade" id="serviceseditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Services</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">

            <input type="hidden" id="servicesupdate_id">


            <div class="form-group">
              <label for="title" class="col-form-label">Services Category Name</label>
              <input type="text" class="form-control" id="services_name1" name="services_name">
            </div>

            <div class="form-group">
              <label for="description" class="col-form-label">Services Description</label>
              <textarea class="form-control" id="services_description1" name="services_description"></textarea>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary update_services" data-url={{}}>Update</button>
        </div>

      </div>
    </div>
</div>
@endsection