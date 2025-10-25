<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogArticle;

class BlogArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Press',
                'headline' => 'Orchestra is set to guide African businesses into the next era of innovation and growth.',
                'content' => [
                    'paragraph1' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                    'paragraph2' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'paragraph3' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
                    'paragraph4' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.',
                    'paragraph5' => 'Consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.'
                ],
                'sidebar_title' => 'BUSINESS INSIDER AFRICA',
                'image' => 'images/blog/blog1.jpg',
                'layout' => 'left',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Innovation',
                'headline' => 'Digital transformation is reshaping the African business landscape with unprecedented opportunities for growth and innovation.',
                'content' => [
                    'paragraph1' => 'The digital revolution in Africa is creating new pathways for economic development and social progress. Companies are leveraging technology to overcome traditional barriers and reach new markets.',
                    'paragraph2' => 'From mobile payments to e-commerce platforms, African businesses are pioneering innovative solutions that address local challenges while competing on a global scale.',
                    'paragraph3' => 'The integration of artificial intelligence and machine learning is enabling businesses to make data-driven decisions and optimize their operations for maximum efficiency.',
                    'paragraph4' => 'Cloud computing infrastructure is providing scalable solutions for businesses of all sizes, from startups to multinational corporations operating across the continent.',
                    'paragraph5' => 'The future of African business lies in the intersection of technology, innovation, and sustainable development practices that benefit both local communities and global markets.'
                ],
                'sidebar_title' => 'TECH CRUNCH',
                'image' => 'images/blog/blog2.jpg',
                'layout' => 'right',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Growth',
                'headline' => 'African startups are attracting record levels of investment as the continent becomes a global hub for technological innovation and entrepreneurship.',
                'content' => [
                    'paragraph1' => 'Venture capital funding in Africa has reached unprecedented levels, with fintech, healthtech, and edtech sectors leading the investment boom.',
                    'paragraph2' => 'International investors are recognizing the potential of African markets, bringing not only capital but also expertise and global networks to local entrepreneurs.',
                    'paragraph3' => 'The rise of African unicorns demonstrates the continent\'s ability to build world-class companies that can compete with established global players.',
                    'paragraph4' => 'Government policies and regulatory frameworks are evolving to support innovation while ensuring consumer protection and market stability.',
                    'paragraph5' => 'The success of African tech companies is inspiring a new generation of entrepreneurs and creating a vibrant ecosystem of innovation across the continent.'
                ],
                'sidebar_title' => 'FORBES AFRICA',
                'image' => 'images/blog/blog3.jpg',
                'layout' => 'left',
                'order' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($articles as $article) {
            BlogArticle::create($article);
        }
    }
}
