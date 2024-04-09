<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

/**
 * @property Form $form
 */
class WizardPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.wizard-page';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'items' => Collection::times(10, fn ($number) => ['number' => $number]),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')->schema([
            Forms\Components\Wizard::make()
                ->schema([
                    Forms\Components\Wizard\Step::make('Step 1')->schema([
                        Forms\Components\Checkbox::make('hide_labels')->reactive(),
                    ]),

                    Forms\Components\Wizard\Step::make('Step 2 with repeater')->schema([
                        // ...Collection::times(5, fn ($number) => TextInput::make('number_' . $number)->numeric())->all(),

                        Forms\Components\Repeater::make('items')->schema([
                            Forms\Components\TextInput::make('name')
                                ->hiddenLabel(fn (Forms\Get $get) => $get('../../hide_labels'))
                                ->numeric(),
                        ]),
                    ]),
                ]),
        ]);
    }
}
