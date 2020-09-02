<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
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
    //factory(App\Question::class, 20)->create();
  }
}
