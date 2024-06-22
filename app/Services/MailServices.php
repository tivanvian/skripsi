<?php
/* OKE */
namespace App\Services;

use App\Models\Category;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use DataTables;

use App\Models\CustomerCart;
use App\Models\CustomerPurchase;
use App\Models\CustomerPurchaseHistory;
use App\Models\CustomerPurchaseDetail;
use App\Models\Product;
use App\Models\ProductUnit;

class MailServices
{
    public function TransactionIn($data, $code, $date){
        return [
            'subject'       => "Transaksi Berhasil - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }

    public function TransactionRevisi($data, $code, $date){
        return [
            'subject'       => "Transaksi di Revisi - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
            "note_admin"    => $data->histories->last()->notes,
        ];
    }

    public function TransactionRevisiIn($data, $code, $date){
        return [
            'subject'       => "Transaksi Berhasil direvisi - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }

    public function TransactionFinish($data, $code, $date){
        return [
            'subject'       => "Transaksi Telah Selesai - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }

    public function TransactionConfirm($data, $code, $date){
        return [
            'subject'       => "Transaksi Telah dikonfirmasi Admin - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }

    public function TransactionOnTheWay($data, $code, $date){
        return [
            'subject'       => "Transaksi anda sedang dalam Perjalanan - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }

    public function TransactionAccept($data, $code, $date){
        return [
            'subject'       => "Transaksi anda disetujui Admin - ".$code. " - ".$date,
            'name'          => $data->user->name,
            'email'         => $data->user->email,
            "web"           => env('APP_URL_PRIMARY'),
            "data"          => $data->toArray(),
            "detail"        => $data->details->toArray(),
            "user"          => $data->user->toArray(),
        ];
    }


    public function sendMail($data, $type)
    {
        if($type == "TRIN"){
            $DataMaster = $this->TransactionIn($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_in";
        } else if($type == "TRREV"){
            $DataMaster = $this->TransactionRevisi($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_revisi";
        } else if($type == "TRREVIN"){
            $DataMaster = $this->TransactionRevisiIn($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_revisi_in";
        } else if($type == "TRFINISH"){
            $DataMaster = $this->TransactionFinish($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_finish";
        } else if($type == "TRCONFIRM"){
            $DataMaster = $this->TransactionConfirm($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_confirm";
        } else if($type == "TRONTHEWAY"){
            $DataMaster = $this->TransactionOnTheWay($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_on_the_way";
        } else if($type == "TRACCEPT"){
            $DataMaster = $this->TransactionAccept($data, $data->code, $data->purchase_date);
            $templateMail = "emails.transaction_accept";
        }

        // return view($templateMail, $DataMaster);

        \Mail::send($templateMail, $DataMaster, function($message) use ($DataMaster) {
            $message->to($DataMaster['email'], $DataMaster['email'])->subject($DataMaster['subject']);
            $message->from("noreply@innovated.co.id", 'Admin');
        });
    }
}
