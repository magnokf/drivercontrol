<?php


namespace Source\Models\CafeApp;


use Source\Models\User;

class AppInvoiceCar
{
    /**
     * @param User $user
     * @return object
     */
    public function balanceCar(User $user): object
    {
        $balance_car = new \stdClass();
        $balance_car->income_car = 0;
        $balance_car->expense_car = 0;
        $balance_car->car = 0;
        $balance_car->balance_car = "positive";

        $find = $this->find("user_id = :user AND status = :status",
            "user={$user->id}&status=paid",
            "
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND status = :status AND type = 'income' {$this->wallet}) AS income,
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND status = :status AND type = 'expense' {$this->wallet}) AS expense
            ")->fetch();

        if ($find) {
            $balance_car->income_car = abs($find->income_car);
            $balance_car->expense_car = abs($find->expense_car);
            $balance_car->car = $balance_car->income_car - $balance_car->expense_car;
            $balance_car->balance_car = ($balance_car->car >= 1 ? "positive" : "negative");
        }

        return $balance_car;
    }

    /**
     * @param AppWallet $wallet
     * @return object
     */
    public function balanceWallet(AppWallet $wallet): object
    {
        $balance = new \stdClass();
        $balance->income = 0;
        $balance->expense = 0;
        $balance->wallet = 0;
        $balance->balance = "positive";

        $find = $this->find("user_id = :user AND status = :status",
            "user={$wallet->user_id}&status=paid",
            "
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND wallet_id = {$wallet->id} AND status = :status AND type = 'income') AS income,
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND wallet_id = {$wallet->id} AND status = :status AND type = 'expense') AS expense
            ")->fetch();

        if ($find) {
            $balance->income = abs($find->income);
            $balance->expense = abs($find->expense);
            $balance->wallet = $balance->income - $balance->expense;
            $balance->balance = ($balance->wallet >= 1 ? "positive" : "negative");
        }

        return $balance;
    }

    /**
     * @param User $user
     * @param int $year
     * @param int $month
     * @param int $week
     * @param string $type
     * @return object|null
     */
    public function balanceMonth(User $user, int $year, int $month, int $week ,string $type): ?object
    {
        $onpaid = $this->find(
            "user_id = :user",
            "user={$user->id}&type={$type}&year={$year}&month={$month}&week={$week}",
            "
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND week(due_at) = :week AND status = 'paid' {$this->wallet}) AS paid,
                (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND week(due_at) = :week AND status = 'unpaid' {$this->wallet}) AS unpaid
            "
        )->fetch();

        if (!$onpaid) {
            return null;
        }

        return (object)[
            "paid" => str_price(($onpaid->paid ?? 0)),
            "unpaid" => str_price(($onpaid->unpaid ?? 0))
        ];
    }

    /**
     * @param User $user
     * @return object
     */
    public function chartData(User $user): object
    {
        $dateChart = [];
        for ($month = -4; $month <= 0; $month++) {
            $dateChart[] = date("m/Y", strtotime("{$month}month"));
        }


        $chartData = new \stdClass();
        $chartData->categories = "'" . implode("','", $dateChart) . "'";
        $chartData->expense = "0,0,0,0,0";
        $chartData->income = "0,0,0,0,0";

        $chart = (new AppInvoice())
            ->find("user_id = :user AND status = :status AND due_at >= DATE(now() - INTERVAL 4 MONTH) GROUP BY year(due_at) ASC, month(due_at) ASC",
                "user={$user->id}&status=paid",
                "
                    year(due_at) AS due_year,
                    month(due_at) AS due_month,
                    DATE_FORMAT(due_at, '%m/%Y') AS due_date,
                    (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND status = :status AND type = 'income' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS income,
                    (SELECT SUM(value) FROM app_invoices WHERE user_id = :user AND status = :status AND type = 'expense' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS expense
                "
            )->limit(5)->fetch(true);

        if ($chart) {
            $chartCategories = [];
            $chartExpense = [];
            $chartIncome = [];

            foreach ($chart as $chartItem) {
                $chartCategories[] = $chartItem->due_date;
                $chartExpense[] = $chartItem->expense;
                $chartIncome[] = $chartItem->income;
            }

            $chartData->categories = "'" . implode("','", $chartCategories) . "'";
            $chartData->expense = implode(",", array_map("abs", $chartExpense));
            $chartData->income = implode(",", array_map("abs", $chartIncome));
        }

        return $chartData;
    }

}