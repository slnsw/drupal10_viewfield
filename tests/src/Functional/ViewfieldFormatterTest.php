<?php

namespace Drupal\Tests\viewfield\Functional;

/**
 * Tests Viewfield formatters.
 *
 * @group viewfield
 */
class ViewfieldFormatterTest extends ViewfieldFunctionalTestBase {

  /**
   * Test viewfield_default formatter.
   */
  public function testViewfieldFormatterDefault() {
    $this->form->setComponent('field_view', [
      'type' => 'viewfield_select',
      'settings' => [
        'placeholder_color' => '#ABC123',
        'placeholder_opacity' => '1.0',
      ],
    ])->save();

    $this->display->setComponent('field_view', [
      'type' => 'viewfield_default',
      'weight' => 1,
      'label' => 'hidden',
    ])->save();

    // Display creation form.
    $this->drupalGet('node/add/article');
    $session = $this->assertSession();
    $session->fieldExists("field_view[0][target_id]");
    $session->fieldExists("field_view[0][display_id]");
    $session->fieldExists("field_view[0][arguments]");

    // Test basic entry of Viewfield.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "#E70000",
      'field_view[0][display_id]' => 1,
    ];

    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertSession()->responseContains('#E70000 1</div>');

    // Ensure alternate hex format works.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "FF8C00",
      'field_view[0][display_id]' => 0.5,
    ];

    // Render without opacity value.
    $this->display->setComponent('field_view', [
      'type' => 'viewfield_formatter_text',
      'weight' => 1,
      'settings' => [
        'opacity' => FALSE,
      ],
    ])->save();

    $this->drupalPostForm('node/add/article', $edit, t('Save'));
    $this->assertSession()->responseContains('#FF8C00</div>');

    // Test RGBA Render mode.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "#FFEF00",
      'field_view[0][display_id]' => 0.9,
    ];
    $this->display->setComponent('field_view', [
      'type' => 'viewfield_formatter_text',
      'weight' => 1,
      'settings' => [
        'format' => 'rgb',
        'opacity' => TRUE,
      ],
    ])->save();

    $this->drupalPostForm('node/add/article', $edit, t('Save'));
    $this->assertSession()->responseContains('RGBA(255,239,0,0.9)');

    // Test RGB render mode.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "#00811F",
      'field_view[0][display_id]' => 0.8,
    ];
    $this->display->setComponent('field_view', [
      'type' => 'viewfield_formatter_text',
      'weight' => 1,
      'settings' => [
        'format' => 'rgb',
        'opacity' => FALSE,
      ],
    ])->save();

    $this->drupalPostForm('node/add/article', $edit, t('Save'));
    $this->assertSession()->responseContains('RGB(0,129,31)');
  }

  /**
   * Test viewfield_title formatter.
   */
  public function testViewfieldFormatterTitle() {

  }

}
