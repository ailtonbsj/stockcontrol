/* Class Init */
function SaidaEstoqueController(){

	this.name = 'Saida de Material';
	this.storage = 'model/saidaEstoque.php';

	this.select = function(){
		EstoqueController.prototype.select.call(this);
		$('#estoque-fld-header1').text('Retirante');
	};

	this.insert = function(){
		EstoqueController.prototype.insert.call(this);
		$('#estoque-fld-label1').text('Retirante');
		this.loadSelect1('model/retirante.php');
	};

	//Constructs
	var self = this;
	$('#out-sto-menu').click(function(){
		self.insert();
	});
	$('#list-out-sto-menu').click(function(){
		self.select();
	});

}
SaidaEstoqueController.prototype = new EstoqueController;
/* Class End */