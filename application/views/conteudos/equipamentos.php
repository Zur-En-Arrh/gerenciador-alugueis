<?php if(isset($equipamentos)): ?>        
<?php foreach ($equipamentos as $obj): ?>
          <div class="card border border-dark mb-3">
            <div class="card-header bg-dark text-info"><?php echo $obj->nome; ?></div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h4 class="card-title">Informações</h4>
                  <p class="card-text"><?php echo 'Especificação: '.$obj->especificacao;?></p>
                  <p class="card-text"><?php echo 'Patrimônio: '.$obj->patrimonio;?></p>
                  <p>
                      
                  </p>
                </div>
                <div class="col">
                  <div class="scrollspy border border-info p-3" data-spy="scroll" data-offset="0" style="position: relative; overflow: auto; height: 150px;">
                    <p><?php echo $obj->observacoes; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bg-dark text-info">
                <?php if(isset($_SESSION['admin'])): ?>
                <a href="<?php echo base_url(); ?>equipamento/atualizar/<?php echo $obj->id; ?>" class="btn btn-info" ><i class="fas fa-eye"></i> Ver mais</a>
                <?php elseif(isset($_SESSION["id"])): ?>
                    <?php if($obj->status === 'disponível'): ?>

                    <button type="button" data-toggle="modal" data-target="#modal<?php $obj->id; ?>" class="btn btn-info"> 
                        Alugar <i style="color: white;" class="fas fa-handshake"></i>
                    </button>


                    <div id="modal<?php $obj->id; ?>" class="modal fade" tabindex="-1" role="dialog">
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
                                    <input type="hidden" name="equip" value="<?php echo $obj->id; ?>">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="sltQtde">Quantidade: </label>
                                            <select id="sltQtde" class="form-control" name="qtde">
                                                <?php for ($i = 1; $i <= $obj->estoque; $i++): ?>
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
                    </div>

                    <?php elseif($this->uri->segment(2) !== FALSE && $this->uri->segment(2) !== 'ver_wishlist'): ?>
                    Desculpe, mas esse produto está <?php echo $obj->status; ?>.
                    <a href="<?php echo base_url('equipamento/wishlist/'.$obj->id); ?>" class="btn btn-info">Notificar Administrador <i class="fas fa-flag-checkered"></i></a>
                    <?php else: ?>
                    <a href="<?php echo base_url('equipamento/wishlist/delecao/'.$obj->id); ?>" class="btn btn-danger">Retirar da Lista <i class="fas fa-check-circle"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
                
                
            </div>
          </div> <!-- Card --->
            
        
        <?php endforeach; ?>

        <?php echo $this->pagination->create_links(); ?>

          <?php else: ?>
          <p>Nenhum Equipamento Encontrado!</p>
          <?php endif ?>
        </div> <!-- Div Conteúdo Principal -->