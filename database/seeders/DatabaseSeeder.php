<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\User;
use Carbon\Carbon;
use App\Models\watchlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'genre' => 'Action',
            'slug' => 'Action',
        ]);

        Genre::create([
            'genre' => 'Comedy',
            'slug' => 'Comedy',
        ]);

        Genre::create([
            'genre' => 'Drame',
            'slug' => 'Drame',
        ]);

        Genre::create([
            'genre' => 'Horor',
            'slug' => 'Horor',
        ]);

        Genre::create([
            'genre' => 'Romance',
            'slug' => 'Romance',
        ]);

        Genre::create([
            'genre' => 'Adventure',
            'slug' => 'Adventure',
        ]);

        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'dob' => now(),
            'phone' => '08123456789',   
            'is_admin' => true
        ]);
        User::create([
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'dob' => now(),
            'phone' => '08197654321',   
            'is_admin' => false
        ]);

        User::factory(10)->create();
        Actor::factory(20)->create();
        Movie::factory(40)->create();
        MovieActor::factory(60)->create();
        watchlist::factory(25)->create();
        
        Movie::create([
            'title' => 'Thor: Love and Thunder',
            'slug' => 'Thor-Love-and-Thunder',
            'description' => 'Thor\'s retirement is interrupted by a galactic killer known as Gorr the God Butcher, who seeks the extinction of the gods. To combat the threat, Thor enlists the help of King Valkyrie, Korg and ex-girlfriend Jane Foster, who - to Thor\'s surprise - inexplicably wields his magical hammer, Mjolnir, as the Mighty Thor. Together, they embark upon a harrowing cosmic adventure to uncover the mystery of the God Butcher\'s vengeance and stop him before it\'s too late.',
            'genre_id' => '5',
            'director' => 'Taika Waititi',
            'release_date' => '2022-06-06',
            'thumbnail' => 'thor_love_thumbnail.jpg',
            'background' => 'thor_love_banner.png',
            'created_at' => Carbon::now()->addHour(1),
        ]);
        Movie::create([
            'title' => 'Doctor Strange in the Multiverse of Madness',
            'slug' => 'Doctor-Strange-in-the-Multiverse-of-Madness',
            'description' => 'Following the events of Spider-Man No Way Home, Doctor Strange unwittingly casts a forbidden spell that accidentally opens up the multiverse. With help from Wong and Scarlet Witch, Strange confronts various versions of himself as well as teaming up with the young America Chavez while traveling through various realities and working to restore reality as he knows it. Along the way, Strange and his allies realize they must take on a powerful new adversary who seeks to take over the multiverse.',
            'genre_id' => '1',
            'director' => 'Sam Raimi',
            'release_date' => '2022-05-05',
            'thumbnail' => 'doctor_thumbnail.jpg',
            'background' => 'doctor_banner.jpg',
            'created_at' => Carbon::now()->addHour(2),
        ]);
        Movie::create([
            'title' => 'Black Panther: Wakanda Forever',
            'slug' => 'Black-Panther-Wakanda-Forever',
            'description' => 'Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect the kingdom of Wakanda from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with the help of War Dog Nakia and Everett Ross and forge a new path for their nation.',
            'genre_id' => '6',
            'director' => 'Ryan Coogler',
            'release_date' => '2022-09-09',
            'thumbnail' => 'wakanda_thumbnail.webp',
            'background' => 'wakanda_banner.jpg',
            'created_at' => Carbon::now()->addHour(3),
        ]);
    }
}
