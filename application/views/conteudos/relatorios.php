<table class="table table-striped table-hover">
    <thead>
      <tr class="bg-dark text-info">
        <th>#</th>
        <th>Ano</th>
        <th>Mês</th>
        <th>Ver</th>
        <th>Baixar</th>
      </tr>
    </thead>
    <tbody>
    <?php $j = 1; $i = 1; foreach($array as $ano => $meses): ?>
      <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $ano; ?></td>
        <?php foreach($meses as $numero => $nome): ?>
            <?php if($i > 1): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ano; ?></td>
            <?php endif; ?>
            <td><?php echo $nome; ?></td>
            <td><a target="_blank" href="<?php echo base_url()."relatorio/{$ano}/{$numero}/0"; ?>">Ver</a></td>
            <td><a href="<?php echo base_url()."relatorio/{$ano}/{$numero}/1"; ?>">Baixar</a></td>
            
            </tr>
        <?php $i++; endforeach; ?>
        
    <?php $i = 0; $j++; endforeach;?>
    </tbody>
</table>

