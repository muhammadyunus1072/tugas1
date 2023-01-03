@extends('main')
 
@section('content')

<section class="m-5">

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_create">Add Book</button>
    <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
</section>
 
<!-- Modal -->
<div class="modal fade" id="modal_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Title</span>
                <input type="text" class="form-control" id="title" aria-describedby="basic-addon3">
            </div>
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" aria-label="description" id="description"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btnSave">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Title</span>
                <input type="text" class="form-control" id="title_edit" aria-describedby="basic-addon3">
            </div>
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" id="description_edit"></textarea>
            </div>
        </div>
        <input type="hidden" value="" id="book_id">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btnEdit">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{!! asset('js/book.js') !!}"></script>
@endsection