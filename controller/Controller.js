/* Class Controller Begin */
function Controller(){

	this.uid = '';
	this.name = '';
	this.storage = '';

	//this.formsId = []; //retirante-fld-name
	this.sendFormId = ''; //retirante-btn-name
	this.log = '';
}

Controller.prototype.insert = function(){
	Controller.showView('#'+this.uid+'-view-form');
	$('#'+this.uid+'-header-form').text('Novo '+this.name);
	for(i in this.formsId){
		var campo = $('#'+this.formsId[i]);
		var type = campo[0].toString();
		switch(type){
			case '[object HTMLInputElement]':
				campo.val('');
				break;
			case '[object HTMLSelectElement]':
				campo[0].selectedIndex = 0;
				break;
			default:
				console.log(type);
		}
		
	}
	var self = this;
	$('#'+this.sendFormId).text('Cadastrar').unbind().click(function(){
		if(self.validateForm()){
			$('#'+self.sendFormId).attr('disabled',true);
			var dataForm = {};
			for(i in self.formsId){
				it = self.formsId[i].split('-')[2];
				dataForm[it] = $('#'+self.formsId[i]).val();
			}
			dataForm = JSON.stringify(dataForm);
			$.post(self.storage,
				{'insert' :'','array':dataForm}, function(res){
				$('#'+self.sendFormId).attr('disabled',false);
				self.select();
				Controller.alert(res);
			});
		} else bootbox.alert(self.log);
	});
}

Controller.prototype.validateForm = function(){
	for(i in this.formsId){
		var isCorrect = true;
		var campo = $('#'+this.formsId[i]);
		var type = campo[0].toString();
		switch(type){
			case '[object HTMLInputElement]':
				var v = campo.val();
				if(!v){
					isCorrect = false;
					this.log = 'Preencha o campo vazio!';
				}
				else isCorrect = this.validateTypeContent(campo, v);
				break;
			default:
				console.log(type);
		}
		if(!isCorrect) return false;
	}
	return true;
}

Controller.prototype.validateTypeContent = function(formObj, value){
	var typ = formObj.attr('data-typecontent');
	switch(typ){
		case 'integer':
			if(isInt(value)) return true;
			else {
				this.log = 'Preencha o campo somente com numeros!';
				return false;
			}
			break;
		case 'sql-datetime':
			var dt = value.split(' ');
			var d = dt[0].split('-');
			var t = dt[1].split(':');
			var yy = parseInt(d[0]);
			var mm = parseInt(d[1]);
			var dd = parseInt(d[2]);
			var hh = parseInt(t[0]);
			var ii = parseInt(t[1]);
			var ss = parseInt(t[2]);
			console.log(t);
			if(isInt(yy) && isInt(mm) && isInt(dd) && 
			   isInt(hh) && isInt(ii) && isInt(ss)){
				return true;
			} else {
				this.log = 'Preencha a data usando o Seletor!';
				return false;
			}
			break;
	}
	return true;
}

Controller.prototype.select = function(options){
	if(options == null) options = {hasUp: true, hasDel: true};
	else {
		if(options.hasUp == null) options.hasUp = true;
		if(options.hasDel == null) options.hasDel = true;
	}
	Controller.showView('#'+this.uid+'-view-table');
	var self = this;
	$.post(this.storage, {'select': null}, function(res){
		console.log(res);
		var lista = $.parseJSON(res);
		var tbdy = Controller.arrayToTbody(lista, options);
		$('#'+self.uid+'-tbody').html($(tbdy).html());
		if(options.hasUp){
			$('#'+self.uid+'-tbody .glyphicon-refresh').click(function(){
				self.update($(this).attr('data-id'));
			});				
		}
		if(options.hasDel){
			$('#'+self.uid+'-tbody .glyphicon-remove').click(function(){
				self.delete($(this).attr('data-id'));
			});
		}

	});
}

Controller.prototype.update = function(id){
	Controller.showView('#'+this.uid+'-view-form');
	$('#'+this.uid+'-header-form').text('Atualizar '+this.name+' (Id = 	'+id+')');
	var self = this;
	$.post(this.storage, {'selectById': null,'id': id}, function(res){
		var out = $.parseJSON(res);
		for(i in out){
			$('#'+self.uid+'-fld-'+i).val(out[i]);
		}
	});
	$('#'+this.sendFormId).text('Atualizar').unbind().click(function(){
		if(self.validateForm()){

			$(this).attr('disabled',true);
			var dataForm = {};
			for(i in self.formsId){
				it = self.formsId[i].split('-')[2];
				dataForm[it] = $('#'+self.formsId[i]).val();
			}
			dataForm = JSON.stringify(dataForm);
			$.post(self.storage, {'update':'', 'id':id, 'array': dataForm}, function(res){
				console.log(res);
				$('#'+self.sendFormId).attr('disabled',false);
				self.select();
				Controller.alert(res);
			});

		} else bootbox.alert(self.log);
	});
}

Controller.prototype.delete = function(id){
	var self = this;
	bootbox.confirm('Tem certeza que deseja remover???', function(ans){
		if(ans){
			$.post(self.storage,{'delete': null, 'id': id}, function(res){
				self.select();
				Controller.alert(res);
			});
		}
	});
}

Controller.views = [];

Controller.prototype.registerView = function(){
	Controller.registerView('#'+this.uid+'-view-form');
	Controller.registerView('#'+this.uid+'-view-table');
}

Controller.registerView = function(idView){
	Controller.views.push(idView);
}

Controller.showView = function(idView){
	for(i in Controller.views){
		$(Controller.views[i]).hide();
	}
	$(idView).show();
}

Controller.arrayToTbody = function(array, options){
	var tbdy = document.createElement('tbody');
	for(index in array){
		var tr = document.createElement('tr');
		for(i in array[index]){
			var td = document.createElement('td');
			$(td).html(array[index][i]);
			$(tr).append(td);
		}
		if(options.hasUp){
			var td = document.createElement('td');
			var a = document.createElement('span');
			$(a).attr('data-id', array[index]['id'])
			.addClass('glyphicon glyphicon-refresh')
			.css('cursor','pointer');
			$(td).append(a);
			$(tr).append(td);
		}
		if(options.hasDel){
			var td = document.createElement('td');
			var a = document.createElement('span');
			$(a).attr('data-id',array[index]['id'])
			.addClass('glyphicon glyphicon-remove')
			.css('cursor','pointer');
			$(td).append(a);
			$(tr).append(td);
		}
		$(tbdy).append(tr);
	}
	return tbdy;
}

Controller.alert = function(resp){
	if(resp == 'success') bootbox.alert('Operação realizada com sucesso!');
	else bootbox.alert(resp);
}
/* Class Controller End */