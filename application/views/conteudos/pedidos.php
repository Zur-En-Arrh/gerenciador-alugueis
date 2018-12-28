<?php if (isset($pedidos)): ?>

	<?php foreach ($pedidos as $pedido): ?>

        
        <div class="card border border-dark mb-3">
          <div class="card-header bg-dark">
              <h4 class="card-title text-info">Pedido feito em: <?php echo $pedido->data_requisicao; ?></h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-8 col-sm-12">
                      <p class="card-text">Equipamento alugado: <?php echo $equipamentos[$pedido->id]->nome; ?></p>
                      <p class="card-text">Usuário: <?php echo $usuarios[$pedido->id]["nome"]; ?></p>
                      <p class="card-text">Data de Entrega: <?php echo $pedido->data_devolucao; ?></p>
                      <p class="card-text">Progresso: <?php echo $pedido->progresso; ?></p>
                  </div>
                  
                  <div class="col-md-4 col-sm-12">
                      
                      <?php if($equipamentos[$pedido->id]->status === 'disponível' && empty($_SESSION['admin'])): ?>
                
                    <button class="btn btn-info btn-block mb-3" type="button" data-toggle="modal" data-target="#modal<?php $equipamentos[$pedido->id]->id; ?>"> 
                        Alugar Novamente <i style="color: white;" class="fas fa-handshake"></i>
                    </button>
                      
                      <?php if(($pedido->progresso != 'Cancelado' && $pedido->progresso != 'Concluído') && empty($_SESSION['admin'])): ?>
                      <form action="<?php echo base_url(); ?>pedido/cancelamento" method="POST">
                          <input type="hidden" name="id" value="<?php echo $pedido->id; ?>"/>
                          <button type="submit" class="btn btn-danger btn-block">Cancelar Pedido <i class="fas fa-exclamation-circle"></i></button>                      
                      </form>
                      <?php endif; ?>


                    <div id="modal<?php $equipamentos[$pedido->id]->id; ?>" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Aluguel</h6>
                              <button type="button" class="close" data-dismiss="modal">
                                <span>x</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('pedido/aluguel'); ?>" method="POST">
                                    <input type="hidden" name="equip" value="<?php echo $equipamentos[$pedido->id]->id; ?>">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="sltQtde">Quantidade: </label>
                                            <select id="sltQtde" class="form-control" name="qtde">
                                                <?php for ($i = 1; $i <= $equipamentos[$pedido->id]->estoque; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtDev">Data de Devolução:</label>
                                                <input id="txtDev" class="form-control" name="devolucao" type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        Fechar Pedido <i class="fas fa-shopping-bag"></i>
                                    </button>
                                </form>
                                </div>
                        </div>
                    </div>
                </div> <!-- Modal -->
                
                <?php endif; ?>
                      
                  </div>
              </div>
          </div>
            
            <?php if(isset($_SESSION['admin']) && $pedido->progresso !== 'Concluído' && $pedido->progresso !== 'Cancelado'): ?>
            <div class="card-footer bg-dark">
                <a href="<?php echo base_url('pedido/termino/'.$pedido->id); ?>" class="btn btn-info">Concluir Pedido <i class="fas fa-calendar-check"></i></a>
            </div>
            <?php endif; ?>
            
        </div> <!-- Card -->
        <?php endforeach;?>
        
        <?php echo $this->pagination->create_links(); ?>
		
<?php else: ?>
    <p>Não há pedidos feitos!</p>
<?php endif; ?>
