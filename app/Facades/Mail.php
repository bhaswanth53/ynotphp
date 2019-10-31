<?php

    namespace Facades;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mail 
    {
        public $subject = "";
        public $body = "";
        public $altbody = "";
		public $args = array();
        public $from_email = "";
        public $from_name = "";
        public $reply_to = array();
        public $to = array();
        public $html = true;
        public $cc = "";
        public $bcc = "";
        public $files = array();
        public $errorInfo = "";

        public function send()
        {
            $body = $this->render_view("../views/mails/" . $this->body . ".php", $this->args);

            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;  
                if(email("MAIL_DRIVER") == "smtp")
                {                                     
                    $mail->isSMTP();       
                }                                     
                $mail->Host       = email("MAIL_HOST");  
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = email("MAIL_USERNAME");                     
                $mail->Password   = email("MAIL_PASSWORD");                               
                $mail->SMTPSecure = email("MAIL_ENCRYPTION");                                  
                $mail->Port       = email("MAIL_PORT");                                    

                //Recipients
                $mail->setFrom($this->from_email, $this->from_email);

                if(isset($this->to))
                {
                    foreach($this->to as $item)
                    {
                        $mail->addAddress($item['email'], $item['name']);     // Add a recipient
                    }
                }

                if(isset($this->reply_to) && count($this->reply_to) > 1)
                {
                    $mail->addReplyTo($this->reply_to['email'], $this->reply_to['name']);
                }

                if(isset($this->cc) && !empty($this->cc))
                {
                    $mail->addCC($this->cc);
                }

                if(isset($this->bcc) && !empty($this->bcc))
                {
                    $mail->addBCC($this->bcc);
                }

                if(isset($this->replyTo) && count($this->replyTo) > 0)
                {
                    $mail->addReplyTo($this->replyTo['email'], $this->replyTo['name']);
                }

                // Attachments
                if(isset($this->files) && count($this->files))
                {
                    foreach($this->files as $item)
                    {
                        $mail->addAttachment($item['file'], $item['name']);    // Optional name
                    }
                }

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $this->subject;
                $mail->Body    = $body;

                if(isset($this->altbody) && !empty($this->altbody))
                {
                    $mail->AltBody = $this->altbody;
                }

                if($mail->send())
                {
                    return true;
                }

                return false;
                
            } catch (Exception $e) {
                // return $e;
                return false;
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                // $this->ErrorInfo = $mail->ErrorInfo;
                // throw new Exception($this->ErrorInfo);
            }
        }

        public function addReceiver($email, $name)
        {
            $data = array(
                "email" => $email,
                "name" => $name
            );
            array_push($this->to, $data);
            return true;
        }

        public function addSender($email, $name)
        {
            $this->from_email = $email;
            $this->from_name = $name;
            return true;
        }

        public function addReply($email, $name)
        {
            $data = array(
                "email" => $email,
                "name" => $name
            );
            array_push($this->replyTo, $data);
            return true;
        }

        public function addFile($file, $name)
        {
            $data = array(
                "file" => $file,
                "name" => $name
            );
            $this->replyTo = $data;
            return true;
        }

        public function render_view($path, array $args)
		{
			ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
        }
    }