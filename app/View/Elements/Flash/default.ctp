<div class="<?php echo $params['class']?>" role="alert">
  <?php echo $this->Html->tag('i', '', array('class' => 'fas fa-dove')) . $message; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
