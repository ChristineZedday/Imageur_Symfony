<?php
namespace App\tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Section;

class SectionTest extends TestCase
{
	public function testGetRang() 
	{
		$section = new Section();
		$result = $section->getRang();
		$this->assertSame(null,$result);
	}
}