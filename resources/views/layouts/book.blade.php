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

@endsection

@section('js')
    <script>
      $(document).ready(function () {
      let btnSave = $(".btnSave");
      let btnEdit = $(".btnEdit");
      let table = $("#table").DataTable({
          ajax: {
              url: "{{ route('book.datatable') }}",
              type: "GET",
          },
          serverSide: true,
          processing: true,
          paging: false,
          searching: false,
          columns: [
              { data: "id" },
              { data: "title" },
              { data: "description" },
              { data: "action" },
          ],
          columnDefs: [
              {
                  searchable: false,
                  orderable: false,
                  targets: 0,
              },
          ],
      });
      table
          .on("order.dt search.dt", function () {
              let i = 1;

              table
                  .cells(null, 0, { search: "applied", order: "applied" })
                  .every(function (cell) {
                      this.data(i++);
                  });
          })
          .draw();

      btnEdit.click((e) => {
          let data = {
              id: $("#book_id").val(),
              title: $("#title_edit").val(),
              description: $("#description_edit").val(),
          };

          $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          });

          $.ajax({
              type: "POST",
              url: "{{ route('book.update') }}",
              data: data,
              success: (data) => {
                  table.draw();
                  $("#modal_edit").modal("hide");
              },
          });
      });

      btnSave.click((e) => {
          e.preventDefault();
          let data = {
              title: $("#title").val(),
              description: $("#description").val(),
          };

          $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          });

          $.ajax({
              type: "POST",
              url: "{{ route('book.store') }}",
              data: data,
              success: (data) => {
                  table.draw();
                  $("#modal_create").modal("hide");
              },
          });
      });
      $(document).on("click", ".btnShowModalEdit", (event) => {
          event.preventDefault();

          $("#modal_edit").modal("show");
          $("#title_edit").val($(event.target).attr("data-title"));
          $("#description_edit").val($(event.target).attr("data-description"));
          $("#book_id").val($(event.target).attr("data-id"));
      });
      $(document).on("click", ".btnDelete", (event) => {
          event.preventDefault();
          let data = {
              id: $(event.target).attr("data-id"),
          };
          $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          });

          $.ajax({
              type: "POST",
              url: "{{ route('book.destroy') }}",
              data: data,
              success: (data) => {
                  table.draw();
              },
          });
      });
  });
  
  function coba() {
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      $.post(
          "coba",
          {
              name: "yunus",
              age: "21",
          },
          (data) => {
              console.log(data);
          }
      );
  }
  coba();

    </script>
@endsection