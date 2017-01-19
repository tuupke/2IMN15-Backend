@include("nav")


<script type="text/template" class="template" id="list">
    <button id="newButton" onclick="addNew();">New {{ $manager }}</button>
    <% for (var i = 0; i < rc.parts.length; i++) { %>
<%= renderSub(rc.parts[i]) %>
<% } %>
</script>


@include("templates/".$manager)
<!-- Top container -->

<div class="w3-main" style="margin-left:300px;margin-top:43px;">
<h1>
    Welcome to the {{ $manager }} manager
</h1>

<br/>
<br/>
<br/>
<button id="newButton" onclick="sendAll();">Save</button>
</div>


<script type="text/javascript">
_.templateSettings.variable = "rc";
var renderSub = _.template($('#{{ $manager }}Form').text())

$.get("/api" + window.location.pathname, [], function (data) {
    renderParent(data);
});

function addNew() {
    $("#newButton").after(
        renderSub({buttonType: "Create", id: -1})
    );
}

function remove(form) {
    form.parentNode.removeChild(form);
}

function sendAll() {

    var elss = document.querySelectorAll(".prioForm");

    console.log(elss.length)

    var arr = [];

    for (var j = 0; j < elss.length; j++) {
        console.log(j);

        var obj = {};
        var els = elss[j].elements
        for (var i in els) {
            if ((!isNaN(parseFloat(i)) && isFinite(i)) || els[i].value === undefined){
                continue
            }

            obj[i] = els[i].value;
        }

        arr[j] = obj;
    }

    $.ajax({
        url: "/api" + window.location.pathname,
        type:"POST",
        data: JSON.stringify({'c' : arr}),
        contentType: 'application/json',
        success: function (data) {
            console.log(data)
//                location.reload();
        }
    });
}

function act(form) {
    var obj = {};

    var els = form.elements
    for (var i in els) {
        if ((!isNaN(parseFloat(i)) && isFinite(i)) || els[i].value === undefined)
            continue

        obj[i] = els[i].value;
    }

    var url = "";
    var oldId = form.id.value

    if (form.id.value == -1) {
        url = window.location.pathname + "/../{{ $manager }}";
    } else {
        url = "/{{ $manager }}s/" + form.id.value
    }

    $.ajax({
        url: "/api" + url,
        type: (form.id.value != -1 ? "PUT" : "POST"),
        data: obj,
        success: function (data) {
            location.reload();
        }
    });
}

function renderParent(parts) {
    var template = _.template(
        $("script#list").html()
    );

    _.map(parts, function (item) {
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

</body>
</html>
