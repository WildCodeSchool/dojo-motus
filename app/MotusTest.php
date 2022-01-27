<?php

namespace App;

use PHPUnit\Framework\TestCase;

class MotusTest extends TestCase
{
    public function testCheckWord()
    {
        $motus = new Motus();
        $this->assertEquals('Nombre de lettres incorrect', $motus->check('MOT', 'MOTUS'));
        $this->assertEquals('🟩', $motus->check('A', 'A'));
        $this->assertEquals('🟩🟩', $motus->check('AS', 'AS'));
        $this->assertEquals('🟦', $motus->check('B', 'A'));
        $this->assertEquals('🟦🟦', $motus->check('BI', 'AS'));
        $this->assertEquals('🟦🟩🟦', $motus->check('MER', 'TEK'));
        $this->assertEquals('🟩🟩🟩🟩🟩', $motus->check('MOTUS', 'MOTUS'));
        $this->assertEquals('🟦🟦🟦🟦🟦', $motus->check('CARRE', 'MOTUS'));
        $this->assertEquals('🟡🟡', $motus->check('NU', 'UN'));
        $this->assertEquals('🟡🟩🟩🟩🟦', $motus->check('SOTUA', 'MOTUS'));
//        //these following tests should be bonus : handle juste ONE yellow by occurence
        $this->assertEquals('🟡🟦🟦', $motus->check('TTA', 'MOT'));
        $this->assertEquals('🟦🟦🟩🟦🟦', $motus->check('TTTTT', 'MOTUS'));
        $this->assertEquals('🟡🟡🟡🟦🟩🟡🟩🟦', $motus->check('CHISINAU', 'MICHIGAN'));
        $this->assertEquals('🟩🟡🟦🟦🟩🟦🟡🟦', $motus->check('MALAISIE', 'MICHIGAN'));
        $this->assertEquals('🟩🟡🟦🟦🟩🟦🟡🟦', $motus->check('MASSILIA', 'MICHIGAN'));
        $this->assertEquals('🟦🟡🟦🟦🟦🟩🟦🟡', $motus->check('NAGASAKI', 'TITICACA'));
    }
}
