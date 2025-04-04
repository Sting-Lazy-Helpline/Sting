<?php

namespace App\Console\Commands;

use App\Models\Prospect;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProcessPropectFromWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-propect-from-website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lead = DB::connection('wordPressMysql')->select("SELECT
        s.id AS submission_id,
        MAX(CASE WHEN sv.key = 'name' THEN sv.value END) AS first_name,
        MAX(CASE WHEN sv.key = 'field_03e1f5a' THEN sv.value END) AS middle_name,
        MAX(CASE WHEN sv.key = 'field_91ccd6d' THEN sv.value END) AS last_name,
        MAX(CASE WHEN sv.key = 'field_a60d742' THEN sv.value END) AS email,
        MAX(CASE WHEN sv.key = 'suffix' THEN sv.value END) AS suffix,
        MAX(CASE WHEN sv.key = 'field_51c1431' THEN sv.value END) AS phone_number,
        MAX(CASE WHEN sv.key = 'field_1759633' THEN sv.value END) AS dob,
        MAX(CASE WHEN sv.key = 'field_0491088' THEN sv.value END) AS gender,
        MAX(CASE WHEN sv.key = 'field_dc93ffd' THEN sv.value END) AS civil_status,
        MAX(CASE WHEN sv.key = 'field_01bb5a8' THEN sv.value END) AS education,
        MAX(CASE WHEN sv.key = 'field_7a706c7' THEN sv.value END) AS dependents,
        MAX(CASE WHEN sv.key = 'country' THEN sv.value END) AS country,
        MAX(CASE WHEN sv.key = 'services' THEN sv.value END) AS service,
        MAX(CASE WHEN sv.key = 'field_f29ae80' THEN sv.value END) AS message
    FROM
        wps6_e_submissions s
    INNER JOIN
        wps6_e_submissions_values sv ON s.id = sv.submission_id
        WHERE  s.lead_move='no'
    GROUP BY
        s.id
    HAVING 
        email IS NOT NULL AND email != ''
        AND first_name IS NOT NULL AND first_name != ''
        AND last_name IS NOT NULL AND last_name != '';"
    );
        for ($i=0; $i < count($lead) ; $i++) { 
            DB::connection('wordPressMysql')->table('wps6_e_submissions')
        ->where('id', $lead[$i]->submission_id)
        ->update(['lead_move' => 'yes']);
        $password = Str::random(12);
           
            $user = User::where('email', $lead[$i]->email)->first();
            if (!$user){
                $user=User::create([
                    'last_name' => $lead[$i]->last_name,
                    'name' => $lead[$i]->first_name,
                    'middle_name' => $lead[$i]->middle_name,
                    'email' => $lead[$i]->email,
                    'user_type' => 'client',
                    'password' => Hash::make($password),
                    'created_by' => 0,
                    'dob' => date("Y-m-d",strtotime($lead[$i]->dob)),
                    'gender' => $lead[$i]->gender,
                    'phone_number' => $lead[$i]->phone_number,
                    // 'address' => $lead[$i]->address,

                ]);

               
                $user->addRole('client');
                $user->save();

                $data['name']=$lead[$i]->first_name.' '.$lead[$i]->last_name;
                $data['email']= $lead[$i]->email;
                $data['password']=$password;
                sendEmail($lead[$i]->email,"Welcome email on Registration $lead[$i]->name",'template/template_register',$data);
            }

            Prospect::create([
                'client_id' =>  $user->id,
                'suffix' => $lead[$i]->suffix,
                'civil_status' => $lead[$i]->civil_status,
                'education' => $lead[$i]->education,
                'with_dependent' => $lead[$i]->dependents,
                'country' => $lead[$i]->country,
                'service' => $lead[$i]->service,
                'message' => $lead[$i]->message,
                'created_by' => 0,
            ]);
        }
        $this->info('Processing leads from website...');
    }
}
