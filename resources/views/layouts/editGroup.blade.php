@extends('main')
 
@section('content')

<section class="m-5">
    <a class="btn btn-success" href="{{ route('group.add.index') }}">Add Group</a>
    <div class="table-responsive">
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
    </div>

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
@endsection

@section('js')
  <script>
    let content = "";
    let table = ""
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        table = $("#table").DataTable({
            ajax: {
                url: "{{ route('group.datatable') }}",
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
                { 
                  data: null,
                  searchable:false,
                  orderable:false,
                  render:(item) => {
                    let action = ` <button type="button" class="btn btn-warning btnShowModalEdit" data-id="${item.id}">edit</button>`
                    return action;
                  }
                },
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

        let book = "";
        $.ajax({
          url: "{{ route('book.get') }}",
          type: "get",
            success: (data) => {
                book = JSON.parse(data);
                content += `<div class="input-group mt-3">
                <button type="button" class="btn btn-danger" onclick="deleteList(event)">delete</button>
                <select class="form-select paritra">`;
                book = JSON.parse(data);
                for (var a = 0; a < book.length; a++) {
                    content += `<option value="${book[a].id}">${book[a].title}</option>`;
                }
                content += `</select>
                </div>`;
                // console.log(book[0])
            },
        });

        $(document).on("click", ".btnShowModalEdit", (e) => {
            let data = {
                id: $(e.target).attr("data-id"),
            };
            let content = "";
            $("#group_id").val($(e.target).attr("data-id"));
            // console.log(data)
            $.post("{{ route('group.get') }}", data, (d) => {
                let data = JSON.parse(d);
                // console.log(book[0].title)
                // console.log(data)
                $("#modal_edit").modal("show");
                $("#title").val(data.group[0].title);
                $("#description").val(data.group[0].description);

                for (var a = 0; a < data.book.length; a++) {
                    content += `<div class="input-group mt-3">
                    <button type="button" class="btn btn-danger" onclick="deleteList(event)">delete</button>
                    <select class="form-select paritra">`;
                    // book = JSON.parse(data);
                    for (var b = 0; b < book.length; b++) {
                        if (data.book[a].id == book[b].id) {
                            content += `<option value="${book[b].id}" selected>${book[b].title}</option>`;
                        } else {
                            content += `<option value="${book[b].id}">${book[b].title}</option>`;
                        }
                        // console.log(book[b].title)
                        // console.log(data.book[a].title)
                    }
                    content += `</select>
                    </div>`;
                }
                $("#myList").empty();
                $("#myList").html(content);
            });
        });
    });
    function deleteList(e) {
    $(e.target).parent().remove();
}
    function addList(e) {
        $("#myList").append(content);
    }
    function save(e) {
        let list = $(".paritra");
        let idBook = [];
        for (var a = 0; a < list.length; a++) {
            idBook.push(list.eq(a).val());
        }
        let data = {
            id: $("#group_id").val(),
            title: $("#title").val(),
            description: $("#description").val(),
            paritra: idBook,
        };
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "{{ route('group.update') }}",
            data: data,
            success: (data) => {
              table.draw();
              $("#modal_edit").modal('hide')
                console.log(data);
            },
        });
    }

  </script>
    
@endsection