<?php

namespace Drupal\Tests\viewfield\FunctionalJavascript;

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
    $this->form->setComponent('field_view_test', [
      'type' => 'viewfield_select',
    ])->save();

    $this->display->setComponent('field_view_test', [
      'type' => 'viewfield_default',
      'weight' => 1,
      'label' => 'hidden',
    ])->save();

    // Display creation form.
    $this->drupalGet('node/add/article_test');
    $session = $this->assertSession();
    $page = $this->getSession()->getPage();


    $session->fieldExists("field_view_test[0][target_id]");
    $session->fieldExists("field_view_test[0][display_id]");
    $session->fieldExists("field_view_test[0][arguments]");

    $viewfield_target = $session->fieldExists('field_view_test[0][target_id]');

    // Test basic entry of color field.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
    ];

    $viewfield_target->setValue('content_test');
    $session->assertWaitOnAjaxRequest();

    $viewfield_display = $session->fieldExists('field_view_test[0][display_id]');
    $viewfield_display->setValue('block_1');

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
    $this->form->setComponent('field_view_test', [
      'type' => 'viewfield_select',
    ])->save();

    $this->display->setComponent('field_view_test', [
      'type' => 'viewfield_default',
      'weight' => 1,
      'label' => 'hidden',
    ])->save();

    // Display creation form.
    $this->drupalGet('node/add/article_test');
    $session = $this->assertSession();
    $page = $this->getSession()->getPage();

    $session->fieldExists("field_view_test[0][target_id]");
    $session->fieldExists("field_view_test[0][display_id]");
    $session->fieldExists("field_view_test[0][arguments]");

    $viewfield_target = $session->fieldExists('field_view_test[0][target_id]');

    $viewfield_target->setValue('content_test');
    $session->assertWaitOnAjaxRequest();

    $viewfield_display = $session->fieldExists('field_view_test[0][display_id]');
    $viewfield_display->setValue('block_1');

    // Test basic entry of color field.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view_test[0][arguments]' => 'page_test',
    ];

    $this->drupalPostForm(NULL, $edit, t('Save'));
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
