<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ATG</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
        .statuspopup , .addpopup{
            background: rgba(0,0,0,0.6);
            width:100%;
            height:100%;
            position: absolute;
            top: 0;
            left:0;
            right:0;
            display: none;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .popup-status , .popup-add{
            height:250px;
            width:400px;
            background:#fff;
            padding:20px;
            border-radius:5px;
            position:relative;
        }
        input{
            margin:auto;
            display:block;
            text-align:center;
        }
        </style>        
    </head>
    <body style="background-image:url('images/wall.png'); width:100%; height:100%">

<header>
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#BOE0E6">
<a class="navbar-brand" style="color:white;font-size:25px"><b><i>ATG</i></b></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
<div class="navbar-nav">
</div>
<div class="navbar-nav ml-auto">
@if(Session::get('user'))
<a class="nav-item nav-link mx-4" style="color:white;">Hi, {{Session::get('user')}}</a>
<hr>
<a class="nav-item btn btn-primary " href="logout">Logout</a>
@else
<a class="nav-item nav-link active" href="/login">Login</a>
<a class="nav-item nav-link active" href="/register">Register</a>
@endif
</div>
</div>
</nav>
</header>
<div class="content d-flex justify-content-center">
@if(Session::get('user'))
<div>
    <div class="addpopup">
        <div class="popup-add">
            <h1 style="font-family:fantasy; color:darkblue;font-size:30px">Task</h1><br>
            <form id="addform" action="/api/todo/add" method="post">
                @csrf
                <input type="text" name="user_id" id="user_id" placeholder="user_id" required><br>
                <input type="text" name="task" id="task" placeholder="task" required><br>
                <input type="submit" id="add_task" class="btn btn-primary add-task" value="Add">
                <button type="button" id="addclose" class="btn btn-danger">Close</button>
            </form>
            <div id="result"></div>
        </div>
    </div>
    <div class="statuspopup">
        <div class="popup-status">
            <h1 style="font-family:fantasy; color:darkblue;font-size:25px">Status Update</h1><br>
            <form id="statusform" action="/api/todo/status" method="post">
                @csrf
                <input name="_method" type="hidden" value="put">
                <input type="text" name="user_id" id="user_id" placeholder="user_id" required>
                <br>
                <input type="text" name="status" id="status" placeholder="status" required>
                <br>
                <input type="submit" class="btn btn-primary" value="Update">
                <button type="button" id="statusclose" class="btn btn-danger">Close</button>
            </form>
        </div>
    </div>
    
    <h1 style="font-family:fantasy; padding:150px 550px px px; color:darkblue;font-size:25px">Hey, {{Session::get('user')}}</h1>
    <h1 style="font-family:fantasy; padding:10px 550px px px; color:#DEB887;font-size:25px">ToDo List</h1>
    <button type="button" id="addbutton" class="btn btn-primary" href="">Add</button>
    <button type="button" id="statusbutton" class="btn btn-success">Status</button>
    <table class="table">
        <thead>
            <tr class="table-info">
            <th scope="col">id</th>
            <th scope="col">user_id</th>
            <th scope="col">task</th>
            <th scope="col">status</th>
            </tr>
        </thead>
    <tbody>
        <?php
    
        $conn = mysqli_connect("localhost","root","","atg");  
        
        if($conn->connect_error){
            die("Connection failed:".$conn->connect_error);
        }
        $sql = "SELECT id,user_id,task,status from task";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr class='table-light'><td>".$row["id"] . "</td><td>".$row["user_id"]."</td><td>".$row["task"]."</td><td>".$row["status"]."</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo "not added yet";
        }
        $conn->close();

        ?>
    </tbody>
    </table>

</div>

@else
@yield('content')
@endif
</div>
</body>
</html>


<script>
document.getElementById("addbutton").addEventListener("click",function(){
  document.querySelector(".addpopup").style.display="flex";  
})

document.getElementById("addclose").addEventListener("click",function(){
  document.querySelector(".addpopup").style.display="none";  
})

document.getElementById("statusbutton").addEventListener("click",function(){
  document.querySelector(".statuspopup").style.display="flex";  
})

document.getElementById("statusclose").addEventListener("click",function(){
  document.querySelector(".statuspopup").style.display="none";  
})


// $(document).ready(function(){
//     $(".add-task").click(function(event){
//         $.ajax({
//             type: 'POST',
//             url: 'http://localhost:8000/api/todo/add',
//             data: { 'user_id': '101','task':'www' },
//             contentType: 'application/json; charset=utf-8',
//             dataType: 'json',
//             })
// });

</script>