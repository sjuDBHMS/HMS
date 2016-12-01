<?php
include_once '../dbconnect.php';
include_once 'doctorHeader.php';
?>
    <link rel="stylesheet" href="http://www.jacklmoore.com/colorbox/example1/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://www.jacklmoore.com/colorbox/jquery.colorbox.js"></script>
    <script>
      
      function openpopup(x){
        $.colorbox({iframe:true, title:'Update Status',escKey:false, width:"80%", height:"80%", href: x,
overlayClose:false,onClosed:function() { location.reload(true); }});
      }
      
      function updateStatus(location) {
  			if (location=="") return;
			setTimeout(openpopup(location), 0);
			} 
    </script>
<body>
</body>
</html>