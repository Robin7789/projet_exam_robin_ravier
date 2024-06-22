<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class StringToFileTransformer implements DataTransformerInterface
{
    private $uploadPath;

    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    public function transform($value)
    {
        if (null === $value || $value instanceof File) {
            return $value;
        }

        // Handle the case where the value is already a string (existing image path)
        return new File($this->uploadPath . '/' . $value);
    }

    public function reverseTransform($value)
    {
        if ($value instanceof File) {
            return $value->getFilename();
        }

        return $value;
    }
}
