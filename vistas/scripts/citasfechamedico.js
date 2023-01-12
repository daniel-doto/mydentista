var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);
	$("#idmedico").change(listar);

	//Cargamos los items al select cliente
	$.post("../ajax/consultas.php?op=selectMedico", function(r){
	            $("#idmedico").html(r);
	            $('#idmedico').selectpicker('refresh');
	});
}


//Función Listar
function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var idmedico = $("#idmedico").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/consultas.php?op=citasfechamedico',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin, idmedico: idmedico},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


init();