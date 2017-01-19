<script type="text/template" class="template" id="lampForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form method="POST" action="#">
            Name: <%- rc.name %><br />
            X position <input type="text" name="x" value="<%- rc.x %>"><br>
            Y position <input type="text" name="y" value="<%- rc.y %>"><br>
            Color <input type="text" name="color" value="<%- rc.color %>"><br>
            <% if ( rc.desk_id == undefined || rc.desk_id < 0 ){ %>
            No Group
            <% } else { %>
            <a href="/groups/<%- rc.group_id %>">Group</a>
            <% } %>


            <input type="text" name="group_id" value="<%- rc.group_id %>"><br>

            <% if (rc.id > 0 ){ %>
            <a href="/lamps/<%- rc.id %>/priority">Priorities</a>
            <% }%>
            <input type="hidden" name="endpoint" value="<%- rc.endpoint %>"><br>
            Low light <input name="low_light" value="<%- rc.low_light %>"><br>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
        </form>
    </div>
</script>
