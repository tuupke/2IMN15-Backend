<script type="text/template" class="template" id="groupForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form action="#">
            Name <input type="text" name="name" value="<%- rc.name %>"><br>
            <% if ( rc.id > 0 ){ %>
            <a href="/groups/<%- rc.id %>/sensors">Sensors</a><br />
            <a href="/groups/<%- rc.id %>/lights">Lights</a><br />
            <% } %>
            <% if ( rc.desk_id == undefined || rc.desk_id < 0 ){ %>
            No desk
            <% } else { %>
            <a href="/desks/<%- rc.desk_id %>">Desk</a>
            <% } %>
            <input type="text" name="desk_id" value="<%- rc.desk_id %>"><br>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
            <input type="button" name="delete" onclick="remove(this.parentNode);" value="Delete">
        </form>
    </div>
</script>
