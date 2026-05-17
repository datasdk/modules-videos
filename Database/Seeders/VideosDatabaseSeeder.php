<?php

namespace Modules\Videos\Database\Seeders;

use Illuminate\Database\Seeder;
use Model;

class VideosDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
