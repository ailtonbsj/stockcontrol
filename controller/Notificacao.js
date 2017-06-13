/* Class Notificacao Begin */
function Notificacao(){
	//Construct
	this.view = $('#notificacao-view');
	this.badge = $('#notificacao-badge');
	this.total = 0;
	$(this.badge).hide();
	var self = this;
	$.post('model/produto.php', {'select': null}, function(res){
		console.log(res);
		var lista = $.parseJSON(res);
		for(i in lista){
			if(parseInt(lista[i].estoque_atual) <= parseInt(lista[i].estoque_minimo)){
				self.add(lista[i].nome);
			}
		}
	});
}

Notificacao.prototype.add = function(produto){

	if(this.total == 0) $(this.view).html('');
	this.total++;
	if(this.total > 1){
		$(this.view).append('<li class="divider"></li>');
	}

	var i = document.createElement('i');
	$(i).addClass('fa fa-exclamation-triangle fa-fw');
	var span = document.createElement('span');
	$(span).text('Em estoque minimo!').addClass('text-muted small')
	.css('display','block').css('text-align','right');
	var div = document.createElement('div');
	$(div).append(i, ' '+produto, span);
	var a = document.createElement('a');
	$(a).append(div);
	var li = document.createElement('li');
	$(li).append(a);
	$(this.view).append(li);
	$(this.badge).text(this.total).show();

};