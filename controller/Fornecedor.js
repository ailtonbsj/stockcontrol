/* Class Init */
function FornecedorController(){

	this.uid = 'fornecedor';
	this.name = 'Fornecedor';
	this.storage = 'model/fornecedor.php';

	this.formsId = ['fornecedor-fld-nome', 'fornecedor-fld-telefone', 'fornecedor-fld-estado', 'fornecedor-fld-cidade'];
	this.sendFormId = 'fornecedor-btn-submit';

	//Constructs
	this.registerView();
	var self = this;
	$('#list-for-menu').click(function(){
		self.select();
	});
	$('#add-for-menu').click(function(){
		self.insert();
	});
}
FornecedorController.prototype = new Controller();
/* Class End */