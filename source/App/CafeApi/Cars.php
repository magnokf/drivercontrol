<?php


namespace Source\App\CafeApi;


use Source\Support\Thumb;
use Source\Support\Upload;

class Cars extends CafeApi
{
    public function __construct()
    {
     parent::__construct() ;
    }

    /**
     * list user data
     */
    public function index(): void
    {
        $car = $this->car->data();
        $car->photo = CONF_URL_BASE . "/" . CONF_UPLOAD_DIR . "/{$car->photocar}";
        $response["car"] = $car;
        $this->back($response);
        return;
    }


    public function photocar(): void
    {
        $request = $this->requestLimit("carsPhoto", 3, 60);
        if (!$request) {
            return;
        }

        $photocar = (!empty($_FILES["photocar"]) ? $_FILES["photocar"] : null);
        if (!$photocar) {
            $this->call(
                400,
                "invalid_data",
                "Envie uma imagem JPG ou PNG para atualizar a foto"
            )->back();
            return;
        }

        chdir("../");

        $upload = new Upload();
        $newPhoto = $upload->image($photocar, $this->car->plate, 600);

        if (!$newPhoto) {
            $this->call(
                400,
                "invalid_data",
                $upload->message()->getText()
            )->back();
            return;
        }

        if ($this->car->photocar() && $newPhoto != $this->car->photocar) {
            unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$this->car->photocar}");
            (new Thumb())->flush($this->car->photocar);
        }

        $this->car->photocar = $newPhoto;
        $this->car->save();

    }



}