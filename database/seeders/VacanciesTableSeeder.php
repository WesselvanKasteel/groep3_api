<?php

namespace Database\Seeders;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Vacancy;
use App\Models\Skill;
use App\Models\User;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vacancies')->insert([
            'id' => Uuid::generate(),
            'title' => 'React Developer',
            'description' => 'Liever ownership neemt dan slechts voorgeschreven lijstjes afwerkt. Als team bepalen we namelijk wat op de backlog voor onze eigen applicaties komt. Onze klanten dragen de uitdagingen aan - wij de oplossing. We zoeken een frontend developer die met enthousiasme en ervaring, die initiatief neemt in de overkoepelende frontend-innovatie (we werken o.a. met REACT, Javascript / TypeScript en GraphQL). Iemand die ook een kick krijgt van anderen verder helpen in hun technische uitdagingen. En daarnaast graag met andere disciplines zoals UX de meest gebruiksvriendelijke applicatie realiseert, onder andere gebruikmakend van ons state of the art design system.',
            'deadline' => now(),
            'code' => Uuid::generate(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vacancy = Vacancy::get()->last();
        $skills = ['html', 'css', 'react'];
        foreach ($skills as $skill) {
            $skill = Skill::where('skill', '=', $skill)->first();
            $vacancy->assignSkill($skill);
        }
        $user = User::where('phone_number', '=', '0612345678')->first();
        $vacancy->assignUser($user);


        DB::table('vacancies')->insert([
            'id' => Uuid::generate(),
            'title' => 'Lead UI designer',
            'description' => 'Wij zijn op zoek naar een getalenteerde leider voor ons team.',
            'deadline' => now(),
            'code' => Uuid::generate(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vacancy = Vacancy::get()->last();
        $skills = ['javascript', 'react', 'vue'];
        foreach ($skills as $skill) {
            $skill = Skill::where('skill', '=', $skill)->first();
            $vacancy->assignSkill($skill);
        }
        $user = User::where('phone_number', '=', '0616345338')->first();
        $vacancy->assignUser($user);

        DB::table('vacancies')->insert([
            'id' => Uuid::generate(),
            'title' => 'Back-end developer',
            'description' => '',
            'code' => Uuid::generate(),
            'deadline' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vacancy = Vacancy::get()->last();
        $skills = ['php', 'laravel'];
        foreach ($skills as $skill) {
            $skill = Skill::where('skill', '=', $skill)->first();
            $vacancy->assignSkill($skill);
        }
        $user = User::where('phone_number', '=', '0616345338')->first();
        $vacancy->assignUser($user);

    }
}
