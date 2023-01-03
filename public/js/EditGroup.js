let content = "";
let baseURL = "http://localhost:8000";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    let table = $("#table").DataTable({
        ajax: {
            url: new URL("/getGroups", baseURL),
            type: "POST",
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

    let book = "";
    $.ajax({
        type: "get",
        url: new URL("/getBook", baseURL),
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
        $.post("http://localhost:8000/getGroupBook", data, (d) => {
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
        url: new URL("/editGroup", baseURL),
        data: data,
        success: (data) => {
            console.log(data);
        },
    });
}
