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
                    <table class="table">
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
                        @foreach($data as $value)
                        <tbody>
                            
                            <tr>

                                <td>
                                    {{$value->id}}
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
                                    <a href="#" class="btn btn-success">Edit</a>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
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
              <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="subtitle" class="col-form-label">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle">
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

</div>
@endsection
