<?php

namespace App\Console\Commands;

use App\Mail\EngineeringProtocolMail;
use App\Models\ProtocolProjectSubmission;
use App\Models\ProtocolProvisionalRequest;
use App\Models\ProtocolRequestFeedback;
use App\Models\ProtocolSurvey;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailExpiredEngineeringProtocol extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:engineering-protocol';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a email if engineering protocol is expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Carbon::setlocale(LC_TIME, 'pt_BR');
        $today = Carbon::now()->format('Y-m-d');

        $email = 'engenharia@sunnyhouse.com.br';

        // Project Submission
        $protocol_project_submission = ProtocolProjectSubmission::all();

        foreach ($protocol_project_submission as $project_submission) {
            $project_submission_deadline = strtotime('+3 days', strtotime($project_submission->protocol_date));
            $generator_client = $project_submission->generator->client;

            if ($generator_client->is_corporate) $client = $generator_client->corporate_name;
            else $client = $generator_client->name;

            $maildata = [
                'client' => $client,
                'contract_account' => $project_submission->generator->generator_contract_account,
                'status' => $project_submission->generator->generator_status,
                'protocol_number' => $project_submission->protocol_number,
                'protocol_date' => date('d/m/Y', strtotime($project_submission->protocol_date)),
                'protocol_deadline' => date('d/m/Y', $project_submission_deadline)
            ];

            if (date('Y-m-d', $project_submission_deadline) < $today) {
                Mail::to($email)->send(new EngineeringProtocolMail($maildata));
            }
        }

        // Request Feedback
        $protocol_request_feedback = ProtocolRequestFeedback::all();

        foreach ($protocol_request_feedback as $request_feedback) {
            $request_feedback_deadline = strtotime('+15 days', strtotime($request_feedback->protocol_date));
            $generator_client = $request_feedback->generator->client;

            if ($generator_client->is_corporate) $client = $generator_client->corporate_name;
            else $client = $generator_client->name;

            $maildata = [
                'client' => $client,
                'contract_account' => $request_feedback->generator->generator_contract_account,
                'status' => $request_feedback->generator->generator_status,
                'protocol_number' => $request_feedback->protocol_number,
                'protocol_date' => date('d/m/Y', strtotime($request_feedback->protocol_date)),
                'protocol_deadline' => date('d/m/Y', $request_feedback_deadline)
            ];

            if (date('Y-m-d', $request_feedback_deadline) < $today) {
                Mail::to($email)->send(new EngineeringProtocolMail($maildata));
            }
        }

        // Provisional Request
        $protocol_provisional_request = ProtocolProvisionalRequest::all();

        foreach ($protocol_provisional_request as $provisional_request) {
            $provisional_request_deadline = strtotime('+3 days', strtotime($provisional_request->protocol_date));
            $generator_client = $provisional_request->generator->client;

            if ($generator_client->is_corporate) $client = $generator_client->corporate_name;
            else $client = $generator_client->name;

            $maildata = [
                'client' => $client,
                'contract_account' => $provisional_request->generator->generator_contract_account,
                'status' => $provisional_request->generator->generator_status,
                'protocol_number' => $provisional_request->protocol_number,
                'protocol_date' => date('d/m/Y', strtotime($provisional_request->protocol_date)),
                'protocol_deadline' => date('d/m/Y', $provisional_request_deadline)
            ];

            if (date('Y-m-d', $provisional_request_deadline) < $today) {
                Mail::to($email)->send(new EngineeringProtocolMail($maildata));
            }
        }

        // Survey
        $protocol_survey = ProtocolSurvey::all();

        foreach ($protocol_survey as $survey) {
            $survey_deadline = strtotime('+7 days', strtotime($survey->protocol_date));
            $generator_client = $survey->generator->client;

            if ($generator_client->is_corporate) $client = $generator_client->corporate_name;
            else $client = $generator_client->name;

            $maildata = [
                'client' => $client,
                'contract_account' => $survey->generator->generator_contract_account,
                'status' => $survey->generator->generator_status,
                'protocol_number' => $survey->protocol_number,
                'protocol_date' => date('d/m/Y', strtotime($survey->protocol_date)),
                'protocol_deadline' => date('d/m/Y', $survey_deadline)
            ];

            if (date('Y-m-d', $survey_deadline) < $today) {
                Mail::to($email)->send(new EngineeringProtocolMail($maildata));
            }
        }

        return true;
    }
}
