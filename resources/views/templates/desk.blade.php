<script type="text/template" class="template" id="deskForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form action="#">
            Name <input type="text" name="name" value="<%- rc.name %>"><br>
            <% if ( rc.id > 0 ){ %>
            <a href="/desks/<%- rc.id %>/groups">Groups</a><br />
            <a href="/desks/<%- rc.id %>/users">Users</a><br />
            <% } %>
            <% if ( rc.room_id > 0 ){ %>
            <a href="/rooms/<%- rc.room_id %>">Room</a><input type="text" name="room_id" value="<%- rc.room_id %>"><br>
            <% } %>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
            <input type="button" name="delete" onclick="remove(this.parentNode);" value="Delete">
        </form>
    </div>
</script>
