<?php

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('users')->delete();
    \DB::table('answers')->delete();
    \DB::table('questions')->delete();

    $user = new \App\User();
    $user->name = 'John Doe';
    $user->email = 'john@doe.com';
    $user->password = Hash::make('password');
    $user->save();

    // $this->call(UserSeeder::class);
    factory(App\User::class, 3)->create()
      ->each(function($u) {
        $u->questions()
          ->saveMany(
            factory(App\Question::class, rand(1, 5))->make()
          )
          ->each(function($q) {
            $q->answers()
              ->saveMany(
                factory(App\Answer::class, rand(1, 5))->make()
              );
          });
      });
  }
}

