/**

 Ejemplo de llamadas

			total 		= ws.call('productos',{
			     type: "GET",
	        	param : 'contarProductos'
	        }).data.total;
            
            
			var producto = ws.call('productos',{
			     type: "POST",
				param : 'traer',
				producto_id : prod_id
			}).data;

*/
var ws = {
	base 	: '../ws/ws_',
	ext	 	: '.php',
	request : 'JSON',
	type	: 'POST',
	log		: 'console',
	call : function(file,type,params){
		var $this 		= this,
			$response 	= null;
		//return $this.base + file + $this.ext;
		$.ajax(
			$this.base + file + $this.ext,
			{
				data : params,
				dataType : $this.request,
				type : $this.type,
				async : false,
				success : function(data){
					$response = data;
				}

			}
		);

		if($response.ws_error){
			this.debug($response.ws_error);
		}
		return $response;
	},
	debug : function(msg){
		if(this.log == 'console'){
			console.error(msg);
		} else {
			alert(msg);
		}

	}
}