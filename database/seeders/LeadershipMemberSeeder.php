<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeadershipMember;

class LeadershipMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Tendai Moyo',
                'position' => 'Chairman and CEO',
                'image' => 'images/leadership/member1.jpg',
                'description' => 'Visionary leader with extensive experience in digital transformation',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'position' => 'Chief Technology Officer',
                'image' => 'images/leadership/member2.jpg',
                'description' => 'Technology expert driving innovation across all platforms',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Michael Chen',
                'position' => 'Chief Financial Officer',
                'image' => 'images/leadership/member3.jpg',
                'description' => 'Financial strategist with global market expertise',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Emma Rodriguez',
                'position' => 'Chief Marketing Officer',
                'image' => 'images/leadership/member4.jpg',
                'description' => 'Brand strategist focused on digital growth and engagement',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'David Wilson',
                'position' => 'Chief Operations Officer',
                'image' => 'images/leadership/member5.jpg',
                'description' => 'Operations expert ensuring smooth business processes',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Lisa Anderson',
                'position' => 'Head of Human Resources',
                'image' => 'images/leadership/member6.jpg',
                'description' => 'HR leader focused on talent development and culture',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'James Brown',
                'position' => 'Chief Legal Officer',
                'image' => 'images/leadership/member7.jpg',
                'description' => 'Legal expert ensuring compliance and risk management',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Maria Garcia',
                'position' => 'Chief Innovation Officer',
                'image' => 'images/leadership/member8.jpg',
                'description' => 'Innovation leader driving digital transformation initiatives',
                'order' => 8,
                'is_active' => true,
            ]
        ];

        foreach ($members as $member) {
            LeadershipMember::create($member);
        }
    }
}
