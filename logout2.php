<?php
session_start();
session_destroy();	

    echo "<script>alert('LOGOUT'); window.location = 'http://10.10.20.250/dashboard/APPS-ROBOT/GITHUB/LOG/logout.php'</script>";

?>

