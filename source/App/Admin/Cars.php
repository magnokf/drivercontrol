<?php


namespace Source\App\Admin;


use Source\Models\Car;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;


/**
 * Class Cars
 * @package Source\App\Admin
 */
class Cars extends Admin
{


    public function __construct()
    {
        parent::__construct();
    }



    public function home(?array $data) :void
    {
     //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo    json_encode([
                "redirect"=> url("admin/cars/home/{$s}/1")
            ]);
            return;
        }
        $search = null;
        $cars = (new Car())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all"){
            $search = str_search($data["search"]);
            $cars = (new Car())->find("MATCH(model, plate) AGAINST(:s)", "s=%{$search}%");
            if (!$cars->count()){
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("admin/cars/home");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/cars/home/{$all}/"));
        $pager->pager($cars->count(), 12, (!empty($data["page"]) ? $data["page"] : 1) );

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Carros",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );
        echo $this->view->render("widgets/cars/home", [
            "app"=>"cars/home",
            "head"=>$head,
            "search"=>$search,
            "cars"=>$cars->order("plate, model")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function car(?array $data):void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $carCreate = new Car();
            $carCreate->plate = $data["plate"];
            $carCreate->make = $data["make"];
            $carCreate->model = $data["model"];
            $carCreate->fuel = $data["fuel"];
            $carCreate->year = $data["year"];
            $carCreate->status = $data["status"];
            $carCreate->color = $data["color"];


            //upload photocar

            if (!empty($_FILES["photocar"])){
                $files = $_FILES["photocar"];
                $upload = new Upload();
                $image = $upload->image($files, $carCreate->plate, 600);
                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }
                $carCreate->photocar = $image;
            }
            if (!$carCreate->save()){
                $json["message"] = $carCreate->message()->render();
                echo json_encode($json);
                return;
            }
            $this->message->success("Veículo cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/cars/car/{$carCreate->id}");

            echo json_encode($json);
            return;

        }
        //update

        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $carUpdate = (new Car())->findById($data["car_id"]);

            if (!$carUpdate) {
                $this->message->error("Você tentou gerenciar um carro que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/cars/home")]);
                return;
            }

            $carUpdate->plate = $data["plate"];
            $carUpdate->make = $data["make"];
            $carUpdate->model = $data["model"];
            $carUpdate->fuel = $data["fuel"];
            $carUpdate->year = $data["year"];
            $carUpdate->status = $data["status"];
            $carUpdate->color = $data["color"];


            //upload photocar

            if (!empty($_FILES["photocar"])){
                if ($carUpdate->photocar && file_exists(__DIR__."/../../../".CONF_UPLOAD_DIR."/{$carUpdate->photocar}")){
                    unlink(__DIR__."/../../../".CONF_UPLOAD_DIR."{$carUpdate->photocar}");
                    (new Thumb())->flush($carUpdate->photocar);
                }

                $files = $_FILES["photocar"];
                $upload = new Upload();
                $image = $upload->image($files, $carUpdate->plate, 600);
                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }
                $carUpdate->photocar = $image;
            }
            if (!$carUpdate->save()){
                $json["message"] = $carUpdate->message()->render();
                echo json_encode($json);
                return;
            }
            $this->message->success("Veículo atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }
        //delete
            if (!empty($data["action"]) && $data["action"] == "delete") {
                $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
                $carDelete = (new Car())->findById($data["car_id"]);
                if (!$carDelete) {
                    $this->message->error("Você tentou deletar um carro que não existe")->flash();
                    echo json_encode(["redirect" => url("/admin/cars/home")]);
                    return;
                }
                if ($carDelete->photocar && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$carDelete->photocar}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$carDelete->photocar}");
                    (new Thumb())->flush($carDelete->photocar);
                }

                $carDelete->destroy();

                $this->message->success("O veículo foi excluído com sucesso...")->flash();
                echo json_encode(["redirect" => url("/admin/cars/home")]);

                return;
            }

            $carUpdate = null;
            if (!empty($data["car_id"])) {
                $carId = filter_var($data["car_id"], FILTER_VALIDATE_INT);
                $carUpdate = (new Car())->findById($carId);
            }
            $head = $this->seo->render(
                CONF_SITE_NAME . " | " . ($carUpdate ? "Perfil de {$carUpdate->plate}" : "Novo Veículo"),
                CONF_SITE_DESC,
                url("/admin"),
                url("/admin/assets/images/image.jpg"),
                false
            );

            echo $this->view->render("widgets/cars/car", [
                "app" => "cars/car",
                "head" => $head,
                "car" => $carUpdate
            ]);

    }

}