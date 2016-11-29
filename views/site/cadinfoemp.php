<?php

/* @var $this yii\web\View */

$this->title = 'Cadastrar Informações';

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<h2><strong>Cadastrar Informações</strong></h2>

<div class="site-index">

   
    <br>
    
 
  
  <div class="col-md-8">
  <button class="btn btn-default" type="button">Selecione o arquivo</button>
  <div style="color:#999;">
        Caro usuário, o arquivo a ser enviado deve ser do tipo <strong>*.xlsx</strong>
   </div>
    </div>
  <br>
  </div>
  <br>
  <br>
  <br>
  
  <div class="col-md-2">
  	Ano:
  	<div class="form-control"></div>
  </div>
  <br>
  <br>
  <br>
  <br>
  
  <div class="col-md-12">
 <ul class="nav nav-tabs">
  			<li class="active"><a data-toggle="tab" href="#demox">Balanço Patrimonial</a></li>
  			<li><a data-toggle="tab" href="#demoy">Demonstração dos Fluxos de Caixa</a></li>
  			<li><a data-toggle="tab" href="#demoz">Demonstração do Resultado do Exercício</a></li>
  			<li><a data-toggle="tab" href="#demov">Índice</a></li>
		</ul>


		<div class="tab-content">
  			<div id="demox" class="tab-pane fade in active">
    			<!-- Inicio da tabela dentro das tabs -->
    				<div class="container">            
  						<table class="table table-hover">
    						<thead>
      							<tr>
      								<th><input type="checkbox"/></th>
        							<th>Nome Conta</th>
        							<th>Valor</th>
      							</tr>
    						</thead>
    						<tbody>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Ativo Circulante Financeiro</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 31.647.000,00</textarea></td>
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Disponibilidades</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 31.647.000,00</textarea></td>
        							
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Ativo Circulante Operacional</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 771.547.000,00</textarea></td>
        							       							
      							</tr>
    						</tbody>
  						</table>
					</div>
					<!-- Final da tabela dentro da tab -->
  			</div>
  			<div id="demoy" class="tab-pane fade">
    				<!-- Inicio da tabela dentro das tabs -->
    				<div class="container">            
  						<table class="table table-hover">
    						<thead>
      							<tr>
      								<th><input type="checkbox"/></th>
        							<th>Nome Conta</th>
        							<th>Valor</th>
      							</tr>
    						</thead>
    						<tbody>
      							<tr>
      								<td><input type="checkbox"/></td>
      								
        							<td><textarea class="form-control" rows="1">Depreciação e Amortização</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 7.529.000,00</textarea></td>
        							
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Provisões e Atualizações para demandas Judiciais e Administrativas</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 14.375.000,00</textarea></td>
        							
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Ajuste a Valor Presente</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ -3.057.000,00</textarea></td>
      							</tr>
    						</tbody>
  						</table>
					</div>
					<!-- Final da tabela dentro da tab -->
  			</div>
  			<div id="demoz" class="tab-pane fade">
    				<!-- Inicio da tabela dentro das tabs -->
    				<div class="container">           
  						<table class="table table-hover">
    						<thead>
      							<tr>
      								<th><input type="checkbox"/></th>
        							<th>Nome Conta</th>
        							<th>Valor</th>
      							</tr>
    						</thead>
    						<tbody>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Receita Líquida de Vendas</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 814.175.000,00</textarea></td>
        							
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Custo dos Produtos</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ -764.866.000,00</textarea></td>
        							
      							</tr>
      							<tr>
      								<td><input type="checkbox"/></td>
        							<td><textarea class="form-control" rows="1">Lucro Bruto</textarea></td>
        							<td><textarea class="form-control" rows="1">R$ 49.309.000,00</textarea></td>
  
      							</tr>
    						</tbody>
  						</table>
					</div>
					<!-- Final da tabela dentro da tab -->
  			</div>
  			<div id="demov" class="tab-pane fade">
    			<!-- Inicio da tabela dentro das tabs -->
    				<div class="container">            
  						<table class="table table-hover">
  							<thead><tr>
  								<th>Listar Aqui os Indices</th>
      							</tr>
      						</thead>
  						</table>				
  					</div>
			</div>
			</div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-default" type="button">Excluir Linhas Selecionadas</button>
     	 		<button class="btn btn-default" type="button">Validar Dados</button>
  			</div>
</body>






