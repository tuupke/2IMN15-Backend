<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery-1.8.0.min.js"></script>
    <!-- Fonts -->

    <title>Building Manager App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html, body, h1, h2, h3, h4, h5 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
    <button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i> �Menu
    </button>
    <span class="w3-right">IoT</span>
</div>

<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
    <div class="w3-container w3-row">

        <div class="w3-col s8">
            <span>Welcome, <br><strong>Building Manager</strong></span><br>
        </div>
    </div>
    <hr>
    <a href="#" class="w3-padding">Overview</a>
    <a href="user.php" class="w3-padding"> Configure User</a>
    <a href="light.php" class="w3-padding"> Configure Lights</a>
    <a href="sensor.php" class="w3-padding"> Configure Sensors</a>


</nav>

<script>
    // Get the Sidenav
    var mySidenav = document.getElementById("mySidenav");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidenav, and add overlay effect
    function w3_open() {
        if (mySidenav.style.display === 'block') {
            mySidenav.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidenav.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    // Close the sidenav with the close button
    function w3_close() {
        mySidenav.style.display = "none";
        overlayBg.style.display = "none";
    }
</script>
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <h1>
        Welcome to the user manager
    </h1>
</div>
<script type="text/template" class="template" id="userForm">

    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><%- rc.listTitle %></b></h5>
        </header>

        <form method="POST" action="#">
            Name <input type="text" name="name" value="<%- rc.name %>"><br>
            Password <input type="text" name="password" value="<%- rc.password %>"><br>
            Email <input type="text" name="email" value="<%- rc.email %>"><br>
            Facepattern <input type="text" name="facepattern" value="<%- rc.facepattern %>"><br>
            Type <input type="text" name="type" value="<%- rc.type %>"><br>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
        </form>
    </div>

</script>


<script type="text/javascript">
    _.templateSettings.variable = "rc";
    var renderSub = _.template($('#userForm').remove().text())


    $.get("/api/users", [], function (data) {
        renderParent(data);
    });

    function act(form) {

        if(form.id.value == -1){
            window.alert("Create new")

            $.post("/api/users", {
                "name" : form.name.value,
                "password" : "1234",
                "type" : "USER2",
                "email" : "",
                "facepattern" : ""
            }, function(data){
                window.alert("Success")

                form.id.value = data.id
                form.submit.value = "Save"
                console.log(data);
            })

        } else {
            window.alert("Save userid: " + form.id.value)
        }
    }

    function renderParent(parts) {
        var template = _.template(
            $("script#listUsers").html()
        );

        _.map(parts, function(item){
            item.buttonType = "Save"
        });

        var templateData = {
            "parts": parts
        };

        $("h1").after(
            template(templateData)
        );
    }

    function addNew(){
        $("#newButton").after(
            renderSub({buttonType : "Create", id : -1})
        );
    }


</script>


<script type="text/template" class="template" id="listUsers">

    <button id="newButton" onclick="addNew();">New User</button>
    <% for (var i = rc.parts.length -1; i >= 0; i--) { %>
<%= renderSub(rc.parts[i]) %>
<% } %>

</script>


</body>
</html>
