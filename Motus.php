<?php
namespace Motus;

class Motus
{
    public function check(string $attempt, string $expected): string
    {
        if (strlen($attempt) !== strlen($expected)) {
            return 'Nombre de lettres incorrect';
        }
        $result = [];
        $valids = [];
        for ($i=0; $i<strlen($attempt); $i++) {
            if ($attempt[$i] === $expected[$i]) {
                $result[] = '🟩';
                $valids[] = $attempt[$i];
            } else {
                $result[] = '🟦';
            }
        }
        var_dump($valids);
        $nbYellowInResult = [];
        for ($i=0; $i<strlen($attempt); $i++) {
            if ($attempt[$i] !== $expected[$i]) {
                if (!in_array($attempt[$i], $valids)) {
                    if (in_array($attempt[$i], str_split($expected))) {
                        $nbYellowInResult[$attempt[$i]] = $nbYellowInResult[$attempt[$i]] ?? 1;
                        if ($nbYellowInResult[$attempt[$i]] <= array_count_values(str_split($expected))[$attempt[$i]]) {
                            $result[$i] = '🟡';
                            $nbYellowInResult[$attempt[$i]]++;
                        }
                    }
                }

            }
        }
        return implode($result);
    }
}
