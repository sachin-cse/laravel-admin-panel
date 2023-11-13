@extends('layouts.master')
@section('title')

Communication

@endsection


@section('Communication')

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

              
    <form action="#"  enctype="multipart/form-data" id="sendEmail" method="post">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="banner_title" class="col-form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>

            <div class="form-group">
              <label for="banner_title" class="col-form-label">Recipient Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>

            {{-- <div class="form-group">
                <label for="banner_title" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div> --}}

            <div class="form-group">
                <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send Email</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
@endsection