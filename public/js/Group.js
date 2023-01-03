
    let book = "";
    let content = "";
    
    let baseURL = 'http://localhost:8000';
    function getBook(){
        $.get("http://localhost:8000/getBook", (data)=>{
            // console.log(data)
            content += `<div class="input-group mt-3">
            <button type="button" class="btn btn-danger" onclick="deleteList(event)">delete</button>
            <select class="form-select paritra">`;
            book = JSON.parse(data);
            for(var a = 0; a < book.length; a++){
                content += `<option value="${book[a].id}">${book[a].title}</option>`
            }
            content += `</select>
            </div>`
            $("#myList").empty();
            $("#myList").html(content);
        })

    }
    getBook()

    function addList(e){
        $("#myList").append(content)
    }

    function deleteList(e){
        $(e.target).parent().remove()
    }

    function save(e){
        let list = $(".paritra");
        let idBook = [];
        for(var a = 0; a < list.length; a++){
            idBook.push(list.eq(a).val())
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

        $.ajax({
            type : "POST",
            url : new URL("/addGroup", baseURL),
            data : data,
            success : (data)=>{
                alert(data)
            }
        })

    }