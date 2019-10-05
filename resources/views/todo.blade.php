<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="text-center">Todo List</h1>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-10" id="tes">
                    <input type="text" class="form-control" id="name" onkeyup="changeTodo(this);">
                    <span id="typing">Type in a new todo...</span>
                </div>
                <div class="col-md-2" id="tes">
                    <button class="btn btn-primary" onclick="createTodoList();">
                        Add Todo
                    </button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <ul class="list-group" id="todolists">
                    </ul>
                    <button class="btn btn-danger mt-4" onclick="deleteTodoList();">
                        Delete selected
                    </button>
                </div>
            </div>
        </div>
        

        <script type="text/javascript">
            const data = {
                '_token' : $("meta[name='csrf-token']").attr("content"),
                'name' : $('#name').val(),
                'checked' : []
            };

            const callTodoList = () => {
                $.ajax({
                    url : "{{ url('api/todolists') }}",
                    success : function(res){
                        $('#todolists').html('');
                        res.forEach(function(todolist, index){
                            $('#todolists').append('<li class="list-group-item"><input onchange="checkList();" name="options[]" type="checkbox" data-id="'+ todolist.id +'"> '+ todolist.name +'</li>');
                        })
                }
                });  
            }

            const changeTodo = (e) => {
                data.name = e.value; 
                if(data.name != '')
                    $('#typing').text('Typing : ' + data.name);
                else
                $('#typing').text('Type in a new todo...');
            }

            $('#name').bind('keypress', function(e) {
                if(e.keyCode==13){
                    createTodoList();
                }
            });

            const createTodoList = () => {
                $.ajax({
                    type : 'POST',
                    url : "{{ url('api/todolists') }}",
                    data : data,
                    success : function(res){
                        if(res.message == 'success'){
                            callTodoList();   
                            $('#name').val('');
                            data.name = '';
                        }
                             
                    }
                });
            }

            const deleteTodoList = () => {
                $.ajax({
                    type : 'DELETE',
                    url : "{{ url('api/todolists') }}",
                    data : data,
                    success : function(res){
                        if(res.message == 'success'){
                            callTodoList();   
                        }
                            
                    }
                });
            }
            
            const checkList = () => {
                data.checked = [];
                $("input[name='options[]']:checked").each(function ()
                {
                    data.checked.push($(this).data('id'));
                });
            }

            callTodoList();
           
        </script>
    </body>
</html>
