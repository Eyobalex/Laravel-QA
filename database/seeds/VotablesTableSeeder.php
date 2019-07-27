<?php

use Illuminate\Database\Seeder;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('votables')->where('votable_type', 'App\Questions')->delete();

        $users = \App\User::all();
        $nU = $users->count();
        $votes = [-1,1];

        foreach (\App\Question::all() as $question){
            for ($i=0; $i<$nU; $i++){
                $user = $users[$i];
                $user->voteQuestion($question, $votes[rand(0,1)]);


            }
        }

    }
}
