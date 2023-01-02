@extends('main')
 
@section('konten')

<section class="m-5">
    <h1>Kelompok</h1>
    <label for="title" class="form-label">Title</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="title">
    </div>
    <label for="description" class="form-label">Description</label>
    <div class="input-group mb-3">
        <textarea name="description" id="description" cols="30" class="form-control" rows="10"></textarea>
    </div>
    <label class="form-label">Paritra</label>

    <div class="input-group mb-3" id="myList">
        <div class="input-group">
            <button type="button" class="btn btn-danger" onclick="hapusList(event)">hapus</button>
            <select class="form-select paritra">
              <option selected></option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
        </div>
    </div>
    
    <div class="input-group mb-3">
        <button type="button" class="btn btn-primary" onclick="tambahList(event)">tambah</button>
    </div>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-success" onclick="simpan(event)">simpan</button>
    </div>

</section>

@endsection