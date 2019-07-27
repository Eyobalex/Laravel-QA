<?php

use Illuminate\Database\Seeder;

class UQATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('answers')->delete();
        \Illuminate\Support\Facades\DB::table('questions')->delete();
        \Illuminate\Support\Facades\DB::table('users')->delete();

        factory(\App\User::class,3)->create()->each(function ($u){
            $u->questions()->saveMany(factory(\App\Question::class, rand(1,5))->make())->each(function ($q){
                $q->answers()->saveMany(factory(\App\Answer::class, rand(1,5))->make());
            });
        });


    }
}
