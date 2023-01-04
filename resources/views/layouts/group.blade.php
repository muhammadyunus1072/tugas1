@extends('main')
 
@section('content')

<section class="m-5">
    <h1>Group</h1>
    <a class="btn btn-warning my-3 btn-lg" href="{{ route('group.index') }}">Edit Book</a>
    
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

@endsection


@section('js')
    <script>
        let book = "";
        let content = "";
        function getBook() {
            $.get("{{ route('book.get') }}", (data) => {
                // console.log(data)
                content += `<div class="input-group mt-3">
                    <button type="button" class="btn btn-danger" onclick="deleteList(event)">delete</button>
                    <select class="form-select paritra">`;
                book = JSON.parse(data);
                for (var a = 0; a < book.length; a++) {
                    content += `<option value="${book[a].id}">${book[a].title}</option>`;
                }
                content += `</select>
                    </div>`;
                $("#myList").empty();
                $("#myList").html(content);
            });
        }
        getBook();

        function addList(e) {
            $("#myList").append(content);
        }

        function deleteList(e) {
            $(e.target).parent().remove();
        }

        function save(e) {
            let list = $(".paritra");
            let idBook = [];
            for (var a = 0; a < list.length; a++) {
                idBook.push(list.eq(a).val());
            }
            let data = {
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
                url: "{{ route('group.store') }}",
                data: data,
                success: (data) => {
                    alert(data);
                },
            });
        }

    </script>
@endsection