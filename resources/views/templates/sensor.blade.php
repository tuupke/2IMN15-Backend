<script type="text/template" class="template" id="sensorForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form method="POST" action="#">
            Name: <%- rc.name %><br />
            X position <input type="text" name="x" value="<%- rc.x %>"><br>
            Y position <input type="text" name="y" value="<%- rc.y %>"><br>
            <% if ( rc.group_id == undefined || rc.group_id < 0 ){ %>
            No Group
            <% } else { %>
            <a href="/groups/<%- rc.group_id %>">Group</a>
            <% } %>
            <input type="text" name="group_id" value="<%- rc.group_id %>"><br>
            <% if ( rc.room_id == undefined || rc.room_id < 0 ){ %>
            No Room
            <% } else { %>
            <a href="/rooms/<%- rc.room_id %>">Room</a>
            <% } %>
            <input type="text" name="room_id" value="<%- rc.room_id %>"><br>
            <% if ( Number.isInteger(rc.user_id) ){ %>
            <a href="/users/<%- rc.user_id %>">User: <a href="/users/<%- rc.user_id %>"><%- rc.user_id %></a>
                <% } else { %>
                No User
            <% } %>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
        </form>
    </div>
</script>
