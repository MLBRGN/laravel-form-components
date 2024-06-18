<?php

uses(\Mlbrgn\LaravelFormComponents\Tests\TestCase::class);

it('renders html-editor', function () {
    $this->registerTestRoute('html-editor');

    $this->visit('/html-editor')
        ->assertResponseOk()
//        ->seeElement('textarea[name="html-editor-1"][something][id="auto_id_html-editor-1"].form-control.html-editor')
        ->seeElement('textarea[name="html-editor-1"][required][id="auto_id_html-editor-1"].form-control.html-editor')
        ->seeElement('textarea[name="html-editor-2"][id="html-editor-2"].form-control.html-editor')
        ->seeElement('label[for="auto_id_html-editor-1"].form-label.required')
        ->seeElement('label[for="html-editor-2"].form-label')
        ->seeText('html-content-1')
        ->seeText('html-content-2');
});


it('sets classes on textarea', function () {
//    $this->registerTestRoute('custom-button');
//    $this->visit('custom-button')
//        ->within('#form-2', function() {
//            $this->seeElement('button[id="button-2"].btn.btn-my-button:not(.btn-primary)')
//                ->seeElement('button[id="button-submit-2"][type="submit"].btn.btn-something:not(.btn-primary)')
//                ->seeElement('button[id="button-reset-2"][type="reset"].btn.btn-something-else:not(.btn-primary)');
//        });
})->todo();

it('sets extra classes on textarea', function () {
//    $this->registerTestRoute('custom-button');
//    $this->visit('custom-button')
//        ->within('#form-3', function() {
//            $this->seeElement('button[id="button-3"].btn.btn-sm')
//                ->seeElement('button[id="button-submit-3"][type="submit"].btn.btn-lg')
//                ->seeElement('button[id="button-reset-3"][type="reset"].btn.btn-extra');
//        });
})->todo();

it('sets extra attributes on textarea', function () {
//    $this->registerTestRoute('custom-button');
//    $this->visit('custom-button')
//        ->within('#form-3', function() {
//            $this->seeElement('button[id="button-3"].btn.btn-sm')
//                ->seeElement('button[id="button-submit-3"][type="submit"].btn.btn-lg')
//                ->seeElement('button[id="button-reset-3"][type="reset"].btn.btn-extra');
//        });
})->todo();

it('does not render label when html-editor is hidden', function () {
//    $this->registerTestRoute('bootstrap-inputs');
//
//    $this->visit('/bootstrap-inputs')
//        ->within('#form-6', function() {
//            return $this->dontSeeElement('label[for="checkbox"]')
//                ->dontSeeElement('label[for="color"]');
//        });
})->todo();

// already tested for
//it('always has an id attribute', function () {
//    $this->registerTestRoute('html-editor');
//
//    $this->visit('/html-editor')
//        ->assertResponseOk()
////        ->seeElement('textarea[name="html-editor-1"][something][id="auto_id_html-editor-1"].form-control.html-editor')
//        ->seeElement('textarea[name="html-editor-1"][id]')
//        ->seeElement('textarea[name="html-editor-2"][id]');
//});
