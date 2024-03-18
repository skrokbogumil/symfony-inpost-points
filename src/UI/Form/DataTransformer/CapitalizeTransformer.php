<?php
declare(strict_types=1);

namespace App\UI\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class CapitalizeTransformer implements DataTransformerInterface
{

    public function transform($word): string
    {
        return $word;
    }

    public function reverseTransform($word): ?string
    {
        if (null === $word || \strlen($word) === 0) {
            return $word;
        }
        return $this->mbUcfirst($word);
    }

    private function mbUcfirst(string $str) {
        $fc = \mb_strtoupper(\mb_substr($str, 0, 1));
        return $fc.\mb_substr(\mb_strtolower($str), 1);
    }
}