<script type="text/template" class="template" id="userForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form method="POST" action="#">
            Name <input type="text" name="name" value="<%- rc.name %>"><br>
            Password <input type="text" name="password" value="<%- rc.password %>"><br>
            Email <input type="text" name="email" value="<%- rc.email %>"><br>
            Facepattern <input type="text" name="facepattern" value="<%- rc.facepattern %>"><br>
            Type <input type="text" name="type" value="<%- rc.type %>"><br>


            <% if ( rc.desk_id == undefined || rc.desk_id < 0 ){ %>
            No desk
            <% } else { %>
            <a href="/desks/<%- rc.desk_id %>">Desk</a>
            <% } %>
            <input type="text" name="desk_id" value="<%- rc.desk_id %>"><br>
            <input type="text" name="group_id" value="<%- rc.group_id %>"><br>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
            <input type="button" name="delete" onclick="remove(this.parentNode);" value="Delete">
        </form>
    </div>
</script>
