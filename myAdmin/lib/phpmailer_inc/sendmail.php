<?

### INCLUDE PHPMAILER ����� ###
include ("class.phpmailer.php");

### FUNCTION SEND MAIL ####

function scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text) {

$mail = new PHPMailer();
$mail -> From     = $email_user_send;
$mail -> FromName = $from_name;

$mail -> AddAddress($to_email,$to_name);
$mail -> Subject	= $subject;
$mail -> Body		= $body_html;
$mail -> AltBody	= $body_text;
$mail -> IsHTML (true);

$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth		= true;
//$mail->SMTPDebug	= true;
$mail->Username = $email_user_send;
$mail->Password = $email_pass_send;

$mail->Send();
$mail->ClearAddresses();


}
### FUNCTION SEND MAIL ####











#### �������¡�����¡�� Function Ẻ��� #####
$to_name			="���ͧ͢���·ҧ";
$to_email			="email ���·ҧ";
$from_name			="���ͧ͢�س";
$email_user_send	="Gmail �ͧ�س";
$email_pass_send	="���ʼ�ҹ�ͧ Gmail �ͧ�س";
$subject			="��Ǣ�� Email";
$body_html			="�������� HTML";
$body_text			="�������� Text ������";

scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);

echo "�������";

?>