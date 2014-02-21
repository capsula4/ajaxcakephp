<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

switch($action){
    case 'add':
        $languageAction = 'add';
        break;
    case 'edit':
        $languageAction = 'edit';
        break;
    default:
        break;
}

?>
<div class="<?php echo $pluralVar; ?> form">
    <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
        <div class="ui-helper-reset ui-helper-clearfix ui-widget-header-main ui-corner-all">
            <h2><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($languageAction), $singularHumanName); ?></h2>
            <div class="actions">
                <ul>
            <?php if (strpos($action, 'add') === false): ?>
                    <li><?php echo "<?php echo \$this->Jquery->fancylink(__('view'), array('action' => 'view', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
                    <li><?php echo "<?php echo \$this->Jquery->postLink(__('delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, __('Confirma eliminar # %s?', \$this->Jquery->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
            <?php endif; ?>
                </ul>
            </div>
        </div>
<?php echo "<?php echo \$this->Jquery->form(array(
        'type' => 'post',
        'options' => array(
            'model' => '{$modelClass}',
            'update' => 'fancybox-inner',
            'url' => array(
                'controller' => '{$pluralVar}',";
            if (strpos($action, 'add') === false) {
                echo "'action' => 'edit',
                    \$this->Jquery->value('{$modelClass}.{$primaryKey}')";
            }else{
                echo "'action' => 'add'";
            }
            echo "),
        ),
    )); ?>\n"; ?>
	<fieldset>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Jquery->input('{$field}');\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Jquery->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$this->Jquery->end(__('Submit')); ?>\n";
?>
    </div>
</div>
