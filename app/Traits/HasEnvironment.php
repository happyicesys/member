<?php

namespace App\Traits;

trait HasEnvironment
{
    public function isProduction()
    {
        return $this->getEnvironment() === 'production';
    }

    private function getEnvironment()
    {
        return config('app.env');
    }
}