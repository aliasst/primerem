<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $data = array(
            array(
                'id' => 1,
                'title' => 'Договор',
                'sample_stage_id' => null,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 2,
                'title' => 'Замер на объекте',
                'sample_stage_id' => 1,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 3,
                'title' => 'Договор',
                'sample_stage_id' => 1,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 4,
                'title' => 'Предоплата',
                'sample_stage_id' => 1,
                'sort' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 5,
                'title' => 'Дизайн-проект',
                'sample_stage_id' => null,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 6,
                'title' => 'ТЗ на дизайн-проект',
                'sample_stage_id' => 5,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 7,
                'title' => 'Планировка',
                'sample_stage_id' => 5,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 8,
                'title' => 'Цветовой коллаж. Стилистика',
                'sample_stage_id' => 5,
                'sort' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 9,
                'title' => 'Технические чертежи помещения',
                'sample_stage_id' => 5,
                'sort' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 10,
                'title' => 'Предварительные чертежи мебели (корпусная, мягкая)',
                'sample_stage_id' => 5,
                'sort' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 11,
                'title' => 'Рендеры помещения',
                'sample_stage_id' => 5,
                'sort' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 12,
                'title' => 'Правки',
                'sample_stage_id' => 5,
                'sort' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 13,
                'title' => 'Готовый альбом',
                'sample_stage_id' => 5,
                'sort' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 14,
                'title' => 'Черновые работы',
                'sample_stage_id' => null,
                'sort' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 15,
                'title' => 'Выстраивание геометрии помещения',
                'sample_stage_id' => 14,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 16,
                'title' => 'Демонтаж-монтаж стен',
                'sample_stage_id' => 14,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),



        );

        DB::table('sample_stages')->insert($data);




        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'superadmin',
            'password' => Hash::make('11111111'),
        ]);

//        Project::factory(2)->create();
    }
}
