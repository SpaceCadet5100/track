<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;
use function PHPUnit\Framework\returnCallback;

class changeStatusPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeStatusPackage:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return redirect('/API/emailSender=sa@example.com&emailRecipient=a@example.com&SenderCountryNetherlands&SenderStreetNameIcaruslaan&SenderHouseNumber25&SenderPostalCode4545LH&SenderCityBreda&RecipientCountryNetherlands&RecipientStreetNameBredaLaan&RecipientHouseNumber15&RecipientPostalCode234KJ&RecipientCityBreda&FirstnameSenderLucas&LastnameSender&Brado&FirstnameRecipientDaniel&LastnameRecipientSchripsema');

    }
}
