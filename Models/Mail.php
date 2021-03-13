<?php


namespace App\Models;


class Mail
{
    private $header;
    private $to;
    private $subject = 'Récupération de mot de passe';
    private $message = '';

    function __construct($to,$code,$name)
    {
        $this->to = $to;
        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';

        // En-têtes additionnels
        $headers[] = 'To: '.$this->to;
        $this->header = $headers;
        $this->message = '
                     <html>
                      <head>
                       <title>Récupération de mot de passe</title>
                      </head>
                      <body>
                       <h1>Bonjour '.$name.' !</h1>
                       <p>Voici le code <strong>'.$code.'</strong> pour le changement de votre mot de passe Hohohot ! 
                       Il expirera d\'ici 5 minutes à la reception de se mail.</p>
                       <p>Cliquez <a href="hohohot/user/verifyToken">ici</a> pour changer votre mot de passe</p>
                      </body>
                     </html>
                     ';
    }

    public function send()
    {
        return mail($this->to, $this->subject, $this->message, implode("\r\n", $this->header));
    }
}