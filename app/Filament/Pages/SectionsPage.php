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
class SectionsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.sections-page';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            ...Collection::times(2 * 2)->mapWithKeys(function ($number) {
                return [
                    'items_' . (($number % 2) + 1) . '_' . $number => Collection::times(10, fn ($number) => ['number' => $number]),
                ];
            })->all(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')->schema([
            Forms\Components\Checkbox::make('hide_labels')->reactive(),

            ...Collection::times(2, function ($number) {
                return Forms\Components\Section::make('Section ' . $number)
                    ->collapsed()
                    ->schema([
                        Forms\Components\Tabs::make()->schema([
                            Forms\Components\Tabs\Tab::make('Tab 1 for' . $number)->schema([
                                Forms\Components\Repeater::make('items_1_' . $number)
                                    ->schema([
                                        TextInput::make('number')
                                            ->hiddenLabel(fn (Forms\Get $get) => $get('../../hide_labels'))
                                            ->numeric(),
                                    ]),
                            ]),
                            Forms\Components\Tabs\Tab::make('Tab 2 for' . $number)->schema([
                                Forms\Components\Repeater::make('items_2_' . $number)
                                    ->schema([
                                        TextInput::make('number')
                                            ->hiddenLabel(fn (Forms\Get $get) => $get('../../hide_labels'))
                                            ->numeric(),
                                    ]),
                            ]),
                        ]),
                    ]);
            })->all(),
        ]);
    }
}
