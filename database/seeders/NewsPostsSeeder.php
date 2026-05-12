<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsPostsSeeder extends Seeder
{
    public function run()
    {
        $category = Category::query()->updateOrCreate(
            ['slug' => 'news'],
            ['name' => 'News']
        );

        $items = [
            [
                'title' => 'Port Operations Update: Weekly Highlights',
                'content' => "This week’s port operations brought new service windows and improved berth productivity.\n\nWe continue monitoring arrivals, departures, and safety procedures across terminals.",
            ],
            [
                'title' => 'Weather Advisory and Navigational Guidance',
                'content' => "A mild weather system is expected over the next few days.\n\nMasters and agents are advised to review updated guidance and coordinate with local authorities.",
            ],
            [
                'title' => 'New Compliance Requirements for Cargo Documentation',
                'content' => "Updated documentation requirements are now in effect.\n\nPlease ensure that all cargo paperwork is complete and submitted within the required deadlines.",
            ],
            [
                'title' => 'Safety Bulletin: Best Practices at Berth',
                'content' => "Safety remains our top priority.\n\nThis bulletin summarizes best practices for mooring operations, access control, and incident reporting.",
            ],
            [
                'title' => 'Terminal Schedule Adjustments for the Month',
                'content' => "Some terminal schedules have been adjusted to optimize throughput.\n\nCheck the latest planning notes and confirm your vessel’s slot with the operations team.",
            ],
            [
                'title' => 'Port Community Notice: Service Desk Hours',
                'content' => "The service desk operating hours have been updated.\n\nFor urgent cases, use the emergency contacts available on the website footer.",
            ],
        ];

        foreach ($items as $i => $item) {
            $baseSlug = Str::slug($item['title']);
            $slug = $baseSlug.'-'.($i + 1);

            Post::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'image' => null,
                    'is_published' => true,
                ]
            );
        }
    }
}

