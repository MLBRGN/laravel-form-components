<?php

uses(\Mlbrgn\LaravelFormComponents\Tests\TestCase::class);
it('shows the slot if the options are empty', function () {
    $this->registerTestRoute('select-slot');

    $this->visit('/select-slot')
        ->seeElement('option[value="a"]')
        ->seeElement('option[value="b"]')
        ->seeElement('option[value="c"]');
});

it('can render a placeholder', function () {
    $this->registerTestRoute('select-placeholder');

    $this->visit('/select-placeholder')
        ->seeElement('option[value=""][selected="selected"]')
        ->seeElement('option[value="a"]')
        ->seeElement('option[value="b"]');
});
