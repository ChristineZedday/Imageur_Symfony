<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

class Footer
 {
	public function genereFooter($dir, $footerText)
    {
        $path = $dir.'/footer.php';
        $footerFile = fopen($path, 'w');
		

        fwrite($footerFile, '<footer><p>Cette page a été générée automatiquement par <a href="https://github.com/christinezedday/Imageur_Symfony">Imageur</a></p>'.$footerText.'</footer>');
       
        fclose($footerFile);
    }

}