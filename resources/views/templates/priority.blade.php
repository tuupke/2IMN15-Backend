<script type="text/template" class="template" id="priorityForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form class="prioForm" action="#">
            <% if ( rc.user_id == undefined || rc.user_id < 0 ){ %>
            No user
            <% } else { %>
            <a href="/users/<%- rc.user_id %>">User</a>
            <% } %>
            <input type="text" name="user_id" value="<%- rc.user_id %>"><br>

            X position <input type="text" name="user_location_x" value="<%- rc.user_location_x %>"><br>
            Y position <input type="text" name="user_location_y" value="<%- rc.user_location_y %>"><br>

            Color <input type="text" name="light_color" value="<%- rc.light_color %>"><br>
            Low light <input name="low_light" value="<%- rc.low_light %>"><br>

            <% if ( rc.sensor_id == undefined || rc.sensor_id < 0 ){ %>
            No Sensor
            <% } else { %>
            <a href="/sensors/<%- rc.sensor_id %>">Sensor</a>
            <% } %>
            <input type="text" name="sensor_id" value="<%- rc.sensor_id %>"><br>

            <input type="button" name="delete" onclick="remove(this.parentNode);" value="Delete">
        </form>
    </div>
</script>
