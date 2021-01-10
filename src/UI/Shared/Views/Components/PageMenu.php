<?php declare(strict_types=1);

namespace App\UI\Shared\Views\Components;


final class PageMenu
{
    public function getMenuItems() : array
    {
        return [
            '' => [
                ['label' => 'Accueil', 'href' => null, 'icon' => null],
                ['label' => 'Contact', 'href' => null, 'icon' => null],
            ],
        ];
    }
}
