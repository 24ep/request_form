<?php 
$usernmae = $_GET['username'];
$email = $_GET['email'];
// 1. หลังจากที่ยูสเซอร์ป้อนข้อมูลหน้าฟอร์มและ submit มา สร้างตัวเลขสุ่มขึ้นมาชุดหนึ่งเพื่อเป็น verify code 

    // สร้างรหัสสุ่ม 
    
    //1.สร้างชุดตัวอักษรตั้งแต่ a-z 
    $arr_a_z = range( "a" , "z" );
    
    //2.สร้างชุดตัวอักษรตั้งแต่ A-Z 
    $arr_A_Z = range( "A" , "Z" );
    
    //3.สร้างชุดตัวอักษรตั้งแต่ 0-9 
    $arr_0_9 = range( 0 , 9 ); 
    
    //4.เอาชุดตัวอักษรทั้ง 3 มารวมกัน 
    $arr_a_9 = array_merge( $arr_a_z , $arr_A_Z , $arr_0_9 ) ; 
    $str_a_9 = implode( $arr_a_9 ) ; 
    
    //5.ทำการสับเปลี่ยนตำแหน่งตัวอักษร 
    $str_a_9 = str_shuffle( $str_a_9 ) ; 
    
    //6.ตัดเอามาแค่ 10 ตัวอักษร 
    $member_verify_code = substr( $str_a_9 , 0 , 10 ) ; 
    
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql  = "UPDATE account SET verify_code = '".$member_verify_code."' WHERE username='".$username."'";
	$query = mysqli_query($con,$sql);
    if($query){
        $member_id = $con->insert_id;
          // 3. ส่ง verify code ไปทางอีเมล์ 
        // $to = $email ; 
        // $subject = "Verify By Email" ; 
        // $headers = "MIME-Version: 1.0\r\n" ; 
        // $headers .= "Content-Type: text/html; charset=UTF-8 \r\n" ; 
        // $headers .= "From: CSG <noreply@cdse-commercecontent.com>\r\n" ; 
        // $body = "<a href=https://content-service-gate.cdse-commercecontent.com/base/verify_account/verify_by_email.php?
        //                 username=".$username."&verify_code=".$member_verify_code.">
        //                 คลิกเพื่อยันยัน</a>" ; 
        
        // mail($to, $subject, $body,$headers) ; 

        $to      = $email;
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: webmaster@example.com'       . "\r\n" .
                     'Reply-To: webmaster@example.com' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();
    
        mail($to, $subject, $message, $headers);
    }
    
  

?>