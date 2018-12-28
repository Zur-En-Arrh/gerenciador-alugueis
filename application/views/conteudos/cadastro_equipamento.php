    <?php echo form_open('equipamento/insercao', ''); ?>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtNome">Nome</label>
                <?php echo form_input($nome); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtPatr">Patrimônio</label>
                <?php echo form_input($patrimonio); ?> 
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="txtDesc">Especificação</label>
                <?php echo form_input($descricao); ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="sltStatus">Status</label>
                <?php echo form_dropdown(array('name' => 'status', 'class' => 'form-control', 'required' => 'required', 'id' => 'sltStatus'), $opcoes); ?>
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txtQtde">Quantidade</label>
                <?php echo form_input($quantidade); ?>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="txtObs">Observações</label>
	<?php echo form_textarea($observacoes); ?>
        </div>
        
	<?php echo form_submit($botao); ?>
	
	<?php echo form_close(); ?>