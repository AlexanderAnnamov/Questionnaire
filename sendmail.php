<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpMailer/src/Exception.php';
    require 'phpMailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpMailer/language/');
    $mail->IsHTML(true);

    $mail->setFrom('hash_nam@mail.ru', 'яяяяяяяяяя');

    $mail->addAddress('pozdorovaites@mail.ru');

    $mail->Subject = 'тема письма';

    // $hand = "правая";
    // if($_POST['hand'] == "left"){
    //     $hand = "Левая";
    // }

    $body = '<h1>jnijjinjninijnin!</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$POST['name'].'</p>';
    }
    if(trim(!empty($_POST['mail']))){
        $body.='<p><strong>Email:</strong> '.$POST['mail'].'</p>';
    }
    // if(trim(!empty($_POST['hand']))){
    //     $body.='<p><strong>Рука:</strong> '.$hand.'</p>';
    // }
    if(trim(!empty($_POST['age']))){
        $body.='<p><strong>Возвраст:</strong> '.$POST['age'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Сообщение:</strong> '.$POST['message'].'</p>';
    }

    if (!empty($_FILES['image']['tmp_name'])){

        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];

        if(copy($_FILES['image']['tmp_name'], $filePath)){
            $fileAttach = $filePath;
            $body.='<p><strong>фото</strong>';
            $mail->addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;


    if(!$mail->send()){
        $message = 'Ошибка';
    } else{
        $message = 'Данные отправлены!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);

    
?>