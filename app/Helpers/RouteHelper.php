<?php

namespace App\Helpers;

class RouteHelper
{
    /**
     * Get all available routes with their color coding
     */
    public static function getRoutes()
    {
        return [
            'line1' => [
                'name' => 'Line 1',
                'color' => 'red',
                'description' => 'Jurisdiction - Magapit Route',
            ],
            'line2' => [
                'name' => 'Line 2',
                'color' => 'orange',
                'description' => 'Public Market/Cagoran-Binag - Sta. Teresa & Cambong',
            ],
            'line3' => [
                'name' => 'Line 3',
                'color' => 'blue',
                'description' => 'Magapit-Dagupan',
            ],
            'line4' => [
                'name' => 'Line 4',
                'color' => 'green',
                'description' => 'Junction-Sta. Maria Route',
            ],
            'line5' => [
                'name' => 'Line 5',
                'color' => 'yellow',
                'description' => 'Junction San Lorenzo - Malanao',
            ],
            'line6' => [
                'name' => 'Line 6',
                'color' => 'white',
                'description' => 'Junction Magapit - Cabayabasan via Logac',
            ],
            'line7' => [
                'name' => 'Line 7',
                'color' => 'brown',
                'description' => 'Public Market - Dalaya & Paranum Route',
            ],
            'line8' => [
                'name' => 'Line 8',
                'color' => 'violet',
                'description' => 'Abagao-San Juan-Bical & Fusina Route',
            ],
        ];
    }

    /**
     * Get a specific route by key
     */
    public static function getRoute($key)
    {
        $routes = self::getRoutes();
        return $routes[$key] ?? null;
    }

    /**
     * Get the color for a route
     */
    public static function getRouteColor($key)
    {
        $route = self::getRoute($key);
        return $route ? $route['color'] : null;
    }

    /**
     * Get the description for a route
     */
    public static function getRouteDescription($key)
    {
        $route = self::getRoute($key);
        return $route ? $route['description'] : null;
    }

    /**
     * Get color code for tailwind/display purposes
     */
    public static function getTailwindColorClass($color)
    {
        $colorMap = [
            'red' => 'bg-red-100 border-red-300 text-red-800',
            'orange' => 'bg-orange-100 border-orange-300 text-orange-800',
            'blue' => 'bg-blue-100 border-blue-300 text-blue-800',
            'green' => 'bg-green-100 border-green-300 text-green-800',
            'yellow' => 'bg-yellow-100 border-yellow-300 text-yellow-800',
            'white' => 'bg-gray-100 border-gray-300 text-gray-800',
            'brown' => 'bg-amber-100 border-amber-300 text-amber-800',
            'violet' => 'bg-violet-100 border-violet-300 text-violet-800',
        ];

        return $colorMap[$color] ?? 'bg-gray-100 border-gray-300 text-gray-800';
    }
}
