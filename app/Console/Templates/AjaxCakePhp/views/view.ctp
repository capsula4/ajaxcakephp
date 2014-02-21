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
?>

<?php
echo '
<?php 
if($created == true):
    echo $this->Jquery->fancyBox(
		array(
			\'action\'=>\'view\',
			$'.$singularVar.'[\''.$modelClass.'\'][\'id\']
		),
		array(
			\'delay\'=>500
		)
	);?>
	
	
	<script type="text/javascript">
if(controller=="'.$pluralVar.'"){
	<?php echo $this->Jquery->load(array("action"=>"index"),array("update"=>"content"),null,false); ?>
}
</script>
	
	
	<?php
else:
?>';
?>

<div class="<?php echo $pluralVar; echo empty($associations['hasMany'])?'':'hasMany'; echo empty($associations['hasAndBelongsToMany'])?'':'hasAndBelongsToMany'; ; ?> view">
        <h2><?php echo "<?php  echo __('{$singularHumanName}'); ?>"; ?></h2>
        <div class="actions">
                <ul>
        <?php
                echo "\t\t<li><?php echo \$this->Jquery->fancylink(__('edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
                echo "\t\t<li><?php echo \$this->Form->postLink(__('delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, __('Delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
        ?>
                </ul>
        </div>
	<dl>
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
				echo "\t\t<dd>\n\t\t\t<?php echo \$this->Jquery->fancylink(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
		echo "\t\t<dd>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
	}
}
?>
	</dl>
</div>
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="hasOne">
		<h3><?php echo "<?php echo __('" . Inflector::humanize($details['controller']) . "'); ?>"; ?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
		<div class="actions">
			<ul>
				<li><?php echo "<?php echo \$this->Jquery->fancylink(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n"; ?>
			</ul>
		</div>		
                <dl>
	<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
				echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</dd>\n";
			}
	?>
		</dl>
	<?php echo "<?php endif; ?>\n"; ?>
	</div>
	<?php
	endforeach;
endif;

if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0; ?>
<?php if (!empty($relations)):?>

<div class="related" id="related">
    <ul>
<?php foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
        <li><a href="#related-<?php echo $otherSingularVar?>"><?php echo $otherPluralHumanName?></a></li>
<?php endforeach; ?>
    </ul>
<?php foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
    <div id="related-<?php echo $otherSingularVar; ?>">
        <div class="actions">
                <ul>
                        <li><?php echo "<?php echo \$this->Jquery->fancylink(__('Add " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add', '{$singularVar}' => \${$singularVar}['{$modelClass}']['id'])); ?>"; ?> </li>
                </ul>
        </div>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
			}
?>
		<th class="actions"><?php echo "<?php echo __('Acciones'); ?>"; ?></th>
	</tr>
<?php
echo "\t<?php
		\$i = 0;
		foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
		echo "\t\t<tr>\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
			}

			echo "\t\t\t<td class=\"actions\">\n";
			echo "\t\t\t\t<?php echo \$this->Jquery->fancylink(__('view'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t<?php echo \$this->Jquery->fancylink(__('edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t<?php echo \$this->Form->postLink(__('delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), null, __('Confirma eliminar # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t</td>\n";
		echo "\t\t</tr>\n";

echo "\t<?php endforeach; ?>\n";
?>
	</table>
        <?php echo
            "<?php else:
				echo '<div>There are no records</div>';
			endif;
            
            ?>\n\n"; ?>
        </div>
<?php endforeach; 

echo "<?php echo \$this->Jquery->tabs('.related');?>
<?php endif; ?>"?>
</div>
<?php endif;?>
