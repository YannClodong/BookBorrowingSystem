<?php

namespace App\Models;

enum GenreStyle : string
{
    case primary = 'primary';
    case secondary = 'secondary';
    case success = 'success';
    case danger = 'danger';
    case warning = 'warning';
    case info = 'info';
    case light = 'light';
    case dark = 'dark';

    public static function GetValues(): array {
        return [
            'primary',
            'secondary',
            'success',
            'danger',
            'warning',
            'info',
            'light',
            'dark'
        ];
    }
}
