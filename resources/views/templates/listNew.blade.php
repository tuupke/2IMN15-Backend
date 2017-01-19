<script type="text/template" class="template" id="list">
    <button id="newButton" onclick="addNew();">New {{ $manager }}</button>
    <% for (var i = rc.parts.length -1; i >= 0; i--) { %>
    <%= renderSub(rc.parts[i]) %>
    <% } %>
</script>
