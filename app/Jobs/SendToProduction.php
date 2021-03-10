<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use transloadit\Transloadit;
use Auth;
use Storage;

class SendToProduction implements ShouldQueue
{
  use Dispatchable,
  InteractsWithQueue,
  Queueable,
  SerializesModels;

  private $orderItemId;
  public $tries = 1;
  public $timeout = 100;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($orderItemId)
  {
    $this->orderItemId = $orderItemId;
  }

  /**
  * Execute the job.
  *
  * @return void
  */

  public function handle(){
    $orderItemId=$this->orderItemId;

    DB::table('order_items')->where('id', $orderItemId)->update(
      [
        'status' => 'pending',
      ]
    );
    return;

  }

}
