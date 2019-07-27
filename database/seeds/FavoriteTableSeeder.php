<?php

use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('favorite')->delete();

        $users = \App\User::pluck('id')->all();
        $number_of_users = count($users);

        foreach (\App\Question::all() as $question){
            for ($i =0; $i < rand(1, $number_of_users); $i++){
                $question->favorites()->attach($users[$i]);
            }
        }
    }
}
