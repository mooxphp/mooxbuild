<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\CountryResource\Pages;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('title')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('slug')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Slug')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('continent_id')
                        ->rules(['exists:continents,id'])
                        ->required()
                        ->relationship('continent', 'title')
                        ->searchable()
                        ->placeholder('Continent')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('delivery')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('official')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Official')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('native_name')
                        ->required()
                        ->required()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('tld')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Tld')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('independent')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('un_member')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('status')
                        ->rules(['in:officially-assigned,user-assigned'])
                        ->nullable()
                        ->searchable()
                        ->options([
                            'officially-assigned' => 'Officially assigned',
                            'user-assigned' => 'User assigned',
                        ])
                        ->placeholder('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cca2')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Cca2')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('ccn3')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Ccn3')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cca3')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Cca3')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cioc')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Cioc')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('continent.title')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('delivery')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('official')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('tld')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\IconColumn::make('independent')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('un_member')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'officially-assigned' => 'Officially assigned',
                        'user-assigned' => 'User assigned',
                    ]),
                Tables\Columns\TextColumn::make('cca2')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('ccn3')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('cca3')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('cioc')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('continent_id')
                    ->relationship('continent', 'title')
                    ->indicator('Continent')
                    ->multiple()
                    ->label('Continent'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            CountryResource\RelationManagers\CurrenciesRelationManager::class,
            CountryResource\RelationManagers\TimezonesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'view' => Pages\ViewCountry::route('/{record}'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
