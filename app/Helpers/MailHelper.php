<?php

namespace App\Helpers;
use App\Http\Responses\Api;
use App\Mail\GeneralMail;
use App\Jobs\SendMailJob;
use Auth,DB;
use Illuminate\Support\Facades\Request;


class MailHelper
{
    /**
     * Send mail salary
     * 
     * @param Transaction $transaction
     */
    public static function sendMailForgotPassword($data)
    {
        //Send mail
        $dataMail['email']   = $data['email'];
        $dataMail['subject'] = 'Đặt lại mật khẩu';
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
                ->setView('emails.email-forgot-password', $data)
                ->setSubject($dataMail['subject'])
                ->setTo($dataMail['email']);
        dispatch(new SendMailJob($mailJob));
    }

}
