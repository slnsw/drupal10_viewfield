<?php

namespace Drupal\Tests\viewfield\Kernel;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\Tests\field\Kernel\FieldKernelTestBase;

/**
 * Tests that Viewfield utility functions work properly.
 *
 * @group viewfield
 */
class ViewfieldKernelTest extends FieldKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var string[]
   */
  protected static $modules = [
    'views',
    'viewfield',
  ];

  /**
   * Set default theme.
   */
  protected $defaultTheme = 'stark';

  protected function setUp(): void {
    parent::setUp(); // TODO: Change the autogenerated stub

    FieldStorageConfig::create([
      'field_name' => 'field_test',
      'entity_type' => 'entity_test',
      'type' => 'viewfield',
    ])->save();

    FieldConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_test',
      'bundle' => 'entity_test',
    ])->save();

    FieldStorageConfig::create([
      'field_name' => 'field_test_default_value',
      'entity_type' => 'entity_test',
      'type' => 'viewfield',
    ])->save();

    FieldConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => 'field_test_default_value',
      'bundle' => 'entity_test',
    ])->save();
  }

  public function testViewfieldItem() {
    // Create the test entity.

    // Set field values.

    // Save the test entity.

    // Verify entity creation.

    // Test field creation.

    // Test field value save.

    // Verify changing field values.

    // Read changed entity and verify new values.

  }

  public function testViewfieldItemDefaultValue() {

  }

}
