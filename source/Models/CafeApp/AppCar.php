<?php


namespace Source\Models\CafeApp;


use Source\Core\Model;
use Source\Models\User;

/**
 * Class AppCar
 * @package Source\Models\CafeApp
 */
class AppCar extends Model
{
    /**
     * AppCar Constructor
     */
    public function __construct()
    {
     parent::__construct("app_cars", ["id"], ["user_id", "car"] );
    }

    public function start(User $user): AppCar
    {
        if (!$this->find("user_id = :user", "user={$user->id}")->count()) {
            $this->user_id = $user->id;
            $this->car = "Meu Carro";
            $this->free = true;
            $this->save();
        }
        return $this;
    }



}