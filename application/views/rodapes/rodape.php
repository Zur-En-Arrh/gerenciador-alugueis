</div> <!-- Div Conteúdo Principal -->

<?php if(empty($_SESSION["admin"]) && empty($_SESSION["id"])): ?>
        <div class="row">
          <div class="col-lg-4 col-md-12 col-sm-12 mb-3 p-5">
            <div class="card border-primary p-3">
              <img class="card-image mx-auto" src="<?php echo base_url(); ?>imagens/cadastro.png" alt="">
                
              <div class="card-body">
                <h4 class="card-title">Cadastre-se <i class="fas fa-door-open"></i></h4>
                <p class="card-text">Seja capaz de alugar equipamentos, cancelar pedidos e montar lista de desejos, caso estes não estejam disponíveis.</p>
              </div>
              <div class="card-footer">
                  <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url(); ?>usuario/paginaCadastro">Cadastrar-se</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 mb-3 p-5">
            <div class="card border-warning p-3">
              <img class="card-image mx-auto" src="<?php echo base_url(); ?>imagens/admin.png" alt="">
              
              <div class="card-body">
                <h4 class="card-title">Administrador <i class="fas fa-unlock-alt"></i></h4>
                <p class="card-text">Entre como administrador e tenha acesso para ver ou baixar relatórios de estoque, modificar equipamentos e atender os usuários.</p>
              </div>
              <div class="card-footer ">
                  <button class="btn btn-lg btn-block btn-warning text-light" type="button" data-toggle="modal" data-target="#modaladmin">Modo Administrador</button>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 mb-3 p-5">
            <div class="card border-success p-3">
              <img class="card-image mx-auto" src="<?php echo base_url(); ?>imagens/pedido.png" alt="">
              
              <div class="card-body">
                <h4 class="card-title">Pedidos <i class="fas fa-concierge-bell"></i></h4>
                <p class="card-text">Caso seja Administrador, veja todos os pedidos feitos até agora. Caso seja um usuário comum, veja todos os pedidos feitos por você.</p>
              </div>
              <div class="card-footer">
                  <a class="btn btn-success btn-lg btn-block" href="<?php echo base_url('pedido/ver_pedidos'); ?>">Ver Meus Pedidos</a>
              </div>
            </div>
          </div>
            
            
            <div id="modaladmin" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Login Administrador</h6>
                              <button type="button" class="close" data-dismiss="modal">
                                <span>x</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('administrador/login'); ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtUser">Username: </label>
                                                <input id="txtUser" class="form-control" name="username" type="text" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtSenha">Senha:</label>
                                                <input id="txtSenha" class="form-control" name="senha" type="password"  required/>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        Entrar <i class="fas fa-key"></i>
                                    </button>
                                </form>
                                </div>
                        </div>
                    </div>
                </div> <!-- Modal -->
            
            
            
            
          </div>
<?php endif; ?>
        </div> <!--Div Conteúdo Secundário-->
          
      </div>

    </div><!--Div Container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript">

 $(document).ready(function(){
   $("#form").submit(function(){
      var email = $("#txtEmail").val();
      var tel = $("#txtTelefone").val();

      var RegExp = /^[\w]+@[\w]+\.[\w|\.]+$/;
      if (RegExp.test(email) == false) 
      {     
          alert("Este email não é valido!");
          return false;
		  }
      else
      {
          if(tel.length < 10 || tel.lenght > 11)
          {
              alert("Este telefone não é valido!");
              return false;
          }
          else
          {
              return true;
          }
      }
   });
});

</script>
    
    
</body>
</html>