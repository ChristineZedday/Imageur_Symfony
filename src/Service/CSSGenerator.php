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
	public function colorsScssGenere(CSS $css) {

		$path = '../assets/styles/_couleurs.scss';
		$file = fopen($path, 'w');
		if (null !== $css->getCouleurTexte())
	{	fwrite($file,'$textcolor: #'.$css->getCouleurTexte().';');}
	if (null !== $css->getCouleurFond())
	{	fwrite($file,'$bgcolor: #'.$css->getCouleurFond().';');}
	if (null !== $css->getCouleurTitre1())
	{	fwrite($file,'$title1: #'.$css->getCouleurTitre1().';');}
	if (null !== $css->getCouleurTitre2())
	{	fwrite($file,'$title2: #'.$css->getCouleurTitre2().';');}
	if (null !== $css->getCouleurAcote())
	{	fwrite($file,'$aside: #'.$css->getCouleurAcote().';');}
	if (null !== $css->getCouleurLiensVisites())
	{	fwrite($file,'$visited: #'.$css->getCouleurLiensVisites().';');}
	if (null !== $css->getCouleurFondSommaire())
	{	fwrite($file,'$bgsom: #'.$css->getCouleurFondSommaire().';');}
	if (null !== $css->getCouleurTexteSommaire())
	{	fwrite($file,'$colorsom: #'.$css->getCouleurTexteSommaire().';');}
fclose($file);
	

		

	}
}