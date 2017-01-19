@include("nav")

@if(@$hasNew ?? false)
    @include("templates/listNew")
@else
    @include("templates/list")
@endif

@include("templates/".$manager)
<!-- Top container -->

<div class="w3-main" style="margin-left:300px;margin-top:43px;">
    <h1>
        Welcome to the {{ $manager }} manager
    </h1>
</div>


<script type="text/javascript">
    _.templateSettings.variable = "rc";
    var renderSub = _.template($('#{{ $manager }}Form').text())

    $.get("/api" + window.location.pathname, [], function (data) {
        renderParent(data);
    });

    function addNew(){
        $("#newButton").after(
            renderSub({buttonType : "Create", id : -1})
        );
    }

    function remove(form) {
        if (form.id.value != -1) {
            $.ajax({
                url: "api/{{ $manager }}s/" + form.id.value,
                type: "DELETE",
                success: function(data){
                    window.alert("success")
                    form.id.value = data.id
                    form.submit.value = "Save"
                    console.log(data);
                }
            });
        }

        form.parentNode.removeChild(form);
    }

    function act(form) {
        var obj = {};

        var els = form.elements
        for (var i in els) {
            if ((!isNaN(parseFloat(i)) && isFinite(i)) || els[i].value === undefined || els[i].value == "")
                continue

            console.log(els[i].value)

            obj[i] = els[i].value;
        }

        var url = "";
        var oldId = form.id.value

        if (form.id.value == -1 ) {
            url = window.location.pathname + "/../{{ $manager }}";
        } else {
            url = "/{{ $manager }}s/" + form.id.value
        }

        $.ajax({
            url: "/api" + url,
            type: (form.id.value != -1 ? "PUT" : "POST"),
            data: obj,
            success: function(data){
                location.reload();
            }
        });
    }

    function renderParent(parts) {
        var template = _.template(
            $("script#list").html()
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

</body>
</html>
