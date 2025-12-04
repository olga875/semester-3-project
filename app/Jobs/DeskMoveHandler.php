<?php
namespace App\Jobs;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\PicoController;

use function PHPUnit\Framework\stringContains;

class DeskMoveHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $height) {}

    public function handle(): void
    {
        Http::put(
        'http://localhost:8006/api/v2/F7H1vM3kQ5rW8zT9xG2pJ6nY4dL0aZ3K/desks/91:17:a4:3b:f4:4d/state',
        ['position_mm' => (int)$this->height]
        ); // this request is changing desk height
        
        do{
            $statusResponse = Http::get(
                'http://localhost:8006/api/v2/F7H1vM3kQ5rW8zT9xG2pJ6nY4dL0aZ3K/desks/91:17:a4:3b:f4:4d/state'
            ); // this request is getting current desk status
            $currentHeight = $statusResponse->json()['position_mm'];
            $currentStatus = $statusResponse->json()['status'];
            usleep(500000); // wait for 0.5 second before next request

        } while ($currentHeight != (int)$this->height || (string)$currentStatus != 'Normal'); // wait until desk reaches desired height and is in normal status

        app(PicoController::class)->blink(); // method that makes pico led blink to notify user that desk reached desired height
    }
}
