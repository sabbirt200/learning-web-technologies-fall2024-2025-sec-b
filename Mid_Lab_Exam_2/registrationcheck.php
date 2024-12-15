
<?php 
    if(isset($_POST['submit'])){
        $Id = $_POST["Id"];
        $Password = $_POST["Password"];
        $Confirm_Password = $_POST["Confirm_Password"];
        $User_Type = $_POST["User Type"];
        
    }

    if(empty($Id)){
        echo "Id is missing!";
    }
    elseif(empty($password)){
        echo "Password is missing!";
    }elseif(strlen($Confirm_Password)<2){
        echo "Password is not missing";
    }elseif(strlen($User_Ty)<8){
        echo "User_Ty admin or user!";
    }
    else{
        echo "Registration SuccessFul!";
        header('location: home.html')
    }
    if User_Type(User){
        header('location: user.html')

    }
    elseif {
        header('location: Admin.html')
    }
?>
