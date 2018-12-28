	<form action="<?php echo base_url().'usuario/cadastrarUsuario' ?>" id="form" method="POST">
        <div class="form-group">
        <label for="txtNome">Nome:</label> 
        <input class="form-control" id="txtNome" type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="txtCPF">CPF:</label> 
                        <input class="form-control" id="txtCPF" type="text" name="cpf" placeholder="CPF" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="txtMatricula">Matrícula:</label>
                        <input class="form-control" id="txtMatricula" type="text" name="matricula" placeholder="Matrícula" required>
                    </div>
                </div>
            </div>    
        
            
            <div class="form-group">
                <label for="txtEmail">Email:</label>
                <input class="form-control" id="txtEmail" type="email" name="email" placeholder="Email" required>
            </div>
            
            
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="txtSala">Sala:</label> 
                        <input class="form-control" id="txtSala" type="text" name="sala" placeholder="Sala">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="txtTelefone">Telefone:</label> 
                        <input class="form-control" id="txtTelefone" type="text" name="telefone"  placeholder="Telefone" required>
                    </div>
                </div>
            </div>    
        <button type="submit" class="btn btn-success">Atualizar</button>
	</form> 