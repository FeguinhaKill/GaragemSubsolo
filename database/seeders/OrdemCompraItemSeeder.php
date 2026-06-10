<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OrdemCompraItem;
use Illuminate\Database\Seeder;

class OrdemCompraItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         OrdemCompraItem::factory()->count(5)->create();
    }
}
