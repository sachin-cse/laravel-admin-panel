@extends('layouts.master')

@section('title')

Testimonial

@endsection


@section('Testimonial')

active

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-blue float-right" data-toggle="modal" data-target="#exampleModal">Add Testimonial</button>
                <h4 class="card-title"> Testimonial Table </h4>
            </div>

            <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="{{route('admin.testimonial.bulkDelete')}}">Delete All</button>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class=" text-primary">

                            <th><input type="checkbox" id="check_all"></th>


                            <th>
                                Id
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Image
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Rating
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

                        @foreach($testimonial as $value)
                        <tbody>
                            
                            <tr>

                                <td><input type="checkbox" class="checkbox" data-id="{{$value->id}}"></td>

                                <td>
                                    {{$cn++}}
                                </td>

                                <td>
                                    {{$value->name}}
                                </td>

                                <td>
                                    <img src="{{asset('upload/' . $value->image)}}" width="50" height="50" alt="">
                                </td>

                                <td>
                                   {{strip_tags($value->description)}}
                                </td>

                                <td>
                                    {{$value->rating}}
                                 </td>

                                <td>
                                    <button type="button" class="btn btn-success testimonial_editbtn" data-target="#testimonialeditmodal" data-user-id="{{ $value->id }}"  data-route-url="{{ route('admin.testimonial.edit', $value->id) }}"> EDIT </button>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger testimonialdeletebtn" data-target="#testimonialdeletemodal" data-user-id="{{ $value->id }}"> DELETE </button>
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

{{-- add testimonial model --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

                        
                <form action="#"  enctype="multipart/form-data" id="testimonial" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="testimonial_title" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="testimonial_title" class="col-form-label">Upload photo</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        @error('file')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <br>

                        <div class="form-group">
                            <label for="testimonial_title" class="col-form-label">Rating</label>
                            <i class="star fa fa-star" for="1"></i>
                            <i class="star fa fa-star" for="2"></i>
                            <i class="star fa fa-star" for="3"></i>
                            <i class="star fa fa-star" for="4"></i>
                            <i class="star fa fa-star" for="5"></i>
                            <input type="hidden" name="rating" id="rating">
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>

                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                    
            </div>
            
        </div>

      </div>
    </div>
</div>

{{-- edit testimonial model --}}
<div class="modal fade" id="testimonialeditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Testimonial </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form action="#" id="updatetestimonial" enctype="multipart/form-data">
                <div class="modal-body"> 
                  
                        <div class="modal-body">

                            <input type="hidden" id="testimonialupdate_id">
    
                            <div class="form-group">
                                <label for="testimonial_title" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name1" name="name" value="">
                            </div>
    
                            <div class="form-group">
                                <label for="testimonial_title" class="col-form-label">Upload photo</label>
                                <input type="file" class="form-control" id="file1" name="file" value="">
                            </div>
    
                            <br>

                            <div class="form-group" style="padding-top:10%;" id="imageView">
                                <p>Current Image</p>
                            </div>

                            <br>
    
                            <div class="form-group" id="ratingstar1">
                                <input type="hidden" name="rating" id="rating1">
                            </div>

                            <div class="form-group">
                                <label for="testimonial_title" class="col-form-label">Update Rating</label>
                                <i class="star fa fa-star" for="1"></i>
                                <i class="star fa fa-star" for="2"></i>
                                <i class="star fa fa-star" for="3"></i>
                                <i class="star fa fa-star" for="4"></i>
                                <i class="star fa fa-star" for="5"></i>
                                <input type="hidden" name="rating_update" id="rating2" value="">
                            </div>
    
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description1" name="description"></textarea>
                            </div>
                            
                        </div>
    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary updateTestimonial">Update</button>
                        </div>    
                </div>
            </form>
                
            </div>

            </div>
        </div>
</div>

{{-- delete --}}
<div class="modal fade" id="testimonialdeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <input type="hidden" id="testimonial_delete_id">
                        Are you sure you want to  delete this user?
                    </div>
               
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deletedata" class="btn btn-primary testimonialdelete">Delete</button>
                    </div>

            </div>
        </div>
</div>

@endsection