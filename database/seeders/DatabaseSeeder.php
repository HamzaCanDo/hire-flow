<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $employer = User::factory()->create([
            'name' => 'Morgan Lee',
            'email' => 'employer@hireflow.test',
            'password' => Hash::make('password'),
            'role' => 'employer',
        ]);
        User::factory()->create([
            'name' => 'Alex Candidate',
            'email' => 'candidate@hireflow.test',
            'password' => Hash::make('password'),
            'role' => 'candidate',
        ]);

        $companies = [
            ['name' => 'Northstar Labs', 'industry' => 'Technology', 'location' => 'San Francisco, CA', 'size' => '51–200'],
            ['name' => 'Greenhouse Co.', 'industry' => 'Climate Tech', 'location' => 'Austin, TX', 'size' => '11–50'],
            ['name' => 'Atlas Creative', 'industry' => 'Design', 'location' => 'New York, NY', 'size' => '51–200'],
            ['name' => 'Velo Health', 'industry' => 'Healthcare', 'location' => 'Remote', 'size' => '201–500'],
        ];
        $jobTemplates = [
            ['Senior Laravel Developer', 'Engineering', 'Remote', 'Full-time', 'Senior', 110000, 145000],
            ['Product Designer', 'Design', 'New York, NY', 'Full-time', 'Mid', 90000, 120000],
            ['Growth Marketing Manager', 'Marketing', 'Austin, TX', 'Full-time', 'Mid', 85000, 115000],
            ['Frontend Engineer', 'Engineering', 'San Francisco, CA', 'Full-time', 'Senior', 125000, 165000],
            ['Data Analyst Intern', 'Data', 'Remote', 'Internship', 'Entry', 35000, 45000],
            ['Customer Success Lead', 'Customer Success', 'Chicago, IL', 'Full-time', 'Lead', 95000, 125000],
        ];

        foreach ($companies as $i => $companyData) {
            $company = Company::create([
                'user_id' => $employer->id,
                'name' => $companyData['name'],
                'slug' => Str::slug($companyData['name']),
                'industry' => $companyData['industry'],
                'location' => $companyData['location'],
                'size' => $companyData['size'],
                'verified' => true,
                'description' => $companyData['name'] . ' builds thoughtful products and believes in sustainable, ambitious growth.',
            ]);
            for ($j = 0; $j < 2; $j++) {
                $template = $jobTemplates[($i * 2 + $j) % count($jobTemplates)];
                Job::create([
                    'company_id' => $company->id,
                    'posted_by' => $employer->id,
                    'title' => $template[0],
                    'slug' => Str::slug($template[0]) . '-' . Str::lower(Str::random(5)),
                    'location' => $template[2],
                    'type' => $template[3],
                    'level' => $template[4],
                    'category' => $template[1],
                    'salary_min' => $template[5],
                    'salary_max' => $template[6],
                    'description' => "Join {$company->name} and help shape products used by a growing global community. You will work across disciplines, own meaningful outcomes, and help build an inclusive team.",
                    'requirements' => "• 3+ years of relevant experience\n• Strong communication and collaboration skills\n• Evidence of practical, measurable impact\n• Comfort working in a fast-moving environment",
                    'benefits' => "Flexible remote work\nHealth and wellness coverage\nLearning budget\nGenerous paid time off",
                    'featured' => $j === 0,
                    'is_active' => true,
                ]);
            }
        }
    }
}
