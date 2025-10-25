<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkProject;

class WorkProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkProject::truncate(); // Clear existing records

        $projects = [
            [
                'client' => 'MTN',
                'image' => 'images/work/mtn.jpg',
                'description' => 'Digital transformation for telecommunications',
                'category' => 'Telecommunications',
                'url' => 'https://mtn.com',
                'order' => 1,
                'is_active' => true
            ],
            [
                'client' => 'Unilever',
                'image' => 'images/work/unilever.jpg',
                'description' => 'Brand strategy and digital marketing',
                'category' => 'Consumer Goods',
                'url' => 'https://unilever.com',
                'order' => 2,
                'is_active' => true
            ],
            [
                'client' => 'Canal+',
                'image' => 'images/work/canal.jpg',
                'description' => 'Media platform development',
                'category' => 'Media & Entertainment',
                'url' => 'https://canalplus.com',
                'order' => 3,
                'is_active' => true
            ],
            [
                'client' => 'Orange',
                'image' => 'images/work/orange.jpg',
                'description' => 'Mobile payment solutions',
                'category' => 'Financial Services',
                'url' => 'https://orange.com',
                'order' => 4,
                'is_active' => true
            ],
            [
                'client' => 'Nestlé',
                'image' => 'images/work/nestle.jpg',
                'description' => 'E-commerce platform optimization',
                'category' => 'Food & Beverage',
                'url' => 'https://nestle.com',
                'order' => 5,
                'is_active' => true
            ],
            [
                'client' => 'Total',
                'image' => 'images/work/total.jpg',
                'description' => 'Energy sector digital solutions',
                'category' => 'Energy',
                'url' => 'https://total.com',
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($projects as $project) {
            WorkProject::create($project);
        }
    }
}
