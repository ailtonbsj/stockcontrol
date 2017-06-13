/* Class Init */
function EntradaEstoqueController(){

	this.name = 'Entrada de Material';
	this.storage = 'model/entradaEstoque.php';

	this.select = function(){
		EstoqueController.prototype.select.call(this);
		$('#estoque-fld-header1').text('Fornecedor');

	};

	this.insert = function(){
		EstoqueController.prototype.insert.call(this);
		$('#estoque-fld-label1').text('Fornecedor');
		this.loadSelect1('model/fornecedor.php');
	};

	//Constructs
	var self = this;
	$('#in-sto-menu').click(function(){
		self.insert();
	});
	$('#list-in-sto-menu').click(function(){
		self.select();
	});
}

EntradaEstoqueController.prototype = new EstoqueController;
/* Class End */