<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $books = [
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'stok' => 15,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'stok' => 10,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'Harry Potter and the Philosopher\'s Stone',
                'penulis' => 'J.K. Rowling',
                'penerbit' => 'Bloomsbury',
                'stok' => 20,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'To Kill a Mockingbird',
                'penulis' => 'Harper Lee',
                'penerbit' => 'J. B. Lippincott & Co.',
                'stok' => 12,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => '1984',
                'penulis' => 'George Orwell',
                'penerbit' => 'Secker & Warburg',
                'stok' => 18,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'The Great Gatsby',
                'penulis' => 'F. Scott Fitzgerald',
                'penerbit' => 'Charles Scribner\'s Sons',
                'stok' => 22,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'Pride and Prejudice',
                'penulis' => 'Jane Austen',
                'penerbit' => 'T. Egerton, Whitehall',
                'stok' => 16,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'The Catcher in the Rye',
                'penulis' => 'J.D. Salinger',
                'penerbit' => 'Little, Brown and Company',
                'stok' => 14,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'To the Lighthouse',
                'penulis' => 'Virginia Woolf',
                'penerbit' => 'The Hogarth Press',
                'stok' => 9,
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'Crime and Punishment',
                'penulis' => 'Fyodor Dostoevsky',
                'penerbit' => 'The Russian Messenger',
                'stok' => 11,
                'tahun_terbit' => 2018,
            ],
        ];

        DB::table('buku')->insert($books);
    }
}
