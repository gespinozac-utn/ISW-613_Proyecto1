<?php 
    require('functionsUser.php');
    
    if($_POST){
        if(!emptyFields()){
            $user = validateUser(new User($_REQUEST['username'],$_REQUEST['password']));
            
            if(!empty($user)){
                session_start();
                $_SESSION['user']=$user;
                header('location:/dashboard.php');
            }else{
                header('location:/index.php?status=error');
            }
        }else{
            header('location:/index.php?status=empty');
        }
    }

    function emptyFields(){
        return (empty($_REQUEST['username']) || empty($_REQUEST['password']));
    }
?>