<?php 
ini_set("session.use_only_cookies", "1");
ini_set("session.use_trans_sid", "0");
error_reporting(0);
ini_set('display_errors', 0);
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
session_start(); 
?>
<html lang="es">
<head>
<meta charset="utf-8"> 
<title>DATM</title>
<link rel="shortcut icon" href="img/favicon.ico">
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
    background: url('img/loadPage.gif') 50% 50% no-repeat;
    opacity: .8;
}
</style>

</head>
<body> 
    <input type='hidden' id='valini_' value="<?php echo $_SESSION['usuario']; ?>"/>
    <div class="loader"></div>  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script language="javascript">  
    $(document).ready(function ($) { 
        if (typeof $('#valini_').val() != "undefined" && $('#valini_').val()!=''){
            window.location.href = "pages/home.php"
        }else{
            window.location.href = "pages/index.php"
        }
    }); 
</script> 

</html>