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
    $this->call([
      UsersQuestionsAnswersTableSeeder::class,
      FavoritesTableSeeder::class,
    ]);
    //factory(App\Question::class, 20)->create();
  }
}
