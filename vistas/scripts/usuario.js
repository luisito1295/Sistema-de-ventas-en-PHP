var tabla;

function init(){
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });

    $("#imagenmuesta").hide();

    //Mostramos los permisos
    $.post("../ajax/usuario.php?op=permisos&id=", function(r){
        $("#permisos").html(r);
    });
}

function limpiar(){
    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");    
    $("#telefono").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#login").val();
    $("#clave").val("");
    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
    $("#idusuario").val("");
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
                    url:'../ajax/usuario.php?op=listar',
                    type:"GET",
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

    e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

    });
    
	limpiar();
}

function mostrar(idusuario){

    $.post("../ajax/usuario.php?op=mostrar",{idusuario: idusuario}, function(data,status){
        
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
        $("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idusuario").val(data.idusuario);

    });

    $.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r){
        $("#permisos").html(r);
    });
}

function desactivar(idusuario){
    bootbox.confirm("¿Esta seguro de desactivar al usuario", function(result){
        if(result){
            $.post("../ajax/usuario.php?op=desactivar",{idusuario:idusuario}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(idusuario){
    bootbox.confirm("¿Esta seguro de activar al usuario", function(result){
        if(result){
            $.post("../ajax/usuario.php?op=activar",{idusuario: idusuario}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();