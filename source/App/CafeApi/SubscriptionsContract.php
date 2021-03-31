<?php


namespace Source\App\CafeApi;


use Source\Models\CafeApp\AppContract;

class SubscriptionsContract extends CafeApi
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $subscription = (new AppContract())->find("user_id = :user_id AND status != :status",
            "user_id={$this->user->id}&status=canceled")->fetch();
        if (!$subscription) {
            $this->call(
                404,
                "not_found",
                "não tem uma contrato"
            )->back();
            return;
        }
        $response["signatureContract"] = $subscription->data();
        $response["signatureContract"]->contract = [
            "id" => $subscription->subscriberContract()->id,
            "started" => $subscription->subscriberContract()->started
        ];
        $this->back();
    }



}