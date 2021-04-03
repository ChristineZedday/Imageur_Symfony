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
		

        fwrite($footerFile, '<footer><p>'.$footerText.'</p></footer>');
       
        fclose($footerFile);
    }

}