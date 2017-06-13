/* Class Init */
function EstoqueController(){

	this.uid = 'estoque';
	this.formsId = ['estoque-fld-data', 'estoque-fld-categoria', 'estoque-fld-produto', 'estoque-fld-select1', 'estoque-fld-quantidade', 'estoque-fld-obs'];
	this.sendFormId = 'estoque-btn-submit';

	//Construct Singleton
	if(EstoqueController.herdado == undefined){
		EstoqueController.herdado = true;
		this.registerView();
		var self = this;
		$('#estoque-fld-produtonome')[0].oninput = function(){ //keypress
			var q = $(this).val();
			if(((q.length/3) % 1) == 0){
				self.queryProduto(q, {'limit': 10});
			}
		};
		$('#datetimepicker1').datetimepicker({
			locale: 'pt-BR',
			format: 'YYYY-MM-DD HH:mm:ss'
		});
	}
}

EstoqueController.prototype = new Controller;

EstoqueController.prototype.select = function(){
	Controller.prototype.select.call(this, {hasUp:false});
	$('#estoque-header-table').text(this.name);
};

EstoqueController.prototype.insert = function(){
	Controller.prototype.insert.call(this);
	$('#datetimepicker1 input').val(moment().format('YYYY-MM-DD HH:mm:ss'));
	$('#estoque-fld-produtonome').val('');
	$('#estoque-fld-categorianome').val('');
	$('#estoque-fld-produtotag').children('span').click();
};

EstoqueController.prototype.queryCategoriaById = function(id){
	$.post('model/categoria.php', {'selectById': null, 'id': id}, function(res){	
		var cat = $.parseJSON(res);
		$('#estoque-fld-categorianome').val(cat.nome);
		$('#estoque-fld-categoria').val(cat.id);
	});	
}

EstoqueController.prototype.queryProduto = function(q,options){
	var self = this;
	if(options == null) lim = 0;
	else if(options.limit == null) lim = 0;
	else lim = options.limit;
	$.post('model/produto.php', {'selectByKey': null, 'key': q, 'lim': lim}, function(res){
		var lista = $.parseJSON(res);
		var ul = document.createElement('ul');
		for(i in lista){
			var op = document.createElement('li');
			var a = document.createElement('a');
			$(a).attr('data-cat',lista[i].categoria)
			.attr('data-id',lista[i].id).text(lista[i].nome);
			$(op).append(a);
			$(ul).append(op);
		}
		$('#estoque-fld-produto-ul').html($(ul).html());
		$('#estoque-fld-produto-ul li a').click(function(){
			var prd = $(this);
			var prdT = prd.text();
			$('#estoque-fld-produtonome').val(prdT).hide();
			$('#estoque-fld-produtotag').html(prdT+'<span data-role="remove"></span>')
			.addClass('tag label label-primary').children('span').click(function(){
				$('#estoque-fld-produtonome').val('').show();
				$('#estoque-fld-categorianome').val('');
				$('#estoque-fld-categoria').val('');
				$('#estoque-fld-produtotag').html('');
				$('#estoque-fld-produto').val('');
			});

			$('#estoque-fld-produto').val(prd.attr('data-id'));
			self.queryCategoriaById(prd.attr('data-cat'));
		});
	});
}

EstoqueController.prototype.loadSelect1 = function(dataset){
	$.post(dataset, {'select': null}, function(res){
		//console.log(res);
		var lista = $.parseJSON(res);
		var slt1 = $('#estoque-fld-select1');
		slt1.html('');
		for(i in lista){
			var op = document.createElement('option');
			$(op).attr('value', lista[i].id)
			.text(lista[i].nome);
			slt1.append(op);
		}
	});
}

/* Class End */