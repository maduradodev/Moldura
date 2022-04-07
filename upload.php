<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once 'includes/common.php';
	require_once 'includes/database.php';
	require_once('src/PHPMailer.php');
	require_once('src/SMTP.php');
	require_once('src/Exception.php');
	
	define('UPLOAD_DIR', 'cadastro/');

	//Pega a imagem do canvas a partir do javascript e converte ela pra PNG pra inserir no $file
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);

	$result = [
		'success' => TRUE,
		'msg' => ''
	];

	if (!$success) {
		$result['success'] = FALSE;
		$result['msg'] = 'Unable to save the file.';
	}
	else {
		$user_id = $_SESSION['user_id'];
		$sql = "UPDATE cadastro_webcam SET picture = '{$file}' WHERE id = {$user_id}";

		if ($conn->query($sql) === TRUE) {
			try {
				$mail = new PHPMailer;
				$mail->isHTML(true); // Deixar true se for usar o email_template (usa $SESSION)
				$mail->CharSet = 'UTF-8';
				$mail->setFrom('contato@madurado.tech', 'NO_REPLY_TOTEM_FOTO'); // From
				$mail->addBCC('congresso_otorrino_self@jardimeletrico.com.br', 'Congresso Otorrino');
				$mail->AddAddress($_SESSION['email']); // To
				$mail->ClearReplyTos();
    			$mail->addReplyTo('congresso_otorrino_self@jardimeletrico.com.br', 'Congresso Otorrino');
				$mail->Subject = "Totem Foto"; // Assunto
				$mail->addAttachment($file); // $file é a imagem
				

				ob_start();
				include 'email_template.php'; // Estrutura do Email
				$mail->Body = ob_get_clean();

				$mail->send();
				session_destroy();
			} catch (Exception $e) {
				$result['success'] = FALSE;
				$result['msg'] ="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		} else {
			$result['success'] = FALSE;
			$result['msg'] = $conn->error;
		}
	}
	
	echo json_encode($result);
	exit();
?>