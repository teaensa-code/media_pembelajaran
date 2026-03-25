<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Material;
use App\Models\Video;
use App\Models\Task;
use App\Models\Quiz;
use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );

        User::updateOrCreate(
            ['email' => 'guru@example.com'],
            [
                'name' => 'Guru',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
            ]
        );

        // Create materials
        Material::firstOrCreate(['title' => 'Materi 1: Pengenalan PHP'], [
            'description' => 'Dasar-dasar PHP untuk pemula',
        ]);

        Material::firstOrCreate(['title' => 'Materi 2: Variabel dan Tipe Data'], [
            'description' => 'Pembelajaran tentang variabel dan tipe data di PHP',
        ]);

        // Create videos
        Video::firstOrCreate(['title' => 'Video 1: Tutorial PHP Dasar'], [
            'description' => 'Video pembelajaran PHP dari dasar',
            'video_link' => 'https://www.youtube.com/watch?v=YOUR_VIDEO_ID_1',
        ]);

        Video::firstOrCreate(['title' => 'Video 2: Loop dan Kondisi'], [
            'description' => 'Video tentang perulangan dan kondisional di PHP',
            'video_link' => 'https://www.youtube.com/watch?v=YOUR_VIDEO_ID_2',
        ]);

        // Create tasks
        Task::firstOrCreate(['title' => 'Tugas 1: Buat Program Sederhana'], [
            'description' => 'Buat program PHP sederhana sesuai dengan materi',
        ]);

        Task::firstOrCreate(['title' => 'Tugas 2: Analisis Kode'], [
            'description' => 'Analisis dan jelaskan kode PHP yang diberikan',
        ]);

        // Create quizzes
        Quiz::firstOrCreate(['title' => 'Kuis 1: PHP Basics'], [
            'description' => 'Kuis tentang dasar-dasar PHP',
            'link' => 'https://forms.gle/quiz-example-1',
        ]);

        Quiz::firstOrCreate(['title' => 'Kuis 2: Functions'], [
            'description' => 'Kuis tentang fungsi-fungsi di PHP',
            'link' => 'https://forms.gle/quiz-example-2',
        ]);

        // Create games
        Game::firstOrCreate(['title' => 'Game 1: Quiz Game'], [
            'description' => 'Game kuis interaktif untuk pembelajaran',
            'link' => 'https://example.com/quiz-game',
        ]);

        Game::firstOrCreate(['title' => 'Game 2: Puzzle PHP'], [
            'description' => 'Game puzzle untuk memperkuat pemahaman PHP',
            'link' => 'https://example.com/puzzle-game',
        ]);
    }
}
