<?php 
include "connection.php";
if(isset($success_mgs)){
    foreach($success_mgs as $success_mgs){
        echo '<scropt>swal("'.$success_mgs.'","","success");</script>';
    }
}
if(isset($warning_mgs)){
    foreach($warning_mgs as $warning_mgs){
        echo '<scropt>swal("'.$warning_mgs.'","","warning");</script>';
    }
}
if(isset($info_mgs)){
    foreach($info_mgs as $info_mgs){
        echo '<scropt>swal("'.$info_mgs.'","","info");</script>';
    }
}
if(isset($error_mgs)){
    foreach($error_mgs as $error_mgs){
        echo '<scropt>swal("'.$error_mgs.'","","error");</script>';
    }
}
?>