
<?php if(isset($wishlists)): ?>
<?php $x = 0; foreach($wishlists as $obj): ?>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">Um Pedido de <?php echo $usuarios[$x]["nome"];?></h4>
  <p>Equipamento requisitado: <a class="alert-link" href="<?php echo base_url('equipamento/atualizar/'.$equipamentos[$x]->id); ?>" ><?php echo $equipamentos[$x]->nome."({$equipamentos[$x]->patrimonio})";?> </a></p>
  <p class="text-capitalize">Atual Estado: <?php echo $equipamentos[$x]->status;?> </p>

  
  <hr>
  <p class="mb-0">Contatos: <?php echo $usuarios[$x]["email"].'/'.$usuarios[$x]["telefone"];?></p>
</div>

<?php $x++; endforeach; ?>

<?php else: ?>
<p>Não há nenhum pedido na lista.</p>
<?php endif; ?>