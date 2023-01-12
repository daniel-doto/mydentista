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
			url:'../web2/php/servidor.php',
			method:'POST',
			data:{
				rq:"1"
			}
		}).done(function(datos){
			//logica
			$("#idstock").text(parseFloat(datos).toLocaleString());
		});


		//almacen
		$.ajax({
			statusCode:{
				404:function(){
					console.log("Esta pagina no existe");
				}
			},
			url:'../web2/php/servidor.php',
			method:'POST',
			data:{
				rq:"2"
			}
		}).done(function(datos){
			//logica
			$("#idalmacen").text(parseFloat(datos).toLocaleString());
		});

		//gastos
		$.ajax({
			statusCode:{
				404:function(){
					console.log("Esta pagina no existe");
				}
			},
			url:'../web2/php/servidor.php',
			method:'POST',
			data:{
				rq:"3"
			}
		}).done(function(datos){
			//logica
			$("#idgastos").text(parseFloat(datos).toLocaleString());
		});
	}
	this.getDatosGraficas = function(){
//gastos
		$.ajax({
			statusCode:{
				404:function(){
					console.log("Esta pagina no existe");
				}
			},
			url:'../web2/php/servidor.php',
			method:'POST',
			data:{
				rq:"4"
			}
		}).done(function(datos){
			//logica
				if(datos != ''){
					let etiquetas = new Array();
					let tTelefono = new Array();
					let tPrecio = new Array();
					let coloresV = new Array();
					let coloresP = new Array();
					var jDatos = JSON.parse(datos);

		for (let i in jDatos){
			etiquetas.push(jDatos[i].fechaVenta);
			tTelefono.push(jDatos[i].totalVendidos);
			tPrecio.push(jDatos[i].totalPrecio);
			coloresV.push("#088A29");
			coloresP.push("#01A9DB");
		}

			var ctx = document.getElementById('idGrafica').getContext('2d');
			 var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: etiquetas,
                        datasets: [
                            {
                                label: 'stock de productos',
                                data: tTelefono,
                                backgroundColor: coloresV
                            },
                            {
                                label: 'total gastado',
                                data: tPrecio,
                                backgroundColor: coloresP
                            }
                        ]
                    }
                });
            }
        });
    }
}

var oIndex = new index();
setTimeout(function () { oIndex.ini(); }, 100);