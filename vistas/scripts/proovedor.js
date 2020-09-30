var tabla;

function init(){
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });

}

function limpiar(){
    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#idpersona").val("");
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnAgregar").hide();
    }else{
        $("#listadoRegistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
    }
}

function cancelarform(){
    limpiar();
    mostrarform(false);
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
                    url:'../ajax/persona.php?op=listarp',
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

function guardaryeditar(e){

    e.preventDefault();
    $("btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url:"../ajax/persona.php?op=guardaryeditar",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

function mostrar(idpersona){

    $.post("../ajax/persona.php?op=mostrar",{idpersona:idpersona}, function(data,status){
        
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
        $("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#idpersona").val(data.idpersona);

    });
}

function eliminar(idpersona){
    bootbox.confirm("¿Esta seguro de eliminar el proovedor", function(result){
        if(result){
            $.post("../ajax/persona.php?op=eliminar",{idpersona:idpersona}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}


function imprimir(){
    $("#print").printArea();
}

init();