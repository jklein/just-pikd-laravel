<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;
use Pikd\Models\Referral;

use Illuminate\Http\Request;

class ReferralController extends Controller {

    private $errors = [];
    private $successes = [];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data['title'] = sprintf("%s | Pikd", 'Referrals');

        $referrals = Referral::where('ref_cu_id', '=', \Auth::user()->cu_id)->get();
        
        foreach ($referrals as $referral) {
            $data['referrals'][] = [
                'email'  => $referral->ref_email,
                'date'   => date('Y-m-d H:i:s', strtotime($referral->ref_created_at)),
                'status' => $referral->ref_status,
            ];
        }

        return view('referrals', $data);
    }

    /**
     * Create new referrals.
     *
     * @return Nothin'
     */
    public function store(Request $r) {
        $emails = $this->parseEmails($r->input('emails'));

        foreach ($emails as $email) {
            $referral = Referral::firstOrNew([
                'ref_cu_id'  => \Auth::user()->cu_id,
                'ref_email'  => $email,
                'ref_status' => \Pikd\Enums\ReferralStatus::REFERRED,
            ]);

            if ($referral->exists === false) {
                // Create the referral
                $saved = $referral->save();
                if ($saved) {
                    $this->successes[] = $email . ' referred successfully!';
                } else {
                    $this->errors[] = $email . ' failed to be saved as a referral!';
                }
            } else {
                $this->errors[] = $email . ' has already been referred.';
            }
        }

        \Session::flash('warning', $this->errors);
        \Session::flash('success', $this->successes);

        return redirect('/account/referrals');
    }

    /**
     * Takes raw input from a text area and returns an array of valid email addresses
     *
     * @return array A list of emails that this person is referring
     */
    private function parseEmails($emails) {
        $emails = preg_split('/(,|\n)/', trim($emails));

        $final_emails = [];
        $errors = [];
        foreach ($emails as $email) {
            $email = trim($email);
            if (empty($email)) {
                continue;
            }
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $this->errors[] = $email . ' is not a valid email address';
            } else {
                $final_emails[] = $email;
            }
        }

        return $final_emails;
    }
}
