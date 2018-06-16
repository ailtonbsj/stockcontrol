/* Class Init */
function ProdutoController(){

	this.uid = 'produto';
	this.name = 'Produto';
	this.storage = 'model/produto.php';

	this.formsId = ['produto-fld-categoria', 'produto-fld-nome','produto-fld-estoque_minimo','produto-fld-estoque_atual'];
	this.sendFormId = 'produto-btn-submit';

	this.loadCategoria = function(){
		$.post('model/categoria.php', {'select': null}, function(res){
			var lista = $.parseJSON(res);
			var slt = document.createElement('select');
			for(i in lista){
				var op = document.createElement('option');
				$(op).attr('value', lista[i].id)
				.text(lista[i].nome);
				slt.append(op);
			}
			$('#produto-fld-categoria').html(slt.innerHTML);
		});
	}

	this.insert = function(){
		Controller.prototype.insert.call(this);
		this.loadCategoria();
		$('#produto-fld-estoque_atual').val(0);
	}

	//Constructs
	this.registerView();
	var self = this;
	$('#list-pro-menu').click(function(){
		self.select();
	});
	$('#add-pro-menu').click(function(){
		self.insert();
	});
}
ProdutoController.prototype = new Controller();
/* Class End */