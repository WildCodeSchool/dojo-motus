<?php
namespace App;

class Motus
{
    private $attempt;

    private $expected;

    private $expecteds;

    private $countLetters;

    private $aways;

    private $firstCountValids = [];

    public function check(string $attempt, string $expected): string
    {
        $this->attempt = $attempt;
        $this->expected = $expected;
        $this->expecteds = str_split($expected);
        $this->countLetters = array_count_values($this->expecteds);
        $this->aways = $this->buildKeysFromLetters();
        $this->firstCountValids = $this->buildKeysFromLetters();
        $this->firstCountValidsLetter();
        if (strlen($attempt) !== strlen($expected)) {
            return 'Nombre de lettres incorrect';
        }
        $result = '';
        for ($i = 0; $i < strlen($attempt); $i++) {
            $result .= $this->letterToColor($attempt[$i], $i);
        }
        return $result;
    }

    public function firstCountValidsLetter(): void
    {
        for ($i = 0; $i < strlen($this->attempt); $i++) {
            if ($this->attempt[$i] === $this->expected[$i]) {
                $this->firstCountValids[$this->attempt[$i]]++;
            }
        }
    }

    public function buildKeysFromLetters()
    {
        $result = [];
        foreach ($this->expecteds as $letter) {
            $result[$letter] = 0;
        }
        return $result;
    }

    public function letterToColor(string $letter, $position)
    {
        if ($letter === $this->expected[$position]) {
            $result = '🟩';
   //         $this->valids[$letter]++;
        } elseif (in_array($letter, $this->expecteds)) {
            $result = $this->checkIfYellowOrBlue($letter);
        } else {
            $result = '🟦';
        }
        return $result;
    }

    public function checkIfYellowOrBlue(string $letter)
    {
        if ($this->notMoreAwayThanTotal($letter) && $this->notMoreGreenThanTotal($letter)) {
            $this->aways[$letter]++;
            return '🟡';
        } else {
            return '🟦';
        }
    }

    public function notMoreAwayThanTotal($letter)
    {
        return $this->aways[$letter] < $this->countLetters[$letter];
    }

    public function notMoreGreenThanTotal($letter)
    {
        $result = false;
        if ($this->firstCountValids[$letter] < $this->aways[$letter] + $this->countLetters[$letter]) {
            $result = true;
        }
        return $result;
    }

    public function hasOneOccurence($letter): bool
    {
        return $this->countLetters[$letter] === 1;
    }

}
