<script type="text/template" class="template" id="roomForm">
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <form action="#">
            Name <input type="text" name="name" value="<%- rc.name %>"><br>
            <% if ( rc.id > 0 ){ %>
            <a href="/rooms/<%- rc.id %>/desks">Desks</a><br />
            <% } %>
            <input type="hidden" name="id" value="<%- rc.id %>"><br>
            <input type="button" name="submit" onclick="act(this.parentNode); return false;" value="<%- rc.buttonType %>">
            <input type="button" name="delete" onclick="remove(this.parentNode);" value="Delete">
        </form>
    </div>
</script>
