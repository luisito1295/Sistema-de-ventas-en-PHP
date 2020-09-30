<?php

    require_once "../modelos/articulo.php";

    $articulo = new Articulo();

    $idarticulo=isset($_POST["idarticulo"])?limpiarCadena($_POST["idarticulo"]):"";
    $idcategoria=isset($_POST["idcategoria"])?limpiarCadena($_POST["idcategoria"]):"";
    $codigo=isset($_POST["codigo"])?limpiarCadena($_POST["codigo"]):"";
    $nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
    $stock=isset($_POST["stock"])?limpiarCadena($_POST["stock"]):"";
    $descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";
    $imagen=isset($_POST["imagen"])?limpiarCadena($_POST["imagen"]):"";

    switch($_GET["op"]){
        case 'guardaryeditar':
            if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){
                $imagen = $_POST["imagenactual"];
            }else{
                $ext = explode(".", $_FILES["imagen"]["name"]);
                if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png"){
                    $imagen = round(microtime(true)).'.'.end($ext);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/".$imagen);
                }
            }
            if(empty($idarticulo)){
                $rspta=$articulo->insertar($idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
                echo $rspta?"Articulo registrada":"Articulo no se registro";
            }else{
                $rspta=$articulo->editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
                echo $rspta?"Articulo actualizada":"Articulo no se actualizo";
            }

        break;

        case 'desactivar':
            $rspta=$articulo->desactivar($idarticulo);
            echo $rspta?"Articulo desactivada":"Articulo no se desactivo";
        break;

        case 'activar':
            $rspta=$articulo->activar($idarticulo);
            echo $rspta?"Articulo activada":"Articulo no se activo";
        break;

        case 'mostrar':
            $rspta=$articulo->mostrar($idarticulo);
            echo json_encode($rspta);
        break;

        case 'listar':
            $rspta=$articulo->listar();
            $data = Array();
            while($reg=$rspta->fetch_object()){
                $data[] = array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
                                            '<button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
                                            '<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
                                            '<button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
                    "1"=>$reg->nombre,
                    "2"=>$reg->categoria,
                    "3"=>$reg->codigo,
                    "4"=>$reg->stock,
                    "5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px'>",
                    "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivar</span>'
                );
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
        
        case "selectCategoria":
            require_once "../modelos/categoria.php";
            $categoria = new Categoria();

            $rspta = $categoria->select();

            while($reg = $rspta->fetch_object()){

                echo '<option value='.$reg->idcategoria.'>'.$reg->nombre.'</option>';

            }

        break;

    }
