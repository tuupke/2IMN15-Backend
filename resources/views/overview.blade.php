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
    <a href="/" class="w3-padding">Overview</a>
    <a href="/users" class="w3-padding"> Configure User</a>
    <a href="/lights" class="w3-padding"> Configure Lights</a>
    <a href="/sensors" class="w3-padding"> Configure Sensors</a>


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
        Welcome to the overview
    </h1>
</div>
<script type="text/template" class="template" id="lightList">
    <tr>
        <td><%- rc.id %></td>
        <td><%- rc.x %></td>
        <td><%- rc.y %></td>
        <td><%- rc.group %></td>
        <td><%- rc.color %></td>
    </tr>
</script>

<script type="text/template" class="template" id="lightSensors">
    <tr>
        <td><%- rc.id %></td>
        <td><%- rc.x %></td>
        <td><%- rc.y %></td>
        <td><%- rc.group %></td>
        <td><%- rc.color %></td>
    </tr>
</script>


<script type="text/javascript">
    _.templateSettings.variable = "rc";
    var renderSub = _.template($('#lightList').remove().text())


    $.get("/api/lamps", [], function (data) {
        renderLamps(data);
    });


    function renderLamps(parts) {
        var template = _.template(
            $("script#listLights").html()
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
</script>


<script type="text/template" class="template" id="listLights">

    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>X</th>
            <th>Y</th>
            <th>Group</th>
            <th>Color</th>
        </tr>
        <% for (var i = rc.parts.length -1; i >= 0; i--) { %>
        <%= renderSub(rc.parts[i]) %>
        <% } %>
    </table>

</script>


</body>
</html>
