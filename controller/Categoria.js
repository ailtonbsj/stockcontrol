/* Class Init */
function CategoriaController(){

	this.uid = 'categoria';
	this.name = 'Categoria';
	this.storage = 'model/categoria.php';

	this.formsId = ['categoria-fld-nome'];
	this.sendFormId = 'categoria-btn-submit';

	//Constructs
	this.registerView();
	var self = this;
	$('#list-cat-menu').click(function(){
		self.select();
	});
	$('#add-cat-menu').click(function(){
		self.insert();
	});
}
CategoriaController.prototype = new Controller();
/* Class End */