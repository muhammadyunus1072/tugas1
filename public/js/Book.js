// $(document).ready(function () {
//     let btnSave = $(".btnSave");
//     let btnEdit = $(".btnEdit");
//     let baseURL = "http://localhost:8000";
//     let table = $("#table").DataTable({
//         ajax: {
//             url: new URL("/getBooksbaru", baseURL),
//             type: "POST",
//         },
//         serverSide: true,
//         processing: true,
//         paging: false,
//         searching: false,
//         columns: [
//             { data: "id" },
//             { data: "title" },
//             { data: "description" },
//             { data: "action" },
//         ],
//         columnDefs: [
//             {
//                 searchable: false,
//                 orderable: false,
//                 targets: 0,
//             },
//         ],
//     });
//     table
//         .on("order.dt search.dt", function () {
//             let i = 1;

//             table
//                 .cells(null, 0, { search: "applied", order: "applied" })
//                 .every(function (cell) {
//                     this.data(i++);
//                 });
//         })
//         .draw();

//     btnEdit.click((e) => {
//         let data = {
//             id: $("#book_id").val(),
//             title: $("#title_edit").val(),
//             description: $("#description_edit").val(),
//         };

//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });

//         $.ajax({
//             type: "POST",
//             url: new URL("/editBook", baseURL),
//             data: data,
//             success: (data) => {
//                 table.draw();
//                 $("#modal_edit").modal("hide");
//             },
//         });
//     });

//     btnSave.click((e) => {
//         e.preventDefault();
//         let data = {
//             title: $("#title").val(),
//             description: $("#description").val(),
//         };

//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });

//         $.ajax({
//             type: "POST",
//             url: new URL("/addBook", baseURL),
//             data: data,
//             success: (data) => {
//                 table.draw();
//                 $("#modal_create").modal("hide");
//             },
//         });
//     });
//     $(document).on("click", ".btnShowModalEdit", (event) => {
//         event.preventDefault();

//         $("#modal_edit").modal("show");
//         $("#title_edit").val($(event.target).attr("data-title"));
//         $("#description_edit").val($(event.target).attr("data-description"));
//         $("#book_id").val($(event.target).attr("data-id"));
//     });
//     $(document).on("click", ".btnDelete", (event) => {
//         event.preventDefault();
//         let data = {
//             id: $(event.target).attr("data-id"),
//         };
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });

//         $.ajax({
//             type: "POST",
//             url: new URL("/deleteBook", baseURL),
//             data: data,
//             success: (data) => {
//                 table.draw();
//             },
//         });
//     });
// });
// function destroy(event) {
//     let data = {
//         id: $(event.target).attr("data-id"),
//     };
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });

//     $.post("http://localhost:8000/deleteBook", data, (data) => {
//         // console.log(data)
//         renderTable(data);
//     });
// }

// function edit() {
//     let data = {
//         id: $("#book_id").val(),
//         title: $("#title_edit").val(),
//         description: $("#description_edit").val(),
//     };

//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });

//     $.post("http://localhost:8000/editBook", data, (data) => {
//         // console.log(data)
//         renderTable(data);
//     });
// }
// function coba() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     $.post(
//         "coba",
//         {
//             name: "yunus",
//             age: "21",
//         },
//         (data) => {
//             console.log(data);
//         }
//     );
// }
// coba();
