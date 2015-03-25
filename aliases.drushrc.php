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
 * Drush will search for aliases in any of these files using
 * the alias search path.  The following locations are examined
 * for alias files:
 *
 *   1. In any path set in $options['alias-path'] in drushrc.php,
 *      or (equivalently) any path passed in via --alias-path=...
 *      on the command line.
 *   2. In one of the default locations:
 *        a. /etc/drush
 *        b. $HOME/.drush
 *        c. The /drush and /sites/all/drush folders for the current Drupal site
 *   3. Inside the sites folder of any bootstrapped Drupal site,
 *      or any local Drupal site indicated by an alias used as
 *      a parameter to a command
 *
 * See:
 *  http://drush.ws/docs/shellaliases.html
 *  $ drush topic docs-aliases
 *
 */

/**
 * Define global common options alias for all environments.
 *
 */
$aliases['all'] = array(

  // 'ssh-options' => "-p 1022 -F %root/scripts/example/conf/ssh/config" . DRUPAL_ROOT,
  'path-aliases' => array(
    '%files'   => 'sites/default/files',
    '%private' => 'sites/default/private/files',
  ),

  // These options will only be set if the alias is used with the specified command.
  'command-specific' => array(
    'sql-sync' => array(
      'create-db' => TRUE,
      'sanitize' => TRUE,
      'structure-tables-key' => 'common',
      'skip-tables-key' => 'common',
      'structure-tables' => array(
        // You can add more tables which contain data to be ignored by the database dump
        'common' => array('cache', 'cache_filter', 'cache_menu', 'cache_page', 'history', 'search_index', 'sessions', 'watchdog'),
      ),
      'skip-tables' => array(
        'common' => array('field_deleted_revision_63'),
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
        'exclude-paths' => "*.gz:settings.local.php", // Wrapping an option's value in "" preserves inner '' on output, but is not always required.
      # 'exclude-from' => "'/etc/rsync/exclude.rules'", // If you need multiple exludes, use an rsync exclude file.
        'ssh-options' => '-v',
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
 * Define common options alias for all development environments.
 *
 */
$aliases['all.dev'] = array(
  'variables' => array('mail_system' => array('default-system' => 'DevelMailLog')),
) + $aliases['all'];

/**
 * Define common options alias for all testing environments.
 *
 */
$aliases['all.test'] = array(
  'variables' => array('mail_system' => array('default-system' => 'DevelMailLog')),
) + $aliases['all'];

/**
 * Define common options alias for all production environments.
 *
 */
$aliases['all.prod'] = array(

  // Applied only if the alias is used as the target.
  'target-command-specific' => array(
    'sql-sync' => array (
      'simulate' => '1', // Now you can't use @prod with sql-sync.
    ),
    'rsync' => array (
      'simulate' => '1', // Now you can't use @prod with rsync.
    ),
  ),
) + $aliases['all'];

/**
 * Example alias for development environment.
 *
 */
# $aliases['dev'] = array(
# ) + $aliases['all'];

