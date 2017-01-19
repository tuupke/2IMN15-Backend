<script type="text/template" class="template" id="list">
    <% for (var i = rc.parts.length -1; i >= 0; i--) { %>
    <%= renderSub(rc.parts[i]) %>
    <% } %>
</script>
