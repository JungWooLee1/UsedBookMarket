



<?php
  //include "db_info.php";
  //include "/var/www/html/include/login.php";


//책은 가장 조용하고 변함없는 벗이다. 책은 가장 쉽게 다가갈 수 있고 가장
//현명한 상담자이자 가장 인내심 있는 교사이다. -찰스 W.엘리엇
?>

<!DOCTYPE html>
<html>
<head>
  <title>중고책 나라</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/style.css"/>
<style>
 td{padding:5px;}
 .tdleft{text-align: right}
 </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


 <script>

 </script>

</head>
<body>
<?php
include "wrapper.php";
include "db_info.php";

if(!isset($_SESSION['nickname']))
{
  echo "<script>alert('잘못된접근');history.back();</script>";
}else{
  $nickname=$_SESSION['nickname'];
}

$sql="select * from login where nickname='".$nickname."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

?>
<div style="width:50em;height:30em;margin:20px auto;padding:2em">
  <div style="width:23em;height:25em;border:1px solid green;float:left;padding:1em;background-color:#EAEAEA;border-radius:10px"/>
    <br>
    <font size="4em">회원 정보 변경</font><br><br>
    <table>
      <tr>
        <td class="tdleft">아이디 :</td>
        <td><?php echo $row['id']?></td>
      </tr>
      <tr>
        <td class="tdleft">닉네임 : </td>
        <td><?php echo $row['nickname']?></td>
      </tr>
      <tr>
        <td class="tdleft">주소 :</td>
        <td><textarea id="address" style="width:235px;height:50px"><?php echo $row['address']?></textarea></td>
      </tr>
      <tr>
        <td class="tdleft">핸드폰번호 :</td>
        <td><input id="phonenumber" type="text" value="<?php echo $row['phonenumber']?>"></td>
      </tr>
      <tr>
        <td class="tdleft">비밀번호확인 : </td>
        <td><input id="password" type="password" size="20"/></td>
      </tr>
      <tr><td>
      <tr><td colspan="2"><button class="mybutton" style="width:70px" id="mybutton">확인</button></td></tr>
    </table>
    <font color="blue">*비밀번호를 입력하시면 회원정보가 변경됩니다.</font>
  </div>
  <div style="width:21em;height:25em;border-left:1px solid gray;float:right;padding:1em"/>
    <br>
    <image style="width:17em;height:21em;" src="/image/WiseSaying2.jpg"/>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#mybutton").click(function(){
    var password=$("#password").val();
    if(password!="<?php echo $row['password']?>")
    {
      alert('패스워드가 올바르지 않습니다.');
    }
    else
    {
      $.post('profile_update.php',
      {
        nickname : "<?php echo $nickname ?>",
        address : $("#address").val(),
        phonenumber : $("#phonenumber").val()
      },
      function(data,status)
      {
        alert('회원정보 변경이 완료되었습니다.');
        location.replace('./profile.php');
      });
    }
  });
});

</script>


</body>
</html>
