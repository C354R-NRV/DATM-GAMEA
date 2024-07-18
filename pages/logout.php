<?php 
session_start();  
session_destroy();
$_SESSION['swlogin'] = '0';  
?>
<!DOCTYPE html>
<html lang="es"> 
<head>  
<title>LogOut</title>
<style type="text/css" title="currentStyle">    
body{
    background-color:rgb(251, 251, 251);
}
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('../img/loadPage.gif') 50% 50% no-repeat;
    opacity: .8;
}
</style> 
</head>
<body>  
    <div class="loader"></div>  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script language="javascript">  
    $(document).ready(function ($) {  
        window.location.href = "index.php"
    }); 
</script> 
</html>