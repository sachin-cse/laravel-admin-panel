@extends('layouts.master')

@section('title')

Banner

@endsection


@section('Banner')

active

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <button type="button" class="btn btn-blue float-right" data-toggle="modal" data-target="#bannerModal">Add Banner</button>
                <h4 class="card-title"> Banner </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class="text-primary">

                            <th>
                                Id
                            </th>

                            <th>
                                Banner Name
                            </th>
                            <th>
                                Banner Image
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

                        @foreach($services_banner as $services)
                        <tbody>
                            
                            <tr>

                                <td>
                                    {{$cn++}}
                                </td>

                                <td>
                                    {{$services->banner_name}}
                                </td>

                                <td>
                                  
                                  <img src="{{asset('upload/' . $services->banner_image)}}" width="50" height="50" alt="">
                                </td>


                                <td>
                                    <button type="button" class="btn btn-success editBanner" data-target="#bannerEditModal" data-user-id="{{$services->id}}"  data-route-url="{{route('admin.edit.banner', $services->id)}}"> EDIT </button>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger deleteBanner" data-target="#bannerDeletemodal" data-user-id="{{$services->id}}"> DELETE </button>
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
<div class="modal" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="#" method="post" id="addbannerimage" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">


            <div class="form-group">
              <label for="banner_name" class="col-form-label">Banner Image Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="banner_name" name="banner_name">
              @error('banner_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
              <label for="banner_image" class="col-form-label">Banner Image<span class="text-danger">*</span></label>
              <input type="file" class="form-control" id="banner_image" name="banner_image">
              
              @error('banner_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

      </div>
    </div>
</div>

{{-- edit service model --}}
<div class="modal fade" id="bannerEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

    <form action="#" method="post" enctype="multipart/form-data" id="updatebannerimage">
        <div class="modal-body">

            <input type="hidden" id="bannerupdate_id">


            <div class="form-group">
              <label for="banner_title" class="col-form-label">Banner Name</label>
              <input type="text" class="form-control" id="banner_name1" name="banner_name">
            </div>

            <div class="form-group">
              <label for="banner_image" class="col-form-label">Update Banner Image</label>
              <input type="file" class="form-control" id="banner_image1" name="banner_image">
            </div>

            <!-- Display the image preview -->
            <div class="form-group" style="padding-top:10%;">
            <label for="previous_banner_image" class="col-form-label">Current Banner Image</label>
            <img id="bannerImagePreview" src="" alt="Banner Image Preview" style="width: 100px; height: 100px; display:block;">
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary update_services">Update</button>
        </div>
    </form>

      </div>
    </div>
</div>

{{-- delete model --}}
<div class="modal fade" id="bannerDeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <input type="hidden" id="servicesbanner_delete_id">
                        Are you sure you want to  delete this service?
                    </div>
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deletedata" class="btn btn-primary servicesBannerdelete">Delete</button>
                    </div>

            </div>
        </div>
</div>
@endsection