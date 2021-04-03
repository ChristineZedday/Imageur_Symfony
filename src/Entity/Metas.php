<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;


class Metas
{

	public function genereMetas($dir)
    {
        $path = $dir.'/metas.php';
        $metasFile = fopen($path, 'w');
		

        fwrite($metasFile, '<META charset="utf-8"/><META name="viewport" content="width=device-width" />');
		fwrite($metasFile, '<liNK href="../ressources/css/app.css" rel="stylesheet" type="text/css">');
       
        fclose($metasFile);
    }
}
	

