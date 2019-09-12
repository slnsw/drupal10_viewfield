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
      'field_view[0][target_id]' => 'content',
      'field_view[0][display_id]' => 'block_1',
    ];

    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertSession()->responseContains('Article 1');
    $this->assertSession()->responseContains('Page 1');
  }

  /**
   * Test viewfield_title formatter.
   */
  public function testViewfieldFormatterTitle() {

  }

  /**
   * Test Viewfield argument handling.
   */
  public function testViewfieldArgumentHandling() {
    $this->form->setComponent('field_view', [
      'type' => 'viewfield_select',
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

    // Test argument handling
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "content",
      'field_view[0][display_id]' => 'block_1',
      'field_view[0][arguments]' => 'page',
    ];

    $this->drupalPostForm('node/add/article', $edit, t('Save'));
    $this->assertSession()->responseContains('Page 1');
    $this->assertSession()->responseNotContains('Article 1');

  }

  /**
   * Test Viewfield "Items to display" override.
   */
  public function testViewfieldItemsToDisplay() {

  }

  /**
   * Test Viewfield "Empty" view results.
   */
  public function testViewfieldEmptyView() {

  }

}
