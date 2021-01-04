<?php

namespace App\Http\Controllers;

use App\Models\Mails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    /**
     * Show all mails.
     *
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request)
    {
        // $mails = Mails::all();

        // foreach ($mails as $email) {
        // echo $email;
        // }
        return Mails::all();
    }

    /**
     * Show one email by id.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showById($id)
    {
        $email = Mails::find($id);
        echo $email;
    }

    /**
     * Create a new email instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $email = new Mails;

        $email->email = $request->email;
        $email->interval = $request->interval;
        $email->break = $request->break;

        $email->save();
    }

    /**
     * Update an existing email instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $email = Mails::find($id);

        $email->email = $request->email;
        $email->interval = $request->interval;
        $email->break = $request->break;

        $email->save();
    }

    /**
     * Delete an existing email instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete($id, Request $request)
    {
        $email = Mails::find($id);

        $email->delete();
    }
}
