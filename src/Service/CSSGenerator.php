<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Service;

use App\Entity\CSS;

class CSSGenerator
{
    public function colorsScssGenere(CSS $css)
    {
        $path = '../assets/styles/_couleurs.scss';
        $file = fopen($path, 'w');
        if (null !== $css->getCouleurTexte()) {
            fwrite($file, '$textcolor: #'.$css->getCouleurTexte().';');
        } else {
            fwrite($file, '$textcolor: #000000;');
        }
        if (null !== $css->getCouleurFond()) {
            fwrite($file, '$bgcolor: #'.$css->getCouleurFond().';');
        } else {
            fwrite($file, '$bgcolor: #FFFFFF;');
        }
        if (null !== $css->getCouleurTitre1()) {
            fwrite($file, '$title1: #'.$css->getCouleurTitre1().';');
        } else {
            fwrite($file, '$title1: #000000;');
        }
        if (null !== $css->getCouleurTitre2()) {
            fwrite($file, '$title2: #'.$css->getCouleurTitre2().';');
        } else {
            fwrite($file, '$title2: #000000;');
        }

        if (null !== $css->getCouleurAcote()) {
            fwrite($file, '$aside: #'.$css->getCouleurAcote().';');
        } else {
            fwrite($file, '$aside: #FFFFFF;');
        }
        if (null !== $css->getCouleurLiens()) {
            fwrite($file, '$links: #'.$css->getCouleurLiens().';');
        } else {
            fwrite($file, '$links: #000000;');
        }
        if (null !== $css->getCouleurLiensSommaire()) {
            fwrite($file, '$linksom: #'.$css->getCouleurLiensSommaire().';');
        } else {
            fwrite($file, '$linksom: #000000;');
        }
        if (null !== $css->getCouleurLiensVisites()) {
            fwrite($file, '$visited: #'.$css->getCouleurLiensVisites().';');
        } else {
            fwrite($file, '$visited: #000000;');
        }
        if (null !== $css->getCouleurLiensVisitesSommaire()) {
            fwrite($file, '$visitedsom: #'.$css->getCouleurLiensVisitesSommaire().';');
        } else {
            fwrite($file, '$visitedsom: #000000;');
        }
        if (null !== $css->getCouleurFondSommaire()) {
            fwrite($file, '$bgsom: #'.$css->getCouleurFondSommaire().';');
        } else {
            fwrite($file, '$bgsom: #FFFFFF;');
        }
        if (null !== $css->getCouleurTexteSommaire()) {
            fwrite($file, '$colorsom: #'.$css->getCouleurTexteSommaire().';');
        } else {
            fwrite($file, '$colorsom: #000000;');
        }
        if (null !== $css->getCouleurTexteAcote()) {
            fwrite($file, '$coloraside: #'.$css->getCouleurTexteAcote().';');
        } else {
            fwrite($file, '$coloraside: #000000;');
        }
		if (null !== $css->getCouleurTitreAcote()) {
            fwrite($file, '$colortitleaside: #'.$css->getCouleurTitreAcote().';');
        } else {
            fwrite($file, '$colortitleaside: #000000;');
        }
		if (null !== $css->getCouleurTitre3()) {
            fwrite($file, '$title3: #'.$css->getCouleurTitre3().';');
        } else {
            fwrite($file, '$title3: #000000;');
        }
        fclose($file);
    }

	public function fontScssGenere(CSS $css) 
	{
		if (null !== $css->getPoliceTexte()) {
            fwrite($file, '$principale: '.$css->getPoliceTexte().';');
        } else {
            fwrite($file, '$principale: sans-serif;');
        }
		if (null !== $css->getPoliceTitre1()) {
            fwrite($file, '$fonth1: '.$css->getPoliceTitre1().';');
        } else {
            fwrite($file, '$fonth1: serif;');
        }
		if (null !== $css->getPoliceTitre2()) {
            fwrite($file, '$fonth2: '.$css->getPoliceTitre2().';');
        } else {
            fwrite($file, '$fonth2: serif;');
        }
		if (null !== $css->getPoliceTitre3()) {
            fwrite($file, '$fonth3: '.$css->getPoliceTitre3().';');
        } else {
            fwrite($file, '$fonth3: sans-serif;');
        }
	}
}
