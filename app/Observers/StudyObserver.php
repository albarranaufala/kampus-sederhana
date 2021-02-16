<?php

namespace App\Observers;

use App\Study;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StudyObserver
{
    public function creating (Study $study) {
      $creditRemaining = Auth::user()->credit->credit - $study->course->credit;
      if ($creditRemaining < 0) {
        return false;
      }
    }

    public function created (Study $study)
    {
        $study->user->credit->update([
          'credit' => $study->user->credit->credit - $study->course->credit
        ]);
    }

    public function deleting (Study $study)
    {
      $study->user->credit->update([
        'credit' => $study->user->credit->credit + $study->course->credit
      ]);
    }
}