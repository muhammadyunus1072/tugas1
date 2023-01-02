@extends('main')
 
@section('konten')

<section class="m-5">

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah buku</button>
    <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody id="tbody">
            @foreach($buku as $b)
            <tr>
                <td >{{ $b->title }}</td>
                <td >{{ $b->description }}</td>
                <td>
                    <button type="button" class="btn btn-danger" data-id="{{ $b->id }}" onclick="hapus(event)">hapus</button>
                    <button type="button" class="btn btn-warning" data-id="{{ $b->id }}" data-title="{{ $b->title }}" data-description="{{ $b->description }}" onclick="modalU(event)">ubah</button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</section>
 
<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
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
          <button type="button" class="btn btn-primary" onclick="tambah(event)">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="modalUbah" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Title</span>
                <input type="text" class="form-control" id="titleU" aria-describedby="basic-addon3">
            </div>
            <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" aria-label="descriptionU" id="descriptionU"></textarea>
            </div>
        </div>
        <input type="hidden" name="idBuku" value="" id="idBuku">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ubah(event )">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection