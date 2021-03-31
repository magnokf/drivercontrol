<?php


namespace Source\Models\CafeApp;


use Source\Core\Model;
use Source\Models\Car;
use Source\Models\User;

/**
 * Class AppContract
 * @package Source\Models\CafeApp
 */
class AppContract extends Model
{
    /**
     * AppContract constructor.
     */
    public function __construct()
    {
        parent::__construct("app_contract", ["id"], ["user_id", "car_id", "status", "pay_status", "started", "next_due"]);
    }


    /**
     * @param User $user
     * @param Car $car
     * @return $this
     */
    public function subscriberContract(User $user, Car $car): AppContract
    {
        $this->user_id = $user->id;
        $this->car_id = $car->id;
        $this->status = "active";
        $this->pay_status = "active";
        $this->started = date("Y-m-d");

        $this->next_due = date("Y-m-d", strtotime(date($this->started) . "+7days"));
        $this->last_due = date("Y-m-d");
        $this->save();
        return $this;

    }

    /**
     * @return mixed|Model|null
     */
    public function user()
    {
        return (new User())->findById($this->user_id);
    }

    /**
     *
     */
    public function car()
    {
        return(new Car())->findById($this->car_id);

    }

    /**
     * @return int
     */
    public function recurrence()
    {
        $recurrence = 0;
        $activeSubscribers = $this->find("pay_status = :s", "s=active")->fetch(true);

        if ($activeSubscribers) {
            foreach ($activeSubscribers as $subscriber) {
                $recurrence += $subscriber->car()->weekprice;
            }
        }

        return $recurrence;
    }

    /**
     * @return int
     */
    public function recurrenceMonth()
    {
        $recurrence = 0;
        $activeSubscribers = $this->find("pay_status = :s AND year(started) = year(now()) AND month(started) = month(now())",
            "s=active")->fetch(true);

        if ($activeSubscribers) {
            foreach ($activeSubscribers as $subscriber) {
                $recurrence += $subscriber->car()->weekprice;
            }
        }

        return $recurrence;
    }

}