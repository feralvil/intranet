<h1><?php echo __('Usuarios de la aplicación'); ?></h1>
<?php
echo $this->Form->create('User', array(
    'inputDefaults' => array('label' => false,'div' => false),
    'class' => 'form-horizontal'
));
?>
