
    function modalU(event){
        $("#modalUbah").modal('show')
        $("#titleU").val($(event.target).attr('data-title'))
        $("#descriptionU").val($(event.target).attr('data-description'))
        $("#idBuku").val($(event.target).attr('data-id'))
    }
    function hapus(event){
        let data = {
           id : $(event.target).attr("data-id")
         }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("http://localhost:8000/hapusBuku", data, (data)=>{
            // console.log(data)
            renderTable(data)
        })
    }

    function tambah(){
        let data = {
           title : $("#title").val(),
           description : $("#description").val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("http://localhost:8000/tambahBuku", data, (data)=>{
            // console.log(data)
            renderTable(data)
        })
    }
    function ubah(){
        let data = {
           id : $("#idBuku").val(),
           title : $("#titleU").val(),
           description : $("#descriptionU").val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("http://localhost:8000/ubahBuku", data, (data)=>{
            // console.log(data)
            renderTable(data)
        })
    }

    function renderTable(datas){
        let data = JSON.parse(datas);
        let content = "";
        for(var a = 0; a < data.length; a ++){
            content += `<tr>
            <td >`+data[a].title+`</td>
            <td >`+data[a].description+`</td>
            <td>
                <button type="button" class="btn btn-danger" data-id="`+data[a].id+`" onclick="hapus(event)">hapus</button>
                <button type="button" class="btn btn-warning" data-id="`+data[a].id+`" data-title="`+data[a].title+`" data-description="`+data[a].description+`" onclick="modalU(event)">ubah</button>
            </td>
          </tr>`
        }
        $("#tbody").empty()
        $("#tbody").html(content)

    }
    var book = "";
    var content = "";
    function getBook(){
        $.get("http://localhost:8000/getBook", (data)=>{
            content += `<div class="input-group mt-3">
            <button type="button" class="btn btn-danger" onclick="hapusList(event)">hapus</button>
            <select class="form-select paritra">`;
            book = JSON.parse(data);
            for(var a = 0; a < book.length; a++){
                content += `<option value="`+book[a].id+`">`+book[a].title+`</option>`
            }
            content += `</select>
            </div>`
            $("#myList").empty();
            $("#myList").html(content);
        })

    }
    getBook()

    function tambahList(e){
        $("#myList").append(content)
    }

    function hapusList(e){
        $(e.target).parent().remove()
    }

    function simpan(e){
        let list = $(".paritra");
        let idBook = "";
        for(var a = 0; a < list.length; a++){
            idBook += list.eq(a).val()+";"
        }
        let data = {
            title : $("#title").val(),
            description : $("#description").val(),
            paritra : idBook
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("http://localhost:8000/tambahKelompok", data, (data)=>{
            console.log(data)

        })
    }