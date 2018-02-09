<?php

namespace Mikkellindblom\Utilities\JavaScript\Transformers;

class DefaultTransformer
{
    public function transform($value)
    {
        return json_encode($value);
    }
}
