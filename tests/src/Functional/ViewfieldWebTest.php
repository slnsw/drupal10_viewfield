<?php

namespace Drupal\Tests\viewfield\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Viewfield web tests.
 *
 * @group viewfield
 */
class ViewfieldWebTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var string[]
   */
  public static $modules = [
    'views',
    'viewfield',
  ];

  /**
   * A user with all permissions.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Create admin user.
    $this->adminUser = $this->createUser([
      'access administration pages',
      'administer site configuration',
    ]);

    // Log in admin user.
    $this->drupalLogin($this->adminUser);
  }

}
