@extends('main')
 
@section('content')

<section class="m-5">
    <h1>Group</h1>
    <a class="btn btn-warning my-3 btn-lg" href="editGroup">Edit Book</a>
    
    <label for="title" class="form-label d-block">Title</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="title">
    </div>
    <label for="description" class="form-label">Description</label>
    <div class="input-group mb-3">
        <textarea name="description" id="description" cols="30" class="form-control" rows="10"></textarea>
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

</section>

<script src="{!! asset('js/group.js') !!}"></script>
@endsection