<?php

namespace App\Repository\Contracts;

interface NewInterface
{
    function getArticles(array $params) : array | string;
}
