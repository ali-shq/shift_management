<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Employee;
use App\Models\Employment;
use App\Models\Like;
use App\Models\Place;
use App\Models\Post;
use App\Models\Shift;
use App\Models\Skill;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TopicSeeder::class);
        $topics = Topic::all();

        $users = User::factory(10)->create();

        $this->call(SkillSeeder::class);
        $skills = Skill::all();

        $this->call(ShiftSeeder::class);
        $shifts = Shift::orderBy('id')->get();
        $employees = Employee::factory(700)->has(Employment::factory())->create();    

        $places = Place::factory(8)->create();

        foreach ($employees as $employee) {
            $employee->skills()->attach($skills->random(1)->first()->id);
            if (7 == rand(1,10)) {
                $employee->skills()->attach($skills->random(1)->last()->id);
            }

            foreach($shifts as $shift) {
                $employee->shiftAvailability()->create([
                    'shift_id' => $shift->id,
                    'is_available' => rand(1, 20) != 10
                ]);

                $employee->shiftPreferences()->create([
                    'shift_id' => $shift->id,
                    'preference' => rand(0, 30)
                ]);
            }

            foreach($places as $place) {
                $employee->placeAvailability()->create([
                    'place_id' => $place->id,
                    'is_available' => rand(1, 20) != 10
                ]);

                $employee->placePreferences()->create([
                    'place_id' => $place->id,
                    'preference' => rand(0, 30)
                ]);
            }


        }


        foreach ($places as $place) {
            foreach ($shifts as $shift) {
                if ($shift->id == 3 && rand(1,3) != 1) {
                    continue;
                }
                $place->shifts()->attach($shift->id);
            }
            foreach ($skills as $skill) {
                $place->skills()->attach($skill->id, ['needed_employees' => rand(5,10)]);
            }
            // var_dump($place);die();
        }

        $posts = Post::factory(200)
            ->withFixture()
            ->has(Comment::factory(15)->recycle($users))
            ->recycle([$users, $topics])
            ->create();

        $ali = User::factory()
            ->has(Post::factory(45)->recycle($topics)->withFixture())
            ->has(Comment::factory(120)->recycle($posts))
            ->has(Like::factory()->forEachSequence(
                ...$posts->random(100)->map(fn (Post $post) => ['likeable_id' => $post]),
            ))
            ->create([
                'name' => 'Kledis Ali',
                'email' => 'test@example.com',
            ]);

        $hh_ali = User::factory()
            ->has(Post::factory(45)->recycle($topics)->withFixture())
            ->has(Comment::factory(120)->recycle($posts))
            ->has(Like::factory()->forEachSequence(
                ...$posts->random(100)->map(fn (Post $post) => ['likeable_id' => $post]),
            ))
            ->create([
                'name' => 'HHysa Ali',
                'email' => 'h02@gmail.com',
            ]);
    }
}
