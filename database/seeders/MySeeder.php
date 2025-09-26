<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Educational;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Link;
use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Skill;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::query()->create(['name' => 'Mohamed Salah Tenant']);
        
        User::query()->create(['first_name' => 'Mohamed', 'second_name' => 'Salah', 'third_name' => 'Amin', 'type' => UserType::CLIENT->value, 'email' => 'eng.mohamed161996@gmail.com', 'password' => bcrypt('password'), 'tenant_id' => $tenant ->id, 'email_verified_at' => now(), 'phone' => '+201555855836', 'address' => 'New Damietta, Damietta, Egypt', 'birthdate' => '1996-06-01', 'nationality' => 'Egyptian', 'marital_status' => 'Married', 'objective' => 'A highly experienced and creative web developer with 5 years’ experience in a variety of exciting projects.', 'domain' => 'mohamed-salah', 'job_title' => 'Full-Stack Developer', 'job_description' => 'Laravel • Vue.js • AWS • REST APIs • Scalable SaaS Systems']);    
        
        Educational::query()->create(['educational' => 'B.Sc. Computer Science, Faculty of Computers and Information, Helwan University', 'start_date' => '2025-09-07 15:22:29', 'end_date' => '2025-09-07 15:22:29', 'tenant_id' => $tenant ->id]);    
        Educational::query()->create(['educational' => 'English Course, Ain Shams University', 'start_date' => '2025-09-07 15:22:29', 'end_date' => '2025-09-07 15:22:29', 'tenant_id' => $tenant ->id]);    
        
        Experience::query()->create(['title' => 'Full Stack Developer — BuduCloud', 'description' => 'Worked on PHP native projects.', 'start_date' => '2014-11-07 15:18:46', 'end_date' => '2015-05-01 15:17:21', 'tenant_id' => $tenant ->id]);    
        Experience::query()->create(['title' => 'Full Stack Developer — RADAPP', 'description' => 'Worked on PHP (Laravel) projects and server deployment.', 'start_date' => '2017-02-01 15:17:15', 'end_date' => '2021-04-01 15:13:17', 'tenant_id' => $tenant ->id]);    
        Experience::query()->create(['title' => 'Full Stack Developer — SixtySixTen (Online USA Company)', 'description' => 'Worked on PHP (Laravel) projects and server deployment.', 'start_date' => '2021-05-01 15:17:15', 'end_date' => null, 'tenant_id' => $tenant ->id]);    
        
        Language::query()->create(['language' => 'Arabic', 'description' => 'Native.', 'tenant_id' => $tenant ->id]);
        Language::query()->create(['language' => 'English', 'description' => 'Good (Speaking, Reading, Writing)', 'tenant_id' => $tenant ->id]);
        
        $php = ProjectWork::query()->create(['project_work' => 'PHP Works.', 'tenant_id' => $tenant ->id]);
        $design = ProjectWork::query()->create(['project_work' => 'Design Works.', 'tenant_id' => $tenant ->id]);


        Project::query()->create(['project_work_id' => $php->id, 'title' => 'Hotel System', 'description' => 'description', 'tags' => ["MVC", "PHP", "NATIVE"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/mo7am/HotelSystemUsingPHPMVC.git', 'website_url' => null, 'other' => null, 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $php->id, 'title' => 'Hotel System', 'description' => 'description', 'tags' => ["MVC", "PHP"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/mo7am/HotelSystemUsingLaravel.git', 'website_url' => null, 'other' => null, 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $php->id, 'title' => 'Sale Parts System', 'description' => 'description', 'tags' => ["MVC", "PHP", "NATIVE"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/mo7am/PartsCarUsingLaravel.git', 'website_url' => null, 'other' => null, 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $php->id, 'title' => 'Real Time Private Chat', 'description' => 'description', 'tags' => ["LARAVEL", "PHP", "WEBSOCKET", "VUE.JS"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/mo7am/PrivateChat_Vue.js_WebSocket_Laravel.git', 'website_url' => null, 'other' => null, 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $php->id, 'title' => 'VClasses', 'description' => 'description', 'tags' => ["LARAVEL", "PHP", "BOOTSTRAB"], 'date' => '2025-09-07 15:56:47', 'source_code' => null, 'website_url' => 'https://vclasses.net/home', 'other' => 'private', 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $php->id, 'title' => 'Donorninja', 'description' => 'description', 'tags' => ["MVC", "PHP", "BOOTSTRAB"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/marawanaziz/donor-ninja', 'website_url' => 'http://nonprofit.sstdevsite.com/login', 'other' => 'private', 'tenant_id' => $tenant ->id]);
        Project::query()->create(['project_work_id' => $design->id, 'title' => 'Egypt Air Website Design', 'description' => 'description', 'tags' => ["HTML", "CSS", "JAVASCRIPT"], 'date' => '2025-09-07 15:56:47', 'source_code' => 'https://github.com/mo7am/Airport-Design.git', 'website_url' => null, 'other' => null, 'tenant_id' => $tenant ->id]);
    
        Skill::query()->create(['skill' => 'PHP (MVC, Laravel)', 'tenant_id' => $tenant ->id]);
        Skill::query()->create(['skill' => 'HTML, CSS, JavaScript, Vue.js, Nuxt.js', 'tenant_id' => $tenant ->id]);
        Skill::query()->create(['skill' => 'MySQL Database', 'tenant_id' => $tenant ->id]);
        Skill::query()->create(['skill' => 'RESTful APIs (Postman, Swagger)', 'tenant_id' => $tenant ->id]);
        Skill::query()->create(['skill' => 'Real-Time (WebSocket, Pusher)', 'tenant_id' => $tenant ->id]);
        Skill::query()->create(['skill' => 'Server Deployment & Setup', 'tenant_id' => $tenant ->id]);

        Link::query()->create(['icon' => 'bi bi-github','color' => '#fff','link' => 'https://github.com/mo7am', 'tenant_id' => $tenant ->id]);
        Link::query()->create(['icon' => 'bi bi-linkedin','color' => '#0A66C2','link' => 'https://www.linkedin.com/in/mohamed-salah-896102120/', 'tenant_id' => $tenant ->id]);
        Link::query()->create(['icon' => 'bi bi-whatsapp','color' => '#25D366','link' => 'https://wa.me/201555855836', 'tenant_id' => $tenant ->id]);
        Link::query()->create(['icon' => 'bi bi-envelope-fill','color' => '#EA4335','link' => 'https://mail.google.com/mail/?view=cm&fs=1&to=Eng.mohamed161996@gmail.com', 'tenant_id' => $tenant ->id]);
        Link::query()->create(['icon' => 'bi bi-facebook','color' => '#1877F2','link' => 'https://www.facebook.com/mitokondarea', 'tenant_id' => $tenant ->id]);
    }
}
