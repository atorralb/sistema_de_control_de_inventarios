<?php
 include 'setup_idiorm.php';

if(isset($_REQUEST['email']))//If a username has been submitted
{
$username =  ORM::for_table('users')->where('user_email',$_POST['email'])->count();

//Query to check if username is available or not

if($username >= 1)
{
echo '1';//If there is a  record match in the Database - Not Available
}
else
{
echo '0';//No Record Found - Username is available
}
}


?>