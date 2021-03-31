<?php


namespace Source\Models\CafeApp;


use Source\Core\Model;
use Source\Core\Session;
use Source\Models\User;

class AppServices extends Model
{
    /** @var null|int */
    public $wallet;
    public function __construct()
    {
        parent::__construct(
            "app_services", ["id"],
            ["user_id", "wallet_id", "description", "odo_km", "value", "due_at"]
        );
        if ((new Session())->has("walletfilter")) {
            $this->wallet = "AND wallet_id = " . (new Session())->walletfilter;
        }

    }

    public function launchService(User $user, array $data): ?AppServices
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (
            empty($data["wallet_id"]) || empty($data["description"])
            || empty($data["odo_km"]) || empty($data["value"]) || empty($data["due_at"])

        ) {
            $this->message->error("Faltam dados para lançar essa serviço");
            return null;
        }
        $wallet = (new AppWallet())->find("user_id = :user_id AND id = :id",
            "user_id={$user->id}&id={$data["wallet_id"]}")->fetch();

        if (!$wallet) {
            $this->message->error("A carteira que você informou não existe");
            return null;
        }
        $category = (new AppServiceCategory())->findById($data["category_id"]);
        if (!$category) {
            $this->message->error("A categoria que você informou não existe");
            return null;
        }

    }

}