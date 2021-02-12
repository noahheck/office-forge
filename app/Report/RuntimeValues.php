<?php


namespace App\Report;


use App\User;
use Illuminate\Http\Request;

class RuntimeValues
{
    public $date;
    public $date_from;
    public $date_to;
    public $user;
    public $generatingUser;

    public $file_id;

    public function __construct($date, $date_from, $date_to, $user, $generatingUser)
    {
        $this->date = $date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->user = $user;
        $this->generatingUser = $generatingUser;
    }

    public static function fromRequest(Request $request)
    {
        $user = ($user_id = $request->user_id) ? User::find($user_id) : null;

        $filters = new static($request->date, $request->date_from, $request->date_to, $user, $request->user());

        return $filters;
    }

    public function withFileId($file_id)
    {
        $this->file_id = $file_id;

        return $this;
    }
}
