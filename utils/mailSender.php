<?php
class MailSender
{
    public function sendMail($mailto, $message, $subject)
    {

        $separator = md5(time());

        // carriage return type (RFC)
        $eol = "\r\n";

        // main header (multipart mandatory)
        $headers = "From: name <test@test.com>" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol;

        // message
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol;
        $body .= $message . $eol;
        $body .= "--" . $separator . $eol;
        $body .= "--" . $separator . "--";


        //SEND Mail
        if (mail($mailto, $subject, $body, $headers)) {
            echo "mail send ... OK";
        } else {
            echo "mail send ... ERROR!";
            print_r(error_get_last());
        }
    }
}
