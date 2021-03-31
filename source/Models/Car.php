<?php


namespace Source\Models;


use Source\Core\Model;

/**
 * Class Car
 * @package Source\Models
 */
class Car extends Model
{
    /**
     * Car constructor.
     */
    public function __construct()
    {
        parent::__construct("cars",["id"], ["make", "model", "year", "fuel", "plate", "color"]);
    }

    /**
     * @param string $make
     * @param string $model
     * @param string $year
     * @param string $fuel
     * @param string $plate
     * @param string $color
     * @return Car
     */
    public function bootstrapp(
        string $make,
        string $model,
        string $year,
        string $fuel,
        string $plate,
        string $color


    ): Car {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->plate = $plate;
        $this->color = $color;
        return $this;
    }

    /**
     * @param string $plate
     * @param string $columns
     * @return Car|null
     */
    public function findByPlate(string $plate, string $columns = "*"): ?Car
    {
        $find = $this->find("plate = :plate", "plate={$plate}", $columns);
        return $find->fetch();
    }

    /**
     * @return string|null
     */
    public function photocar(): ?string
    {
        if ($this->photocar && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->photocar}")) {
            return $this->photocar;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Marca, modelo, placa, ano, cor e combustível são obrigatórios");
            return false;
        }



        /** Car Update */
        if (!empty($this->id)) {
            $carId = $this->id;

            if ($this->find("plate = :p AND id != :i", "p={$this->plate}&i={$carId}", "id")->fetch()) {
                $this->message->warning("A placa informada já está cadastrada");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$carId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Car Create */
        if (empty($this->id)) {
            if ($this->findByPlate($this->plate, "plate")) {
                $this->message->warning("A Placa informada já está cadastrada");
                return false;
            }

            $carId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($carId))->data();
        return true;
    }

}