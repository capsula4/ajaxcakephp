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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
            | TRANSOFT
        </title>
       
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        //echo $this->Html->css('jquery-ui-1.8.4.custom');
        echo $this->Html->css('ui-lightness/jquery-ui-1.8.22.custom');
        echo $this->Html->css('jquery.fancybox');
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery-ui-1.8.22.custom.min');
        echo $this->Html->script('jquery.fancybox');
        echo $this->Html->script('jquery.maskedinput-1.3.min');
    //    echo $this->Html->script('jquery.autocomplete.min');
        echo $this->Html->script('jquery.jeditable.mini');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
               
              <h1>BLOGS</h1> 
            </div>
            
            
                <div id="navigation">
                    <ul>
                        
                        
                         <li><?php echo $this->Html->link('Blogs', array('controller' => 'blogs', 'action' => 'index')); ?></li>
                          <li><?php echo $this->Html->link('Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
                          <li><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'index')); ?></li>
                     
                       
                    </ul>


                  


                </div><!-- End #navigation -->
         
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
                Transoft 2013 ©.
            </div>
        </div>
        <?php //echo  $this->element('sql_dump');  ?>
    </body>
</html>
