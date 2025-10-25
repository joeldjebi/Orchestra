<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactInfo;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInfo::create([
            'title' => 'Contact Us',
            'address' => '123 Innovation Drive, Tech Park, City, State, Zip Code',
            'phone' => '(123) 456 7890',
            'email' => 'contact@orchestra.com',
            'office_hours' => [
                'Monday - Friday' => '9:00 AM - 5:00 PM',
                'Saturday' => '10:00 AM - 2:00 PM',
                'Sunday' => 'Closed'
            ],
            'image' => 'images/contact/contact1.jpg',
            'is_active' => true,
        ]);
    }
}
