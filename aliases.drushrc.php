<?php

/**
 * @file
 *   Alias file for drush command line tool.
 *
 * There are several ways to create alias files:
 *  - Put multiple aliases in a single file called aliases.drushrc.php
 *  - Put each alias in a separate file called ALIASNAME.alias.drushrc.php
 *  - Put groups of aliases into files called GROUPNAME.aliases.drushrc.php
 *
 * See:
 *  http://drush.ws/docs/shellaliases.html
 *  $ drush topic docs-aliases
 *
 */

/**
 * Alias for Development environment run on Drupal 7.
 *
 */
$aliases['global'] = array(
    // 'ssh-options' => "-p 1022 -F %root/scripts/example/conf/ssh/config" . DRUPAL_ROOT,
    'path-aliases' => array(
      '%files'   => 'sites/default/files',
      '%private' => 'sites/default/private/files',
    ),

    // These options will only be set if the alias is used with the specified command.
    'command-specific' => array(
      'sql-sync' => array(
        'cache' => TRUE,
        'create-db' => TRUE,
        'sanitize' => TRUE,
        'ordered-dump' => FALSE,
        'structure-tables-key' => 'common',
        'skip-tables-key' => 'common',
        'structure-tables' => array(
          // You can add more tables which contain data to be ignored by the database dump
          'common' => array('cache', 'cache_filter', 'cache_menu', 'cache_page', 'history', 'search_index', 'sessions', 'watchdog'),
        ),
        'skip-tables' => array(
          'common' => array('field_deleted_revision_63', 'field_deleted_revision_62', 'field_deleted_revision_60', 'field_deleted_data_60', 'field_deleted_data_63', 'field_deleted_revision_61', 'field_deleted_data_62', 'field_deleted_data_61', 'field_deleted_data_59', 'field_deleted_revision_59'),
        ),
      ),
      'sql-dump' => array(
        'ordered-dump' => TRUE,
        'structure-tables-key' => 'common',
        'skip-tables-key' => 'common',
      ),
      'rsync' => array(
          'mode' => 'rlptzO', // Single-letter rsync options are placed in the 'mode' key instead of adding '--mode=rultvz' to drush rsync command.
          'verbose' => TRUE,
          'no-perms' => TRUE,
          'exclude' => "'*.gz'", // Wrapping an option's value in "" preserves inner '' on output, but is not always required.
        # 'exclude-from' => "'/etc/rsync/exclude.rules'", // If you need multiple exludes, use an rsync exclude file.
          'ssh-options' => '-F config',
          'filter' => "'exclude *.sql'", // Filter options with white space must be wrapped in "" to preserve the inner ''.
        # 'filter' => "'merge /etc/rsync/default.rules'", // If you need multple filter options, see rsync merge-file options.
          ),
    ), // end: command-specific

    // Applied only if the alias is used as the source.
    'source-command-specific' => array(
    ),

    // Applied only if the alias is used as the target.
    'target-command-specific' => array(
    ),

);

/**
 * Example alias for development environment.
 *
 */
# $aliases['dev'] = array(
#   'parent' => '@global',
# );

