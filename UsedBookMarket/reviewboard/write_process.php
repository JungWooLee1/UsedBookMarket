<?php

  include '../db_info.php';
  //파일처리
  if($_FILES['myfile']['name']!=null){ //선택한 이미지가 존재할 때 처리
    $target_dir="/var/www/html/reviewboard/upload/";
    $target_file=$target_dir.basename($_FILES["myfile"]["name"]);
    $imagefiletype=pathinfo($target_file,PATHINFO_EXTENSION);

    $imagepath=$target_file;


    if(file_exists($target_file)){
      echo "<script>window.alert('파일이 이미 존재합니다');history.back()</script>";
    }

    if($_FILES["myfile"]["size"]>1048576*10){//5메가 이상
      echo "<script>window.alert('5메가이상 등록 불가');history.back()</script>";
    }

    if($imagefiletype!="jpg"&&$imagefiletype!="png"&&$imagefiletype!="jpeg"&&$imagefiletype!="gif")
    {
      echo "<script>window.alert('사진파일만 등록가능');history.back()</script>";
    }

    if(move_uploaded_file($_FILES['myfile']['tmp_name'],$target_file))
    {
      echo("파일 업로드 완료<br>");
    }else{
      echo("업로드 실패<br>");
    }
  }else{

    $imagepath=null;

  }

  //입력 처리
  $title=$_POST['title'];
  $content=$_POST['content'];
  $nickname=$_POST['nickname'];
  $date=date('y-m-d H:i:s');


  $sql="insert into reviewboard values(null,'".$title."','".$content."',
  '".$nickname."','".$date."',default,default,'".$imagepath."')";

  $result=mysqli_query($conn,$sql);


  if($result!=null)
  {

    echo "<font style='color:blue'>게시판 글이 등록되었습니다.<br>
    3초뒤에 목록으로 이동합니다.</font>";
    echo "<script>setTimeout(function(){location.replace('./list.php?page=1&sorting=date')},3000)</script>";

  }


?>
