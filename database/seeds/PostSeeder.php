<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table("posts")->insert([
            "title" => "Juca Data Structure",
            "subtitle" => "Learn about this new concept of data's structures",
            "slug" => "juca-data-structure",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida interdum fermentum. Maecenas justo nunc, gravida eget ultrices ut, posuere in massa. Fusce euismod elit et velit tincidunt finibus ut ut magna. Mauris vitae sapien urna. Sed quis elit eu quam iaculis pretium non ut ligula. Aliquam eget convallis erat. Nulla lectus eros, dapibus eu enim non, tristique pretium odio. Ut varius rutrum condimentum. Mauris eu egestas turpis, ut placerat ante. Donec justo lorem, viverra sit amet bibendum a, dignissim eget risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida interdum fermentum. Maecenas justo nunc, gravida eget ultrices ut, posuere in massa. Fusce euismod elit et velit tincidunt finibus ut ut magna. Mauris vitae sapien urna. Sed quis elit eu quam iaculis pretium non ut ligula. Aliquam eget convallis erat. Nulla lectus eros, dapibus eu enim non, tristique pretium odio. Ut varius rutrum condimentum. Mauris eu egestas turpis, ut placerat ante. Donec justo lorem, viverra sit amet bibendum a, dignissim eget risus.",
            "user_id" => "1",
            "category_id" => "1",
            "thumbnail" => "https://www.educative.io/cdn-cgi/image/f=auto,fit=contain,w=1200/api/page/5323562194829312/image/download/4539157721382912",
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table("posts")->insert([
            "title" => "Juca Programming Language",
            "subtitle" => "Learn about this new programming language",
            "slug" => "juca-programming-language",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida interdum fermentum. Maecenas justo nunc, gravida eget ultrices ut, posuere in massa. Fusce euismod elit et velit tincidunt finibus ut ut magna. Mauris vitae sapien urna. Sed quis elit eu quam iaculis pretium non ut ligula. Aliquam eget convallis erat. Nulla lectus eros, dapibus eu enim non, tristique pretium odio. Ut varius rutrum condimentum. Mauris eu egestas turpis, ut placerat ante. Donec justo lorem, viverra sit amet bibendum a, dignissim eget risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida interdum fermentum. Maecenas justo nunc, gravida eget ultrices ut, posuere in massa. Fusce euismod elit et velit tincidunt finibus ut ut magna. Mauris vitae sapien urna. Sed quis elit eu quam iaculis pretium non ut ligula. Aliquam eget convallis erat. Nulla lectus eros, dapibus eu enim non, tristique pretium odio. Ut varius rutrum condimentum. Mauris eu egestas turpis, ut placerat ante. Donec justo lorem, viverra sit amet bibendum a, dignissim eget risus.",
            "user_id" => "2",
            "category_id" => "1",
            "thumbnail" => "https://savvytower.com/wp-content/uploads/2020/05/Generations-Of-Programming-Languages.jpg",
            "deleted" => "t",
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}