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
        \Illuminate\Support\Facades\DB::table('votables')->delete();

        $users = \App\User::all();
        $nU = $users->count();
        $votes = [-1,1];

        foreach (\App\Question::all() as $question){
            for ($i=0; $i<$nU; $i++){
                $user = $users[$i];
                $user->voteQuestion($question, $votes[rand(0,1)]);


            }
        }
        foreach (\App\Answer::all() as $answer){
            for ($i=0; $i<$nU; $i++){
                $user = $users[$i];
                $user->voteAnswer($answer, $votes[rand(0,1)]);


            }
        }

    }
}
