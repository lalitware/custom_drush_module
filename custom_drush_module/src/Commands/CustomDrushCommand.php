<?php

namespace Drupal\custom_drush_module\Commands;

use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 */
class CustomDrushCommand extends DrushCommands {
  /**
   * Delete existing node using custom drush command
   *
   * @param string $nid
   *   Argument provided to the drush command.
   *
   * @command node:delete
   * @aliases nd
   * @usage node:delete 1
   *   Display 'We are deleting node 1.
   */
  public function delete($nid) {
      // To check whether user has entered any node
      if($nid!=NULL){
        $nids = explode(",",$nid);
        foreach($nids as $node){
            settype($node, "integer");
            $this->output()->writeln('We are processing node = ' . $node);
            $dNode = \Drupal::entityTypeManager()->getStorage('node')->load($node);

        // Check if node exists with the given nid.
            if ($dNode) {
                $this->output()->writeln('We have deleted node = ' . $node);
                $dNode->delete();
            }
            else{
                $this->output()->writeln('This node does not exist');
            }
        }
      }
      else{
        $this->output()->writeln('Please select atleast one node to be deleted');
      }
  }

}