<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected const SIZE_CHART_COLUMNS = 5;

    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('description'),

                    TextInput::make('render_columns')
                        ->required()
                        ->numeric()
                        ->label('Show columns')
                        ->live(onBlur: true)
                        ->default(3)
                        ->minValue(2)
                        ->maxValue(static::SIZE_CHART_COLUMNS)
                        ->columnSpan(1),

                    TranslatableTabs::make('Heading')
                        ->localeTabSchema(fn (TranslatableTab $tab) => [
                            Repeater::make('size_table')
                                ->label('Sizes')
                                ->columns(static::SIZE_CHART_COLUMNS)
                                ->defaultItems(1)
                                ->minItems(1)
                                ->required()
                                ->addActionLabel('Add')
                                ->schema(function (Get $get) use ($tab) {
                                    $columns = [];

                                    foreach (range(1, static::SIZE_CHART_COLUMNS) as $item) {
                                        $index = $item - 1;
                                        $columns[] = TextInput::make("values.{$index}.{$tab->getLocale()}")
                                            ->disabled($get('render_columns') < $item)
                                            ->hiddenLabel();
                                    }

                                    return $columns;
                                }),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
