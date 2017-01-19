@include("nav")

@include("templates/".$manager)
<!-- Top container -->
<div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
    <button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i> �Menu
    </button>
    <span class="w3-right">IoT</span>
</div>

<div class="w3-main" style="margin-left:300px;margin-top:43px;">
    <h1>
        Welcome to the {{ $manager }} manager
    </h1>
</div>

<script type="text/javascript">
    _.templateSettings.variable = "rc";

    $.get("/api" + window.location.pathname, [], function (data) {
        renderParent(data);
    });

    function remove(form) {
        $.ajax({
            url: "/api/{{ $manager }}s/" + form.id.value,
            type: "DELETE",
            success: function (data) {
                window.alert("success, going to previous page")
                form.id.value = data.id
                form.submit.value = "Save"
                console.log(data);
                window.history.back()
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

        $.ajax({
            url: "api/{{ $manager }}s/" + (form.id.value != -1 ? form.id.value : ""),
            type: (form.id.value != -1 ? "PUT" : "POST"),
            data: obj,
            success: function (data) {
                location.reload()
            }
        });
    }

    function renderParent(parts) {
        var template = _.template(
            $("script#{{ $manager }}Form").html()
        );

        parts.buttonType = "Save"

        console.log(parts);

        if(parts.length == 0){
            window.alert("Not found, returning to privous page")

            window.history.back()
        }

        $("h1").after(
            template(parts)
        );
    }
</script>


</body>
</html>
