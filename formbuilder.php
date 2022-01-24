<!DOCTYPE html>
<html>
<head>
    <title>Example formBuilder</title>
</head>
<body>
  <div id="fb-editor"></div>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/jquery-ui-sortable/jquery-ui.min.js"></script>
  <script src="node_modules/formBuilder/dist/form-builder.min.js"></script>
  <script>
  jQuery(function($) {
    $(document.getElementById('fb-editor')).formBuilder();
  });
  </script>
</body>
</html>