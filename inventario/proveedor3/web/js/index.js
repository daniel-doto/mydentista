function index() {
	this.ini = function(){
		console.log("iniciando...");
		this.getInidicadores();
		this.getDatosGraficas();
	}
	this.getInidicadores = function (){
		//vendidos
		$.ajax({
			statusCode:{
				404:function(){
					console.log("Esta pagina no existe");
				}
			},
			url:'web/php/servidor.php',
			method:'POST',
			data:{
				rq:"1"
			}
		}).done(function(datos){
			//logica
			$("#idstock").text(parseFloat(datos).toLocaleString());
		});
	}
	this.getDatosGraficas = function(){

	}
}
var oIndex = new index();
setTimeout(function () { oIndex.ini(); }, 100);