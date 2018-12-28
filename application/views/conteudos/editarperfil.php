    <form action="<?php echo base_url().'usuario/atualizarUsuario' ?>" id="form" method="POST">
            <div class="form-group">
        <label for="txtNome">Nome:</label> 
        <input class="form-control" id="txtNome" type="text" name="nome" placeholder="Nome" value="<?php echo $dadosusuario[0]['nome']; ?>" required>
            </div>
            <div class="form-group">
        <label for="txtMatricula">Matrícula:</label>
        <input class="form-control" id="txtMatricula" type="text" name="matricula" placeholder="Matrícula" value="<?php echo $dadosusuario[0]['matricula']; ?>" required>
            </div>
            <div class="form-group">
        <label for="txtEmail">Email:</label>
        <input class="form-control" id="txtEmail" type="email" name="email" placeholder="Email" value="<?php echo $dadosusuario[0]['email']; ?>" required>
            </div>
            <div class="form-group">
        <label for="txtSala">Sala:</label> 
        <input class="form-control" id="txtSala" type="text" name="sala" placeholder="Sala" value="<?php echo $dadosusuario[0]['sala']; ?>">
            </div>
            <div class="form-group">
        <label for="txtTelefone">Telefone:</label> 
        <input class="form-control" id="txtTelefone" type="text" name="telefone"  placeholder="Telefone" value="<?php echo $dadosusuario[0]['telefone']; ?>"" required>
            </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>