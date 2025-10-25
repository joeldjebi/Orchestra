<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Value;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'title' => 'Innovation',
                'description' => 'We believe in pushing the boundaries of what\'s possible through cutting-edge technology and creative thinking.',
                'icon' => 'fas fa-lightbulb',
                'details' => [
                    'Continuous learning and adaptation',
                    'Embracing new technologies',
                    'Creative problem-solving approaches',
                    'Future-focused solutions'
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Excellence',
                'description' => 'We strive for the highest standards in everything we do, delivering exceptional results for our clients.',
                'icon' => 'fas fa-star',
                'details' => [
                    'Quality-driven processes',
                    'Attention to detail',
                    'Continuous improvement',
                    'Client satisfaction focus'
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Integrity',
                'description' => 'We operate with honesty, transparency, and ethical practices in all our business relationships.',
                'icon' => 'fas fa-shield-alt',
                'details' => [
                    'Transparent communication',
                    'Ethical business practices',
                    'Trust-building relationships',
                    'Accountable actions'
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Collaboration',
                'description' => 'We believe in the power of teamwork and partnership to achieve greater success together.',
                'icon' => 'fas fa-users',
                'details' => [
                    'Team-oriented approach',
                    'Cross-functional partnerships',
                    'Knowledge sharing',
                    'Collective success'
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Impact',
                'description' => 'We are committed to creating positive change and meaningful impact in the communities we serve.',
                'icon' => 'fas fa-globe-africa',
                'details' => [
                    'Social responsibility',
                    'Community development',
                    'Sustainable practices',
                    'Positive change creation'
                ],
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Growth',
                'description' => 'We foster continuous growth and development for our team, clients, and the communities we serve.',
                'icon' => 'fas fa-chart-line',
                'details' => [
                    'Personal development',
                    'Professional advancement',
                    'Client success',
                    'Organizational growth'
                ],
                'order' => 6,
                'is_active' => true,
            ]
        ];

        foreach ($values as $value) {
            Value::create($value);
        }
    }
}
