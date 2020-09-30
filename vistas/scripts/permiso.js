var tabla;

function init(){
    mostrarform(false);
    listar();
}

function mostrarform(flag){
    if(flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
    }else{
        $("#listadoRegistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").hide();
    }
}

//Listar
function listar(){
    tabla=$('#tblistado').dataTable({
        "aProcessing":true,
        "aServerSide":true,//Paginacion y filtrado realizado por el servidor
        dom:'Bfrtip',//definimos los elementos del control de la tabla
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
                {
                    url:'../ajax/permiso.php?op=listar',
                    type:"get",
                    dataType:"json",
                    error:function(e){
                        console.log(e.response.Text);
                    }
                },
        "bDestroy":true,
        "iDisplayLength":5,//paginacion
        "order":[[0,"desc"]]
    }).DataTable();
}

init();