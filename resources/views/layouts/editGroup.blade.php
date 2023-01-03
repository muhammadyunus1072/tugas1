@extends('main')
 
@section('content')

<section class="m-5">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_edit">Edit</button>
    
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
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="group_id">
            <label for="title" class="form-label d-block">Title</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="title">
            </div>
            <label for="description" class="form-label">Description</label>
            <div class="input-group mb-3">
                <textarea name="description" id="description" cols="30" class="form-control" rows="5"></textarea>
            </div>
            <label class="form-label">Paritra</label>
        
            <div class="input-group mb-3" id="myList">
                
            </div>
            
            <div class="input-group mb-3">
                <button type="button" class="btn btn-primary" onclick="addList(event)">Add</button>
            </div>
            <div class="input-group mb-3">
                <button type="button" class="btn btn-success" onclick="save(event)">Save</button>
            </div>
        </div>
      </div>
    </div>
  </div>

<script src="{!! asset('js/EditGroup.js') !!}"></script>
@endsection