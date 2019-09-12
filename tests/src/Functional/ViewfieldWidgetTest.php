<?php

namespace Drupal\Tests\Viewfield\Functional;

/**
 * Tests Viewfield widgets.
 *
 * @group viewfield
 */
class ViewfieldWidgetTest extends ViewfieldFunctionalTestBase {

  /**
   * Test select widget.
   */
  public function testSelectWidget() {
    $this->form->setComponent('field_view', [
      'type' => 'viewfield_select',
    ])->save();

    $this->display->setComponent('field_view', [
      'type' => 'viewfield_title',
      'weight' => 1,
    ])->save();

    $session = $this->assertSession();

    // Confirm field label and description are rendered.
    $this->drupalGet('node/add/article');
    $session->fieldExists("field_view[0][target_id]");
    $session->fieldExists("field_view[0][display_id]");
    $session->fieldExists("field_view[0][arguments]");
    $session->responseContains('Viewfield');
    $session->responseContains('Viewfield description');

    // Test basic entry of color field.
    $edit = [
      'title[0][value]' => $this->randomMachineName(),
      'field_view[0][target_id]' => "content",
      'field_view[0][display_id]' => "block_1",
      'field_view[0][arguments]' => "article",
    ];

    $this->drupalPostForm(NULL, $edit, t('Save'));

    // Test response.
    $session->responseContains('content');
    $session->responseContains('block_1');
    $session->responseContains('article');
  }

}