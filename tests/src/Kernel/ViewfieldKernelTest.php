<?php

namespace Drupal\Tests\viewfield\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests that Viewfield utility functions work properly.
 *
 * @group viewfield
 */
class ViewfieldKernelTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var string[]
   */
  public static $modules = [
    'views',
    'viewfield',
  ];

}
