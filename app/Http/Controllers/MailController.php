<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send()
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';
        $objDemo->testVarOne = '1';
        $objDemo->testVarTwo = '2';

        //Mail::to("naresh.h.vegad@doyenhub.com")->send(new DemoEmail($objDemo));
        Mail::send('mails.demo', ['demo' => $objDemo], function ($message) {
		    $message->from('trimantradeveloper@gmail.com', 'Laravel');

		    $message->to('naresh.h.vegad@doyenhub.com')->subject('This is test e-mail');
		});
		return 'Mail sent successfully.';
    }
}