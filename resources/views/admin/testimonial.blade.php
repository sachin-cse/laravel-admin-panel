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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead class=" text-primary">

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

{{-- testimonial model --}}

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
    <div class="card-body">

              
    <form action="#"  enctype="multipart/form-data" id="testimonial" method="post">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="testimonial_title" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>

            <div class="form-group">
                <label for="testimonial_title" class="col-form-label">Upload photo</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>

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
            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div> --}}

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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                <div class="card-body">

                        
                <form action="#"  enctype="multipart/form-data" id="testimonial" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="testimonial_title" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="testimonial_title" class="col-form-label">Upload photo</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

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

      </div>
    </div>
</div>

@endsection