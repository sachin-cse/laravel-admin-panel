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

            {{-- <div class="card-header">
                <button type="button" class="btn btn-blue float-right" data-toggle="modal" data-target="#bannerModal">Add Banner</button>
                <h4 class="card-title"> Banner </h4>
            </div> --}}
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
@endsection