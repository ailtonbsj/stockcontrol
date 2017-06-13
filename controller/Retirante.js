/* Class Init */
function RetiranteController(){

	this.uid = 'retirante';
	this.name = 'Retirante';
	this.storage = 'model/retirante.php';

	this.formsId = ['retirante-fld-nome', 'retirante-fld-empresa'];
	this.sendFormId = 'retirante-btn-submit';

	//Constructs
	this.registerView();
	var self = this;
	$('#list-ret-menu').click(function(){
		self.select();
	});
	$('#add-ret-menu').click(function(){
		self.insert();
	});
}
RetiranteController.prototype = new Controller();
/* Class End */